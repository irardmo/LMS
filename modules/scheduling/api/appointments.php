<?php
require_once __DIR__ . '/../auth_check.php';
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json');

$current_user_id = $GLOBALS['current_user_id'];
$user_roles = $GLOBALS['user_roles'] ?? [];

function json_exit($v, $status=200) { http_response_code($status); echo json_encode($v); exit; }
function valid_datetime($s){ return (bool)date_create($s); }

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

try {
  if ($method === 'GET') {
    // Role-based filtering: admin/dean/secretary see all, teachers see assigned, students see own
    $is_admin = in_array('admin', $user_roles, true);
    $is_dean = in_array('academic_dean', $user_roles, true);
    $is_secretary = in_array('college_secretary', $user_roles, true);
    $is_teacher = in_array('teacher', $user_roles, true);
    $is_student = in_array('student', $user_roles, true);

    $start = $_GET['start'] ?? null;
    $end = $_GET['end'] ?? null;

    $sql = "SELECT id, title, start_time, end_time, status, location, type, created_by, assigned_to, student_id\n            FROM appointments WHERE is_deleted = 0";
    $params = [];
    if ($start && $end) {
      $sql .= " AND NOT (end_time < :start OR start_time > :end)";
      $params[':start'] = $start; $params[':end'] = $end;
    }

    if (!($is_admin || $is_dean || $is_secretary)) {
      if ($is_teacher) {
        $sql .= " AND assigned_to = :uid"; $params[':uid'] = $current_user_id;
      } elseif ($is_student) {
        $sql .= " AND student_id = :uid"; $params[':uid'] = $current_user_id;
      } else {
        // other roles: restrict
        $sql .= " AND (created_by = :uid OR assigned_to = :uid)"; $params[':uid'] = $current_user_id;
      }
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll();

    $events = array_map(function($r){
        return [
          'id' => $r['id'],
          'title' => $r['title'],
          'start' => $r['start_time'],
          'end' => $r['end_time'],
          'extendedProps' => [
            'status' => $r['status'],
            'location' => $r['location'],
            'type' => $r['type'],
            'student_id' => $r['student_id'],
            'assigned_to' => $r['assigned_to'],
            'created_by' => $r['created_by']
          ]
        ];
    }, $rows ?: []);
    json_exit($events);
  }

  if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    foreach (['title','start_time','end_time'] as $f) if (empty($data[$f])) json_exit(['error'=>"$f required"], 400);
    if (!valid_datetime($data['start_time']) || !valid_datetime($data['end_time'])) json_exit(['error'=>'Invalid date format'], 400);
    if (strtotime($data['start_time']) >= strtotime($data['end_time'])) json_exit(['error'=>'start must be before end'], 400);

    // Business rules
    $minLeadSeconds = 60*60*24; // 24 hours
    if (strtotime($data['start_time']) - time() < $minLeadSeconds) json_exit(['error'=>'Appointments must be booked at least 24 hours in advance'], 400);
    $durationSecs = strtotime($data['end_time']) - strtotime($data['start_time']);
    if ($durationSecs < 60*15) json_exit(['error'=>'Minimum duration is 15 minutes'], 400);
    if ($durationSecs > 60*60*3) json_exit(['error'=>'Maximum duration is 3 hours'], 400);

    // Overlap check
    $assigned_to = $data['assigned_to'] ?? null; $location = $data['location'] ?? null;
    $overlapSql = "SELECT COUNT(*) FROM appointments WHERE is_deleted = 0 AND status IN ('pending','confirmed')\n                   AND NOT (end_time <= :start OR start_time >= :end)";
    $params = [':start'=>$data['start_time'], ':end'=>$data['end_time']];
    if ($assigned_to) { $overlapSql .= " AND assigned_to = :assigned_to"; $params[':assigned_to'] = $assigned_to; }
    elseif ($location) { $overlapSql .= " AND location = :location"; $params[':location'] = $location; }

    $stmt = $pdo->prepare($overlapSql); $stmt->execute($params); $count = (int)$stmt->fetchColumn();
    if ($count > 0) json_exit(['error'=>'Time conflict with existing appointment'], 409);

    $stmt = $pdo->prepare("INSERT INTO appointments (title, description, start_time, end_time, location, type, status, created_by, assigned_to, student_id)\n                           VALUES (:title,:description,:start,:end,:location,:type,:status,:created_by,:assigned_to,:student_id)");
    $stmt->execute([
      ':title'=>$data['title'],
      ':description'=>$data['description'] ?? null,
      ':start'=>$data['start_time'],
      ':end'=>$data['end_time'],
      ':location'=>$data['location'] ?? null,
      ':type'=>$data['type'] ?? null,
      ':status'=> $data['status'] ?? 'pending',
      ':created_by'=>$current_user_id,
      ':assigned_to'=>$assigned_to,
      ':student_id'=>$data['student_id'] ?? null
    ]);
    $newId = $pdo->lastInsertId();

    $audit = $pdo->prepare("INSERT INTO appointments_audit (appointment_id, action, payload, performed_by) VALUES (:aid,'created',:payload,:by)");
    $audit->execute([':aid'=>$newId, ':payload'=>json_encode($data), ':by'=>$current_user_id]);

    json_exit(['id'=>$newId], 201);
  }

  if ($method === 'PUT' && $id) {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE id = :id AND is_deleted = 0"); $stmt->execute([':id'=>$id]);
    $existing = $stmt->fetch(); if (!$existing) json_exit(['error'=>'Not found'], 404);

    if (isset($data['status']) && in_array($data['status'], ['confirmed','rejected','cancelled'])) {
      $allowed = ['admin','academic_dean','college_secretary']; $ok = false; foreach ($allowed as $r) if (in_array($r, $user_roles, true)) $ok = true;
      if (!$ok) json_exit(['error'=>'Insufficient role to change status'], 403);
    }

    $sets = []; $params = [':id'=>$id];
    foreach (['title','description','start_time','end_time','location','status','assigned_to','type'] as $f) {
      if (array_key_exists($f, $data)) { $sets[] = "$f = :$f"; $params[":$f"] = $data[$f]; }
    }
    if (empty($sets)) json_exit(['error'=>'Nothing to update'], 400);

    if ((isset($data['start_time']) || isset($data['end_time']) || isset($data['assigned_to'])) &&
        ( ($data['status'] ?? $existing['status']) !== 'cancelled')) {
      $s = $data['start_time'] ?? $existing['start_time']; $e = $data['end_time'] ?? $existing['end_time']; $a = $data['assigned_to'] ?? $existing['assigned_to'];
      $overlapSql = "SELECT COUNT(*) FROM appointments WHERE is_deleted = 0 AND status IN ('pending','confirmed') AND id != :id\n                     AND NOT (end_time <= :start OR start_time >= :end)";
      $oParams = [':start'=>$s, ':end'=>$e, ':id'=>$id]; if ($a) { $overlapSql .= " AND assigned_to = :assigned_to"; $oParams[':assigned_to'] = $a; }
      $ost = $pdo->prepare($overlapSql); $ost->execute($oParams); if ((int)$ost->fetchColumn() > 0) json_exit(['error'=>'Time conflict with existing appointment'], 409);
    }

    $sql = "UPDATE appointments SET " . implode(',', $sets) . " WHERE id = :id"; $stmt = $pdo->prepare($sql); $stmt->execute($params);

    $audit = $pdo->prepare("INSERT INTO appointments_audit (appointment_id, action, payload, performed_by) VALUES (:aid,'updated',:payload,:by)");
    $audit->execute([':aid'=>$id, ':payload'=>json_encode($data), ':by'=>$current_user_id]);

    json_exit(['updated' => $stmt->rowCount()]);
  }

  if ($method === 'DELETE' && $id) {
    $stmt = $pdo->prepare("UPDATE appointments SET is_deleted = 1 WHERE id = :id"); $stmt->execute([':id'=>$id]);
    $audit = $pdo->prepare("INSERT INTO appointments_audit (appointment_id, action, payload, performed_by) VALUES (:aid,'deleted',NULL,:by)");
    $audit->execute([':aid'=>$id, ':by'=>$current_user_id]);
    json_exit(['deleted' => $stmt->rowCount()]);
  }

  http_response_code(405); json_exit(['error'=>'Method not allowed'], 405);
} catch (Exception $e) {
  http_response_code(500); json_exit(['error'=>$e->getMessage()], 500);
}
<?php
// modules/scheduling/auth_check.php
// Auth guard: checks session and maps roles. If roles are not in session, attempts to read from DB.

session_start();
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id'])) {
    // If LMS has a different session init requirement, adapt here.
    header('Location: /login.php');
    exit;
}

$current_user_id = (int)$_SESSION['user_id'];
$user_roles = $_SESSION['roles'] ?? null; // expected array of role strings, if available

// Role constants used in module
$ROLE_ADMIN = 'admin';
$ROLE_ACADEMIC_DEAN = 'academic_dean';
$ROLE_COLLEGE_SECRETARY = 'college_secretary';

// If roles are not in session, try to query users table for role column
if (empty($user_roles)) {
    try {
        // Try common schema: users.role
        $stmt = $pdo->prepare('SELECT role FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $current_user_id]);
        $row = $stmt->fetch();
        if ($row && !empty($row['role'])) {
            // support comma-separated roles or JSON array
            $r = $row['role'];
            if (strpos($r, ',') !== false) {
                $user_roles = array_map('trim', explode(',', $r));
            } else {
                // try JSON decode
                $decoded = json_decode($r, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) $user_roles = $decoded;
                else $user_roles = [$r];
            }
        } else {
            // Fallback: attempt roles through user_roles join (roles table)
            $stmt = $pdo->prepare('SELECT r.name as role FROM user_roles ur JOIN roles r ON ur.role_id = r.id WHERE ur.user_id = :id');
            $stmt->execute([':id' => $current_user_id]);
            $rows = $stmt->fetchAll();
            if ($rows) {
                $user_roles = array_map(fn($x)=>$x['role'], $rows);
            }
        }
    } catch (Exception $e) {
        // If DB schema differs, leave user_roles null and rely on session or admin to adjust
        $user_roles = [];
    }
}

if (empty($user_roles)) $user_roles = [];

function has_any_role(array $roles_to_check): bool {
    global $user_roles;
    foreach ($roles_to_check as $r) if (in_array($r, $user_roles, true)) return true;
    return false;
}

function require_dean_or_admin() {
    global $ROLE_ACADEMIC_DEAN, $ROLE_ADMIN;
    if (!has_any_role([$ROLE_ACADEMIC_DEAN, $ROLE_ADMIN])) {
        http_response_code(403);
        echo 'Forbidden — requires academic_dean or admin.';
        exit;
    }
}

function require_secretary_dean_or_admin() {
    global $ROLE_COLLEGE_SECRETARY, $ROLE_ACADEMIC_DEAN, $ROLE_ADMIN;
    if (!has_any_role([$ROLE_COLLEGE_SECRETARY, $ROLE_ACADEMIC_DEAN, $ROLE_ADMIN])) {
        http_response_code(403);
        echo 'Forbidden — requires college_secretary, academic_dean, or admin.';
        exit;
    }
}

$GLOBALS['current_user_id'] = $current_user_id;
$GLOBALS['user_roles'] = $user_roles;
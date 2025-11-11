<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'get_admin_load') {
            if (isset($_GET['id'])) {
                $stmt = $conn->prepare("SELECT * FROM admin_load WHERE id = ?");
                $stmt->bind_param("i", $_GET['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                echo json_encode($result->fetch_assoc());
            } else {
                if (isset($_GET['teacher'])) {
                    $stmt = $conn->prepare("SELECT * FROM admin_load WHERE teacher = ?");
                    $stmt->bind_param("s", $_GET['teacher']);
                } else {
                    $stmt = $conn->prepare("SELECT * FROM admin_load");
                }
                $stmt->execute();
                $result = $stmt->get_result();
                $admin_load = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $admin_load[] = $row;
                    }
                }
                echo json_encode($admin_load);
            }
            exit();
        }
        if ($_GET['action'] == 'get_schedule') {
            $stmt = $conn->prepare("SELECT * FROM schedules WHERE id = ?");
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            echo json_encode($result->fetch_assoc());
            exit();
        }
        if ($_GET['action'] == 'export_evaluations') {
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=evaluations.csv');
            $output = fopen('php://output', 'w');
            fputcsv($output, array('ID', 'Employee Name', 'Employee ID', 'Evaluation Date'));

            $sql = "SELECT * FROM evaluations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    fputcsv($output, $row);
                }
            }
            fclose($output);
            exit();
        }
    }

    $sql = "SELECT * FROM schedules";
    $params = array();
    $types = "";
    $where = array();

    if (isset($_GET['teacher'])) {
        $where[] = "teacher = ?";
        $params[] = $_GET['teacher'];
        $types .= "s";
    }
    if (isset($_GET['course'])) {
        $where[] = "course = ?";
        $params[] = $_GET['course'];
        $types .= "s";
    }
    if (isset($_GET['year'])) {
        $where[] = "year = ?";
        $params[] = $_GET['year'];
        $types .= "s";
    }
    if (isset($_GET['block'])) {
        $where[] = "block = ?";
        $params[] = $_GET['block'];
        $types .= "s";
    }

    if (count($where) > 0) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }

    $stmt = $conn->prepare($sql);
    if (count($params) > 0) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $schedules = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $schedules[] = $row;
        }
    }

    echo json_encode($schedules);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add_admin_load') {
            $stmt = $conn->prepare("INSERT INTO admin_load (teacher, office, `load`, day, `time`, hours) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $_POST['teacher'], $_POST['office'], $_POST['load'], $_POST['day'], $_POST['time'], $_POST['hours']);

            if ($stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => "New record created successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
            }
            exit();
        }

        if ($_POST['action'] == 'update_admin_load') {
            $stmt = $conn->prepare("UPDATE admin_load SET teacher=?, office=?, `load`=?, day=?, `time`=?, hours=? WHERE id=?");
            $stmt->bind_param("sssssii", $_POST['teacher'], $_POST['office'], $_POST['load'], $_POST['day'], $_POST['time'], $_POST['hours'], $_POST['id']);

            if ($stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => "Record updated successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
            }
            exit();
        }

        if ($_POST['action'] == 'delete_admin_load') {
            $stmt = $conn->prepare("DELETE FROM admin_load WHERE id=?");
            $stmt->bind_param("i", $_POST['id']);

            if ($stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => "Record deleted successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
            }
            exit();
        }

        if ($_POST['action'] == 'add_schedule') {
            // Check for conflicts
            $stmt = $conn->prepare("SELECT * FROM schedules WHERE (teacher = ? OR room = ?) AND day = ? AND ((time_start <= ? AND time_end > ?) OR (time_start < ? AND time_end >= ?) OR (time_start >= ? AND time_end <= ?))");
            $stmt->bind_param("sssssssss", $_POST['teacher'], $_POST['room'], $_POST['day'], $_POST['time_start'], $_POST['time_start'], $_POST['time_end'], $_POST['time_end'], $_POST['time_start'], $_POST['time_end']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo json_encode(array("status" => "error", "message" => "Conflict detected!"));
            } else {
                $stmt = $conn->prepare("INSERT INTO schedules (teacher, room, day, time_start, time_end, year, block, subject, course, lec, lab) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssss", $_POST['teacher'], $_POST['room'], $_POST['day'], $_POST['time_start'], $_POST['time_end'], $_POST['year'], $_POST['block'], $_POST['subject'], $_POST['course'], $_POST['lec'], $_POST['lab']);

                if ($stmt->execute()) {
                    echo json_encode(array("status" => "success", "message" => "New record created successfully"));
                } else {
                    echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
                }
            }
            exit();
        }

        if ($_POST['action'] == 'update_schedule') {
            $stmt = $conn->prepare("UPDATE schedules SET teacher=?, room=?, day=?, time_start=?, time_end=?, year=?, block=?, subject=?, course=?, lec=?, lab=? WHERE id=?");
            $stmt->bind_param("sssssssssssi", $_POST['teacher'], $_POST['room'], $_POST['day'], $_POST['time_start'], $_POST['time_end'], $_POST['year'], $_POST['block'], $_POST['subject'], $_POST['course'], $_POST['lec'], $_POST['lab'], $_POST['id']);

            if ($stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => "Record updated successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
            }
            exit();
        }

        if ($_POST['action'] == 'delete_schedule') {
            $stmt = $conn->prepare("DELETE FROM schedules WHERE id=?");
            $stmt->bind_param("i", $_POST['id']);

            if ($stmt->execute()) {
                echo json_encode(array("status" => "success", "message" => "Record deleted successfully"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
            }
            exit();
        }

        if ($_POST['action'] == 'update_evaluation_questions') {
            $questions = json_decode($_POST['questions'], true);
            $stmt = $conn->prepare("UPDATE evaluation_questions SET question=? WHERE id=?");
            foreach ($questions as $question) {
                $stmt->bind_param("si", $question['text'], $question['id']);
                $stmt->execute();
            }
            echo json_encode(array("status" => "success", "message" => "Questions updated successfully"));
            exit();
        }
    }
}

$conn->close();
?>

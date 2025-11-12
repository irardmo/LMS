<?php
// XAMPP default MySQL: host=127.0.0.1, user=root, password empty
$DB_HOST = '127.0.0.1';
$DB_NAME = 'lms_system';        // per your instruction
$DB_USER = 'root';
$DB_PASS = '';
$DB_CHAR = 'utf8mb4';

try {
    $pdo = new PDO(
      "mysql:host={$DB_HOST};dbname={$DB_NAME};charset={$DB_CHAR}",
      $DB_USER,
      $DB_PASS,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo "DB connection failed: " . $e->getMessage();
    exit;
}
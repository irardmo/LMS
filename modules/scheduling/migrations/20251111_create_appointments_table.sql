-- Run in XAMPP (phpMyAdmin or mysql CLI)
CREATE TABLE IF NOT EXISTS appointments (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  start_time DATETIME NOT NULL,
  end_time DATETIME NOT NULL,
  location VARCHAR(255),
  type VARCHAR(100) DEFAULT NULL,
  status ENUM('pending','confirmed','rejected','cancelled','completed') NOT NULL DEFAULT 'pending',
  created_by BIGINT UNSIGNED NOT NULL,
  assigned_to BIGINT UNSIGNED NULL,
  student_id BIGINT UNSIGNED NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  is_deleted TINYINT(1) DEFAULT 0,
  INDEX idx_start_time (start_time),
  INDEX idx_end_time (end_time),
  INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
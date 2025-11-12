-- Audit table records create/update/status changes
CREATE TABLE IF NOT EXISTS appointments_audit (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  appointment_id BIGINT UNSIGNED NOT NULL,
  action VARCHAR(50) NOT NULL,
  payload JSON NULL,
  performed_by BIGINT UNSIGNED NULL,
  performed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_appointment_id (appointment_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
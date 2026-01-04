-- Database untuk SIG Pemetaan Lokasi
-- Level 4: Database MySQL

CREATE DATABASE IF NOT EXISTS sig_lokasi;
USE sig_lokasi;

-- Tabel lokasi
CREATE TABLE IF NOT EXISTS lokasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Data contoh
INSERT INTO lokasi (nama, latitude, longitude) VALUES
('Jakarta Pusat', -6.200000, 106.816666),
('Monas', -6.175392, 106.827153),
('Bandara Soekarno-Hatta', -6.125567, 106.655997);


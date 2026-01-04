<?php
// Konfigurasi Database
// Level 4: Koneksi MySQL

$host = 'localhost';
$dbname = 'sig_lokasi';
$username = 'root';
$password = '';

try {
    // Coba koneksi dengan database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Jika database belum ada, coba buat
    if ($e->getCode() == 1049) {
        try {
            $pdo_temp = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
            $pdo_temp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo_temp->exec("CREATE DATABASE IF NOT EXISTS $dbname");
            $pdo_temp->exec("USE $dbname");
            $pdo_temp->exec("CREATE TABLE IF NOT EXISTS lokasi (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nama VARCHAR(255) NOT NULL,
                latitude DECIMAL(10, 8) NOT NULL,
                longitude DECIMAL(11, 8) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
            // Koneksi ulang dengan database yang baru dibuat
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e2) {
            die("Koneksi database gagal: " . $e2->getMessage() . "<br>Pastikan MySQL sudah berjalan dan jalankan setup.php untuk setup database.");
        }
    } else {
        die("Koneksi database gagal: " . $e->getMessage() . "<br>Pastikan MySQL sudah berjalan.");
    }
}
?>


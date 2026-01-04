<?php
// Script Setup Database
// Menjalankan script ini akan membuat database dan tabel jika belum ada

$host = 'localhost';
$username = 'root';
$password = '';

echo "<h2>Setup Database SIG Lokasi</h2>";

try {
    // Koneksi tanpa database dulu
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p>✓ Koneksi ke MySQL berhasil</p>";
    
    // Buat database jika belum ada
    $pdo->exec("CREATE DATABASE IF NOT EXISTS sig_lokasi");
    echo "<p>✓ Database 'sig_lokasi' sudah siap</p>";
    
    // Gunakan database
    $pdo->exec("USE sig_lokasi");
    
    // Buat tabel jika belum ada
    $pdo->exec("CREATE TABLE IF NOT EXISTS lokasi (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(255) NOT NULL,
        latitude DECIMAL(10, 8) NOT NULL,
        longitude DECIMAL(11, 8) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    echo "<p>✓ Tabel 'lokasi' sudah dibuat</p>";
    
    // Cek apakah sudah ada data
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM lokasi");
    $result = $stmt->fetch();
    
    if ($result['count'] == 0) {
        // Insert data contoh
        $pdo->exec("INSERT INTO lokasi (nama, latitude, longitude) VALUES
            ('Jakarta Pusat', -6.200000, 106.816666),
            ('Monas', -6.175392, 106.827153),
            ('Bandara Soekarno-Hatta', -6.125567, 106.655997)");
        echo "<p>✓ Data contoh sudah ditambahkan</p>";
    } else {
        echo "<p>✓ Database sudah berisi " . $result['count'] . " lokasi</p>";
    }
    
    echo "<br><h3 style='color: green;'>✓ Setup database berhasil!</h3>";
    echo "<p><a href='admin.php'>Buka Admin Panel</a> | <a href='index-with-api.html'>Buka Frontend</a></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
    echo "<p>Pastikan MySQL sudah berjalan dan username/password benar.</p>";
}
?>


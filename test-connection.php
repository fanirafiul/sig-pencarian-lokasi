<?php
// Test Koneksi Database
require_once 'config.php';

echo "<h2>Test Koneksi Database</h2>";

try {
    // Test query
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM lokasi");
    $result = $stmt->fetch();
    
    echo "<p style='color: green;'>✓ Koneksi database berhasil!</p>";
    echo "<p>Total lokasi dalam database: <strong>" . $result['total'] . "</strong></p>";
    
    // Tampilkan semua lokasi
    $stmt = $pdo->query("SELECT * FROM lokasi ORDER BY id");
    $lokasi = $stmt->fetchAll();
    
    if (count($lokasi) > 0) {
        echo "<h3>Daftar Lokasi:</h3>";
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Nama</th><th>Latitude</th><th>Longitude</th></tr>";
        foreach ($lokasi as $l) {
            echo "<tr>";
            echo "<td>" . $l['id'] . "</td>";
            echo "<td>" . htmlspecialchars($l['nama']) . "</td>";
            echo "<td>" . $l['latitude'] . "</td>";
            echo "<td>" . $l['longitude'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    echo "<br><p><a href='admin.php'>Buka Admin Panel</a> | <a href='index-with-api.html'>Buka Frontend</a></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
    echo "<p><a href='setup.php'>Jalankan Setup Database</a></p>";
}
?>


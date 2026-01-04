<?php
// API untuk CRUD Lokasi
// Level 4: Backend PHP

// Handle CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    http_response_code(200);
    exit;
}

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    switch ($method) {
        case 'GET':
            if ($action === 'list') {
                // Ambil semua lokasi
                $stmt = $pdo->query("SELECT * FROM lokasi ORDER BY id DESC");
                $lokasi = $stmt->fetchAll();
                echo json_encode(['success' => true, 'data' => $lokasi]);
            } elseif ($action === 'search') {
                // Pencarian lokasi berdasarkan nama
                $keyword = $_GET['keyword'] ?? '';
                if (empty($keyword)) {
                    echo json_encode(['success' => false, 'message' => 'Keyword pencarian tidak boleh kosong']);
                    exit;
                }
                $stmt = $pdo->prepare("SELECT * FROM lokasi WHERE nama LIKE ? ORDER BY nama");
                $stmt->execute(["%$keyword%"]);
                $lokasi = $stmt->fetchAll();
                echo json_encode(['success' => true, 'data' => $lokasi, 'count' => count($lokasi)]);
            } elseif ($action === 'get' && isset($_GET['id'])) {
                // Ambil satu lokasi
                $stmt = $pdo->prepare("SELECT * FROM lokasi WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                $lokasi = $stmt->fetch();
                if ($lokasi) {
                    echo json_encode(['success' => true, 'data' => $lokasi]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Lokasi tidak ditemukan']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Action tidak valid']);
            }
            break;

        case 'POST':
            // Tambah lokasi baru
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['nama']) || !isset($data['latitude']) || !isset($data['longitude'])) {
                echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
                exit;
            }

            // Validasi data
            $nama = trim($data['nama']);
            $latitude = floatval($data['latitude']);
            $longitude = floatval($data['longitude']);

            if (empty($nama)) {
                echo json_encode(['success' => false, 'message' => 'Nama lokasi tidak boleh kosong']);
                exit;
            }

            if ($latitude < -90 || $latitude > 90) {
                echo json_encode(['success' => false, 'message' => 'Latitude harus antara -90 dan 90']);
                exit;
            }

            if ($longitude < -180 || $longitude > 180) {
                echo json_encode(['success' => false, 'message' => 'Longitude harus antara -180 dan 180']);
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO lokasi (nama, latitude, longitude) VALUES (?, ?, ?)");
            $stmt->execute([$nama, $latitude, $longitude]);
            
            $id = $pdo->lastInsertId();
            echo json_encode([
                'success' => true,
                'message' => 'Lokasi berhasil ditambahkan',
                'id' => $id
            ]);
            break;

        case 'PUT':
            // Update lokasi
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['id']) || !isset($data['nama']) || !isset($data['latitude']) || !isset($data['longitude'])) {
                echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
                exit;
            }

            // Validasi data
            $id = intval($data['id']);
            $nama = trim($data['nama']);
            $latitude = floatval($data['latitude']);
            $longitude = floatval($data['longitude']);

            if (empty($nama)) {
                echo json_encode(['success' => false, 'message' => 'Nama lokasi tidak boleh kosong']);
                exit;
            }

            if ($latitude < -90 || $latitude > 90) {
                echo json_encode(['success' => false, 'message' => 'Latitude harus antara -90 dan 90']);
                exit;
            }

            if ($longitude < -180 || $longitude > 180) {
                echo json_encode(['success' => false, 'message' => 'Longitude harus antara -180 dan 180']);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE lokasi SET nama = ?, latitude = ?, longitude = ? WHERE id = ?");
            $stmt->execute([$nama, $latitude, $longitude, $id]);
            
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Lokasi berhasil diupdate']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Lokasi tidak ditemukan']);
            }
            break;

        case 'DELETE':
            // Hapus lokasi
            if (!isset($_GET['id'])) {
                echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
                exit;
            }

            $id = intval($_GET['id']);
            if ($id <= 0) {
                echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
                exit;
            }

            $stmt = $pdo->prepare("DELETE FROM lokasi WHERE id = ?");
            $stmt->execute([$id]);
            
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Lokasi berhasil dihapus']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Lokasi tidak ditemukan']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Method tidak didukung']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>


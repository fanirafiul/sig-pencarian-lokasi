<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - SIG Lokasi</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .panel {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        #map {
            height: 400px;
            width: 100%;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        button {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 10px;
        }
        button:hover {
            background: #45a049;
        }
        .btn-danger {
            background: #f44336;
        }
        .btn-danger:hover {
            background: #da190b;
        }
        .btn-edit {
            background: #2196F3;
        }
        .btn-edit:hover {
            background: #0b7dda;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f5f5f5;
        }
        .actions {
            display: flex;
            gap: 5px;
        }
        .actions button {
            padding: 5px 10px;
            font-size: 12px;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 3px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🔧 Admin Panel - SIG Pemetaan Lokasi</h1>
            <p>Kelola data lokasi fasilitas umum</p>
        </header>

        <div id="message"></div>

        <div class="content">
            <div class="panel">
                <h2>Form Lokasi</h2>
                <form id="formLokasi">
                    <input type="hidden" id="lokasiId">
                    <div class="form-group">
                        <label for="nama">Nama Lokasi:</label>
                        <input type="text" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude:</label>
                        <input type="number" id="latitude" step="0.000001" required>
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude:</label>
                        <input type="number" id="longitude" step="0.000001" required>
                    </div>
                    <button type="submit" id="btnSubmit">Tambah Lokasi</button>
                    <button type="button" onclick="resetForm()">Reset</button>
                </form>

                <h2 style="margin-top: 30px;">Daftar Lokasi</h2>
                <div id="tableContainer">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="lokasiTable">
                            <tr><td colspan="5">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel">
                <h2>Peta Lokasi</h2>
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.2, 106.816666], 12);
        var markers = [];

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Load lokasi dari database
        function loadLokasi() {
            fetch('api.php?action=list')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayLokasi(data.data);
                        updateMap(data.data);
                    }
                })
                .catch(error => {
                    showMessage('Error memuat data: ' + error, 'error');
                });
        }

        // Tampilkan lokasi di tabel
        function displayLokasi(lokasi) {
            var tbody = document.getElementById('lokasiTable');
            if (lokasi.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5">Tidak ada data</td></tr>';
                return;
            }

            tbody.innerHTML = lokasi.map(l => `
                <tr>
                    <td>${l.id}</td>
                    <td>${l.nama}</td>
                    <td>${l.latitude}</td>
                    <td>${l.longitude}</td>
                    <td class="actions">
                        <button class="btn-edit" onclick="editLokasi(${l.id})">Edit</button>
                        <button class="btn-danger" onclick="hapusLokasi(${l.id})">Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        // Update peta dengan marker
        function updateMap(lokasi) {
            // Hapus marker lama
            markers.forEach(m => map.removeLayer(m));
            markers = [];

            // Tambah marker baru
            lokasi.forEach(l => {
                var marker = L.marker([parseFloat(l.latitude), parseFloat(l.longitude)])
                    .addTo(map)
                    .bindPopup(`<b>${l.nama}</b><br>ID: ${l.id}`);
                markers.push(marker);
            });
        }

        // Form submit
        document.getElementById('formLokasi').addEventListener('submit', function(e) {
            e.preventDefault();
            
            var id = document.getElementById('lokasiId').value;
            var data = {
                nama: document.getElementById('nama').value,
                latitude: parseFloat(document.getElementById('latitude').value),
                longitude: parseFloat(document.getElementById('longitude').value)
            };

            var url = 'api.php';
            var method = id ? 'PUT' : 'POST';
            
            if (id) {
                data.id = parseInt(id);
            }

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    showMessage(result.message, 'success');
                    resetForm();
                    loadLokasi();
                } else {
                    showMessage(result.message, 'error');
                }
            })
            .catch(error => {
                showMessage('Error: ' + error, 'error');
            });
        });

        // Edit lokasi
        function editLokasi(id) {
            fetch(`api.php?action=get&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('lokasiId').value = data.data.id;
                        document.getElementById('nama').value = data.data.nama;
                        document.getElementById('latitude').value = data.data.latitude;
                        document.getElementById('longitude').value = data.data.longitude;
                        document.getElementById('btnSubmit').textContent = 'Update Lokasi';
                        
                        // Scroll ke form
                        document.getElementById('formLokasi').scrollIntoView({ behavior: 'smooth' });
                    }
                });
        }

        // Hapus lokasi
        function hapusLokasi(id) {
            if (!confirm('Yakin ingin menghapus lokasi ini?')) {
                return;
            }

            fetch(`api.php?id=${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    showMessage(result.message, 'success');
                    loadLokasi();
                } else {
                    showMessage(result.message, 'error');
                }
            })
            .catch(error => {
                showMessage('Error: ' + error, 'error');
            });
        }

        // Reset form
        function resetForm() {
            document.getElementById('formLokasi').reset();
            document.getElementById('lokasiId').value = '';
            document.getElementById('btnSubmit').textContent = 'Tambah Lokasi';
        }

        // Tampilkan pesan
        function showMessage(message, type) {
            var msgDiv = document.getElementById('message');
            msgDiv.className = 'message ' + type;
            msgDiv.textContent = message;
            msgDiv.style.display = 'block';
            
            setTimeout(() => {
                msgDiv.style.display = 'none';
            }, 3000);
        }

        // Load data saat halaman dimuat
        loadLokasi();
    </script>
</body>
</html>


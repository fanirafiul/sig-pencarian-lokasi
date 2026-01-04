# 🗺️ SIG Pemetaan Lokasi Fasilitas Umum

Aplikasi Sistem Informasi Geografis (SIG) sederhana untuk pemetaan lokasi fasilitas umum.

## 📋 Fitur

### Level 1 (Dasar)
- ✅ Peta interaktif dengan Leaflet.js
- ✅ Klik peta untuk tambah marker
- ✅ Popup informasi koordinat

### Level 2 (Data Tetap)
- ✅ Marker manual dengan lokasi contoh
- ✅ Data lokasi tetap (Jakarta Pusat, Monas, Bandara)

### Level 3 (Form Input)
- ✅ Form input lokasi dengan nama
- ✅ Simpan sementara di array JavaScript
- ✅ Daftar lokasi dengan fitur hapus
- ✅ Input koordinat manual

### Level 4 (Database)
- ✅ Backend PHP dengan API REST
- ✅ Database MySQL
- ✅ CRUD lengkap (Create, Read, Update, Delete)
- ✅ Admin panel untuk kelola data

## 🚀 Cara Install

### 1. Setup Database

```bash
# Import database
mysql -u root -p < database.sql
```

Atau buka phpMyAdmin dan import file `database.sql`

### 2. Konfigurasi Database

Edit file `config.php` dan sesuaikan:
- `$host` - host database (default: localhost)
- `$dbname` - nama database (default: sig_lokasi)
- `$username` - username database (default: root)
- `$password` - password database (default: kosong)

### 3. Jalankan Aplikasi

**Frontend (Level 1-3):**
- Buka `index.html` di browser
- Tidak perlu server, bisa langsung dibuka

**Backend (Level 4):**
- Pastikan PHP dan MySQL sudah terinstall
- Jalankan server PHP:
  ```bash
  php -S localhost:8000
  ```
- Buka `http://localhost:8000/index.html` untuk frontend
- Buka `http://localhost:8000/admin.php` untuk admin panel

## 📁 Struktur File

```
SIG/
├── index.html          # Frontend aplikasi (Level 1-3)
├── admin.php           # Admin panel (Level 4)
├── api.php             # API backend (Level 4)
├── config.php          # Konfigurasi database (Level 4)
├── database.sql        # Script database (Level 4)
└── README.md           # Dokumentasi
```

## 🎯 Cara Pakai

### Frontend (index.html)
1. Buka `index.html` di browser
2. Klik peta untuk tambah lokasi baru
3. Atau gunakan form untuk input manual
4. Lihat daftar lokasi di bawah peta

### Admin Panel (admin.php)
1. Buka `admin.php` di browser (perlu server PHP)
2. Tambah lokasi baru via form
3. Edit lokasi dengan klik tombol "Edit"
4. Hapus lokasi dengan klik tombol "Hapus"
5. Lihat semua lokasi di peta dan tabel

## 🔧 Teknologi

- **Peta**: Leaflet.js 1.9.4
- **Map Provider**: OpenStreetMap
- **Frontend**: HTML + JavaScript
- **Backend**: PHP
- **Database**: MySQL

## 📝 API Endpoints

### GET
- `api.php?action=list` - Ambil semua lokasi
- `api.php?action=get&id=1` - Ambil satu lokasi

### POST
- `api.php` - Tambah lokasi baru
  ```json
  {
    "nama": "Nama Lokasi",
    "latitude": -6.2,
    "longitude": 106.816666
  }
  ```

### PUT
- `api.php` - Update lokasi
  ```json
  {
    "id": 1,
    "nama": "Nama Lokasi",
    "latitude": -6.2,
    "longitude": 106.816666
  }
  ```

### DELETE
- `api.php?id=1` - Hapus lokasi

## 🎓 Level Pembelajaran

1. **Level 1**: Peta dasar dengan klik marker
2. **Level 2**: Data tetap (hardcoded)
3. **Level 3**: Form input + array JavaScript
4. **Level 4**: Database + CRUD + Admin Panel

## 📄 License

Free to use for learning purposes.

# sig-pencarian-lokasi

# 🔧 Solusi Error "Pastikan server PHP berjalan"

## ✅ Server PHP SUDAH BERJALAN!

Server PHP sudah berjalan di port 8000. Masalahnya adalah aplikasi mencoba mengakses database yang belum tersedia.

## 🎯 SOLUSI CEPAT

### Opsi 1: Gunakan Versi Standalone (TANPA Database)
**File:** `index-standalone.html`

Cara pakai:
1. Double-click file `index-standalone.html`
2. Atau buka: `http://localhost:8000/index-standalone.html`
3. ✅ Langsung bisa digunakan, tidak perlu database!

### Opsi 2: Setup Database MySQL
Jika ingin menggunakan `index.html` dengan database:

1. **Install MySQL** (jika belum)
2. **Jalankan setup database:**
   ```
   http://localhost:8000/setup.php
   ```
3. **Atau import manual:**
   ```bash
   mysql -u root -p < database.sql
   ```

### Opsi 3: Gunakan File Standalone via Server
Buka di browser:
```
http://localhost:8000/index-standalone.html
```

## 📋 Status Server

✅ **PHP Server:** Berjalan di port 8000
❌ **MySQL Database:** Belum tersedia (tidak wajib)

## 🚀 Rekomendasi

**Gunakan `index-standalone.html`** karena:
- ✅ Tidak perlu database
- ✅ Tidak perlu setup
- ✅ Langsung bisa digunakan
- ✅ Data sudah tersedia (12 lokasi)

## 📝 File yang Tersedia

1. **index-standalone.html** ← **Gunakan ini!**
   - Tanpa database
   - Tanpa setup
   - Langsung pakai

2. **index.html**
   - Perlu database MySQL
   - Perlu setup database
   - Data dari database

3. **start-server.bat**
   - Script untuk menjalankan server PHP
   - Double-click untuk start server

## 🔍 Troubleshooting

### Error: "Pastikan server PHP berjalan"
**Solusi:** Gunakan `index-standalone.html` (tidak perlu server PHP)

### Error: "Koneksi database gagal"
**Solusi:** Gunakan `index-standalone.html` (tidak perlu database)

### Port 8000 sudah digunakan?
Ganti port di `start-server.bat`:
```bash
php -S localhost:8080
```


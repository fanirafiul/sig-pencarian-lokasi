# 🚀 Cara Menggunakan Aplikasi SIG Pencarian Lokasi

## ⚠️ PENTING: Aplikasi ini TIDAK memerlukan NPM!

Aplikasi ini menggunakan:
- ✅ PHP (untuk backend/API)
- ✅ MySQL (untuk database)
- ✅ HTML + JavaScript (untuk frontend)
- ✅ Leaflet.js (via CDN, tidak perlu install)

## 📋 Langkah-langkah

### 1. Pastikan PHP sudah terinstall
```bash
php --version
```
✅ PHP sudah terinstall (PHP 8.4.2)

### 2. Pastikan MySQL sudah terinstall dan berjalan
```bash
mysql --version
```

### 3. Setup Database
Buka browser dan kunjungi:
```
http://localhost:8000/setup.php
```
Ini akan membuat database dan tabel secara otomatis.

### 4. Jalankan Server PHP
Server sudah berjalan di port 8000. Jika belum, jalankan:
```bash
php -S localhost:8000
```

### 5. Buka Aplikasi
Buka browser dan kunjungi:
```
http://localhost:8000/index.html
```

## 🎯 Fitur Aplikasi

- 🔍 **Pencarian Lokasi** - Cari lokasi berdasarkan nama
- 🗺️ **Peta Interaktif** - Lihat lokasi di peta
- 📍 **Marker** - Setiap hasil pencarian muncul sebagai marker
- 💡 **Klik untuk Fokus** - Klik hasil untuk zoom ke lokasi

## 📝 Contoh Pencarian

Coba cari:
- "Jakarta"
- "Monas"
- "Bandara"

## 🔧 Troubleshooting

### Server PHP tidak berjalan?
```bash
php -S localhost:8000
```

### Database error?
1. Pastikan MySQL berjalan
2. Buka `http://localhost:8000/setup.php`
3. Atau import manual: `mysql -u root -p < database.sql`

### Port 8000 sudah digunakan?
Ganti port:
```bash
php -S localhost:8080
```
Lalu buka: `http://localhost:8080/index.html`

## ❌ TIDAK PERLU:
- ❌ npm
- ❌ node.js
- ❌ package.json
- ❌ npm install
- ❌ composer (untuk aplikasi ini)

## ✅ SUDAH CUKUP:
- ✅ PHP
- ✅ MySQL
- ✅ Browser


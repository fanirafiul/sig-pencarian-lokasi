# 🚀 Cara Upload ke GitHub

## ✅ File sudah siap di-commit!

Repository Git sudah diinisialisasi dan semua file sudah di-commit.

## 📋 Langkah Upload ke GitHub

### 1. Buat Repository di GitHub

1. Buka https://github.com
2. Login ke akun GitHub Anda
3. Klik tombol **"+"** di kanan atas → **"New repository"**
4. Isi form:
   - **Repository name:** `sig-pencarian-lokasi` (atau nama lain)
   - **Description:** `Aplikasi Sistem Informasi Geografis untuk pencarian fasilitas umum di seluruh Indonesia`
   - **Visibility:** Pilih **Public** atau **Private**
   - **JANGAN** centang "Initialize with README" (karena sudah ada)
5. Klik **"Create repository"**

### 2. Copy URL Repository

Setelah repository dibuat, GitHub akan menampilkan URL. Copy URL tersebut, contoh:
```
https://github.com/username/sig-pencarian-lokasi.git
```

### 3. Push ke GitHub

Jalankan perintah berikut di terminal (ganti URL dengan URL repository Anda):

```bash
git remote add origin https://github.com/username/sig-pencarian-lokasi.git
git branch -M main
git push -u origin main
```

**Atau jika sudah ada remote:**
```bash
git remote set-url origin https://github.com/username/sig-pencarian-lokasi.git
git push -u origin main
```

### 4. Selesai! ✅

Repository sudah terupload ke GitHub. Anda bisa melihatnya di:
```
https://github.com/username/sig-pencarian-lokasi
```

## 📝 File yang Terupload

- ✅ `index-standalone.html` - Aplikasi utama (141 lokasi)
- ✅ `index.html` - Versi dengan database
- ✅ `api.php` - Backend API
- ✅ `config.php` - Konfigurasi database
- ✅ `database.sql` - Script database
- ✅ `admin.php` - Admin panel
- ✅ `setup.php` - Setup database
- ✅ `README.md` - Dokumentasi
- ✅ File pendukung lainnya

## 🔄 Update ke GitHub

Setelah melakukan perubahan, jalankan:

```bash
git add .
git commit -m "Deskripsi perubahan"
git push
```

## 📌 Tips

1. **Jangan upload file sensitif** seperti password di `config.php`
2. **Gunakan .gitignore** untuk file yang tidak perlu diupload
3. **Update README.md** dengan informasi terbaru
4. **Tambahkan LICENSE** jika ingin open source

## 🎯 GitHub Pages (Opsional)

Untuk membuat aplikasi bisa diakses online:

1. Buka repository di GitHub
2. Settings → Pages
3. Source: Deploy from a branch
4. Branch: main, folder: / (root)
5. Save
6. Aplikasi akan tersedia di: `https://username.github.io/sig-pencarian-lokasi/`

**Catatan:** GitHub Pages hanya support file statis, jadi `index-standalone.html` akan bekerja, tapi `index.html` yang butuh PHP tidak akan bekerja.


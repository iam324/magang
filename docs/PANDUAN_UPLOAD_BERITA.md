# PANDUAN UPLOAD BERITA DI ADMIN PANEL
Dibuat: 2025-10-21 14:16:06

## ✅ Fitur yang Telah Dibuat/Diperbaiki

### 1. Form Upload Berita
- Sudah tersedia di admin.php dalam section "Kelola Berita"
- Field yang tersedia:
  - Judul Berita (wajib)
  - Isi Berita (wajib)
  - Gambar Berita (opsional)

### 2. File add_news.php
- Telah diperbarui dengan validasi lengkap
- Fitur keamanan dan validasi:
  - Cek login admin
  - Validasi input tidak kosong
  - Validasi tipe file (hanya JPG, PNG, GIF)
  - Validasi ukuran file (maksimal 5MB)
  - Generate nama file unik untuk menghindari bentrok
  - Redirect kembali ke admin.php setelah upload
  - Menampilkan pesan sukses/error

### 3. Alert Messages
- Pesan sukses ditampilkan setelah berhasil upload
- Pesan error ditampilkan jika ada kesalahan
- Alert bisa ditutup dengan tombol close

### 4. Auto-open Section
- Section berita akan terbuka otomatis setelah upload
- Menggunakan URL parameter ?section=news

## 🚀 Cara Menggunakan Fitur Upload Berita

### Langkah 1: Login ke Admin Panel
1. Buka: http://localhost/magang/admin.php
2. Login dengan username dan password admin

### Langkah 2: Buka Section Kelola Berita
1. Klik menu "Kelola Berita" di sidebar kiri
2. Anda akan melihat form "Tambah Berita Baru"

### Langkah 3: Isi Form Upload
1. **Judul Berita**: Masukkan judul berita (wajib diisi)
2. **Isi Berita**: Masukkan konten berita (wajib diisi)
3. **Gambar Berita**: Pilih file gambar (opsional)
   - Format yang diperbolehkan: JPG, PNG, GIF
   - Ukuran maksimal: 5MB

### Langkah 4: Simpan Berita
1. Klik tombol "Simpan Berita"
2. Tunggu proses upload
3. Anda akan diarahkan kembali ke halaman admin
4. Muncul pesan sukses "Berita berhasil ditambahkan!"
5. Berita baru akan muncul di tabel "Daftar Berita"

## 📁 Struktur File

### File yang Terlibat:
1. **admin.php** - Halaman admin dengan form upload
2. **add_news.php** - Script untuk memproses upload berita
3. **db.php** - Koneksi database
4. **uploads/** - Folder untuk menyimpan gambar
5. **auth_check.php** - Validasi login admin

### Database:
- **Tabel**: articles
- **Kolom**:
  - id (INT, PRIMARY KEY, AUTO_INCREMENT)
  - title (VARCHAR 255)
  - content (TEXT)
  - image_path (VARCHAR 255)
  - created_at (TIMESTAMP)

## 🔍 Troubleshooting

### Problem 1: Tidak Bisa Upload Gambar
**Solusi:**
- Pastikan folder "uploads" ada dan memiliki permission write
- Cek ukuran file tidak lebih dari 5MB
- Pastikan format file adalah JPG, PNG, atau GIF

### Problem 2: Error "Gagal mengupload gambar"
**Solusi:**
- Cek permission folder uploads (harus 777 atau writable)
- Pastikan PHP upload_max_filesize sudah cukup besar
- Cek di php.ini:
  `
  upload_max_filesize = 10M
  post_max_size = 10M
  `

### Problem 3: Form Submit tapi Tidak Ada Respon
**Solusi:**
- Buka Console browser (F12) untuk cek error
- Pastikan sudah login sebagai admin
- Cek apakah tabel 'articles' sudah ada di database

### Problem 4: Pesan Error Tidak Muncul
**Solusi:**
- Pastikan session sudah distart di awal script
- Clear browser cache
- Hard refresh (Ctrl + Shift + R)

## 🧪 Testing

### Test 1: Upload Berita Tanpa Gambar
1. Login ke admin
2. Buka Kelola Berita
3. Isi judul dan konten saja
4. Klik Simpan
5. Harus berhasil tanpa error

### Test 2: Upload Berita Dengan Gambar
1. Login ke admin
2. Buka Kelola Berita
3. Isi judul, konten, dan pilih gambar
4. Klik Simpan
5. Gambar harus tersimpan di folder uploads

### Test 3: Validasi Input Kosong
1. Login ke admin
2. Buka Kelola Berita
3. Klik Simpan tanpa isi form
4. Browser harus menampilkan validasi HTML5

### Test 4: Cek Database
Buka: http://localhost/magang/check_db.php
- Akan menampilkan struktur tabel articles
- Menampilkan jumlah berita yang ada

## 📊 Cek Database

Untuk memastikan database sudah siap:
1. Buka: http://localhost/magang/check_db.php
2. Periksa apakah tabel 'articles' ada
3. Periksa struktur kolom sudah benar

Atau via phpMyAdmin:
1. Buka: http://localhost/phpmyadmin
2. Pilih database: db_news
3. Cek tabel: articles
4. Pastikan kolom: id, title, content, image_path, created_at

## 🎯 Fitur Tambahan yang Tersedia

### Daftar Berita
- Menampilkan semua berita yang sudah diupload
- Terurut berdasarkan tanggal terbaru
- Kolom: No, Judul, Tanggal, Aksi

### Hapus Berita
- Tombol hapus tersedia di setiap baris berita
- Konfirmasi sebelum menghapus
- File: delete_news.php

## 📝 Catatan Penting

1. **Keamanan**: File add_news.php sudah dilindungi dengan session check
2. **Validasi**: Semua input divalidasi di server-side
3. **File Naming**: Gambar diberi nama unik menggunakan timestamp + uniqid
4. **Clean Up**: Jika insert database gagal, gambar yang diupload akan dihapus
5. **User Feedback**: Selalu ada pesan sukses atau error setelah aksi

## 🔗 Link Terkait

- Admin Panel: http://localhost/magang/admin.php
- Check Database: http://localhost/magang/check_db.php
- Folder Uploads: http://localhost/magang/uploads/

## 💡 Tips

1. Gunakan gambar dengan resolusi yang sesuai (tidak terlalu besar)
2. Pastikan nama file tidak mengandung karakter special
3. Compress gambar dulu sebelum upload untuk menghemat space
4. Backup database secara berkala


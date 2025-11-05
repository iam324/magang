# PANDUAN TROUBLESHOOTING NAVIGASI ADMIN
Dibuat: 2025-10-21 14:01:48

## Cara Mengecek Apakah Perbaikan Bekerja

### 1. Buka Browser Console (F12)
- Tekan F12 di browser Chrome/Edge/Firefox
- Pilih tab "Console"
- Refresh halaman admin.php

### 2. Yang Harus Terlihat di Console:
`
Admin panel initialized
Showing section: dashboard
Section displayed: dashboard
`

### 3. Saat Klik Menu "Kelola Berita":
Console harus menampilkan:
`
Showing section: news
Section displayed: news
`

## Jika Masih Tidak Bisa Pindah Section

### Cek 1: Apakah JavaScript Error?
- Buka Console (F12)
- Lihat apakah ada error berwarna merah
- Jika ada error, copy pesannya

### Cek 2: Apakah Element Ada?
Di Console, ketik dan jalankan perintah ini:
`javascript
document.getElementById('news-section')
`
Harus mengembalikan element, bukan null.

### Cek 3: Apakah CSS Bekerja?
Di Console, ketik:
`javascript
document.querySelector('.content-section.active')
`
Harus mengembalikan element yang sedang aktif.

### Cek 4: Manual Test
Di Console, coba panggil fungsi secara manual:
`javascript
showSection('news')
`
Lihat apakah section berita muncul.

## Test File Alternatif

Saya telah membuat file test sederhana:
- File: test_navigation.html
- URL: http://localhost/magang/test_navigation.html

File ini akan menampilkan console log di halaman sehingga lebih mudah untuk debug.

## Jika Semua Sudah Benar Tapi Masih Error

Kemungkinan cache browser. Coba:
1. Hard Refresh: Ctrl + Shift + R (Chrome/Edge) atau Ctrl + F5
2. Clear Cache: Hapus cache browser untuk localhost
3. Buka di Incognito/Private Mode

## File yang Sudah Diperbaiki

✅ admin.php - Sudah ditambahkan href="#" pada semua link navigasi:
   - Dashboard
   - Kelola Berita
   - Pendaftaran
   - Pesan Kontak
   - Galeri

## Kontak Perbaikan Lebih Lanjut

Jika masih ada masalah, screenshot:
1. Browser Console (F12 > Console tab)
2. Network tab untuk melihat apakah file dimuat
3. Element tab untuk inspeksi HTML


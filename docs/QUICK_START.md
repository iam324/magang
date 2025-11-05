# 🚀 QUICK START GUIDE - TK PERTIWI 14

## Setup Cepat (5 Menit!)

### 1️⃣ Setup Database
Buka browser dan kunjungi:
```
http://localhost/magang/setup_admin.php
```
✅ Ini akan membuat semua tabel dan akun admin

### 2️⃣ Login Admin
```
URL: http://localhost/magang/login.php
Username: admin
Password: admin123
```

### 3️⃣ Akses Website
```
http://localhost/magang/index.php
```

## 🎨 Fitur-Fitur Baru

### Halaman Publik
✅ Homepage dengan animasi modern
✅ Sistem berita dengan featured article
✅ Galeri foto dengan filter kategori
✅ Halaman testimoni dengan rating
✅ Form kontak yang berfungsi
✅ Form pendaftaran siswa baru
✅ FAQ (Frequently Asked Questions)
✅ WhatsApp floating button
✅ Scroll to top button
✅ Fully responsive design

### Admin Panel (Perlu Login)
✅ Dashboard dengan statistik
✅ Kelola berita (tambah, lihat, hapus)
✅ Data pendaftaran siswa
✅ Pesan dari form kontak
✅ Modern sidebar navigation
✅ Sistem authentication yang aman

## 📸 Menu Navigasi

**Website Publik:**
- HOME - Halaman utama
- BERITA - Berita dan artikel
- GALERI - Foto kegiatan
- TESTIMONI - Pendapat orang tua
- KONTAK - Hubungi kami
- PENDAFTARAN - Daftar siswa baru

**Admin Panel:**
- Dashboard - Overview sistem
- Kelola Berita - CRUD berita
- Pendaftaran - Data calon siswa
- Pesan Kontak - Inbox pesan
- Galeri - Manage photos (coming soon)
- Testimoni - Approve reviews (coming soon)

## 🎯 Yang Harus Dilakukan

### Pertama Kali:
1. ✅ Run setup_admin.php
2. ✅ Login ke admin panel
3. ⚠️ **UBAH PASSWORD DEFAULT!**
4. ✅ Tambahkan berita pertama
5. ✅ Upload logo sekolah (tkper.png)
6. ✅ Update nomor WhatsApp di semua halaman

### Customisasi:
- Ganti nomor WA: `628123456789` → Nomor WA sekolah
- Ganti email: `tkpertiwi14@email.com` → Email resmi sekolah
- Update alamat di footer setiap halaman
- Upload logo baru (ganti tkper.png)

## 🔧 Troubleshooting

**Login gagal?**
- Pastikan sudah run setup_admin.php
- Clear browser cache

**Gambar tidak muncul?**
- Folder uploads/ sudah ada dan writable

**Database error?**
- Cek MySQL berjalan
- Cek db.php untuk kredensial
- Pastikan database db_news sudah ada

## 📞 Kontak yang Perlu Diganti

Cari dan ganti di semua file:
- `+62 812-3456-7890` → Nomor telepon sekolah
- `628123456789` → Nomor WhatsApp (tanpa +)
- `tkpertiwi14@email.com` → Email sekolah
- `opertiwisemarang@email.com` → Email alternatif

## 🎨 Warna Theme

Primary Color: Green (#00e676, #00b359)
Untuk mengubah, edit CSS di:
- style.css
- Inline styles di setiap halaman

## 🔐 Keamanan

✅ Password di-hash dengan PHP password_hash()
✅ SQL Injection protected (prepared statements)
✅ Session-based authentication
✅ File upload validation

**PENTING**: 
- Ubah password admin setelah instalasi!
- Backup database secara rutin!
- Gunakan HTTPS untuk production!

## 📊 Database Tables

1. **admin_users** - Admin accounts
2. **articles** - News/articles
3. **registrations** - Student registrations
4. **contacts** - Contact form messages
5. **gallery** - Photo gallery
6. **testimonials** - Parent testimonials

## 🚀 Next Steps

Setelah setup:
1. Login ke admin panel
2. Tambahkan beberapa berita
3. Test form pendaftaran
4. Test form kontak
5. Upload foto ke galeri (jika fitur sudah ready)
6. Approve testimoni yang masuk

## 💡 Tips

- Gunakan gambar dengan ukuran optimal (max 2MB)
- Tulis berita yang menarik dan informatif
- Balas pesan kontak dengan cepat
- Update berita secara berkala
- Backup database setiap minggu

## 📱 Mobile Friendly

Website sudah fully responsive!
- ✅ Mobile phones
- ✅ Tablets
- ✅ Desktops
- ✅ Large screens

Test di berbagai device untuk hasil terbaik.

---

**Selamat! Website TK Pertiwi 14 siap digunakan! 🎉**

Untuk pertanyaan lebih lanjut, baca README.md yang lebih lengkap.

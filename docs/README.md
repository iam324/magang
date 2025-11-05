# TK PERTIWI 14 - Website Resmi

Website resmi TK Pertiwi 14 Semarang dengan fitur lengkap dan desain modern.

## 🎯 Fitur Utama

### Halaman Publik
- **Homepage** - Tampilan modern dengan animasi dan statistik
- **Berita** - Sistem berita dengan featured article dan grid layout
- **Galeri** - Galeri foto dengan filter kategori dan lightbox
- **Testimoni** - Testimoni orang tua dengan rating system
- **Kontak** - Form kontak dengan Google Maps integration
- **Pendaftaran** - Form pendaftaran siswa baru yang lengkap
- **FAQ** - Pertanyaan yang sering diajukan

### Fitur Tambahan
- WhatsApp floating button untuk chat cepat
- Scroll to top button
- Responsive design (Mobile, Tablet, Desktop)
- Animasi smooth dengan Animate.css
- Icon Font Awesome
- Bootstrap 5 framework

### Admin Panel
- **Dashboard** - Statistik dan overview sistem
- **Kelola Berita** - CRUD berita dengan upload gambar
- **Data Pendaftaran** - Lihat dan kelola pendaftaran siswa
- **Pesan Kontak** - Lihat pesan dari form kontak
- **Galeri** - Kelola foto galeri (dalam pengembangan)
- **Testimoni** - Approve/reject testimoni (dalam pengembangan)
- **Sistem Login** - Authentication system yang aman

## 📋 Persyaratan

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web Server (Apache/Nginx) - XAMPP recommended
- Browser modern (Chrome, Firefox, Edge, Safari)

## 🚀 Instalasi

### 1. Clone/Download Project
```bash
# Letakkan di folder htdocs (jika menggunakan XAMPP)
C:\xampp\htdocs\magang\
```

### 2. Buat Database
```sql
CREATE DATABASE db_news;
```

### 3. Setup Admin dan Tabel
Buka browser dan akses:
```
http://localhost/magang/setup_admin.php
```

Ini akan:
- Membuat semua tabel yang diperlukan
- Membuat akun admin default
  - Username: `admin`
  - Password: `admin123`

### 4. Login ke Admin Panel
```
http://localhost/magang/login.php
```

## 📁 Struktur File

```
magang/
├── index.php              # Homepage
├── news.php               # Halaman berita
├── article.php            # Detail berita
├── gallery.php            # Galeri foto
├── testimonials.php       # Halaman testimoni
├── contact.php            # Halaman kontak
├── registration.php       # Form pendaftaran
├── login.php              # Login admin
├── admin.php              # Admin panel
├── logout.php             # Logout
├── auth_check.php         # Authentication middleware
├── db.php                 # Database connection
├── setup_admin.php        # Database setup
├── add_news.php           # Handler tambah berita
├── delete_news.php        # Handler hapus berita
├── submit_contact.php     # Handler form kontak
├── submit_registration.php # Handler pendaftaran
├── submit_testimonial.php  # Handler testimoni
├── style.css              # Custom CSS
├── uploads/               # Folder upload files
└── tkper.png              # Logo sekolah
```

## 🎨 Desain & Teknologi

- **CSS Framework**: Bootstrap 5.3.0
- **Icons**: Font Awesome 6.0.0
- **Animations**: Animate.css 4.1.1
- **Color Scheme**: Green (#00e676, #00b359)
- **Typography**: System fonts (responsive)

## 🔐 Keamanan

- Password hashing dengan PHP password_hash()
- Session-based authentication
- SQL Prepared statements (mencegah SQL injection)
- Input validation dan sanitization
- File upload validation (type dan size)

## 📊 Database Schema

### Tables:
1. **admin_users** - Data admin
2. **articles** - Berita/artikel
3. **registrations** - Pendaftaran siswa
4. **contacts** - Pesan kontak
5. **gallery** - Foto galeri
6. **testimonials** - Testimoni orang tua

## 🛠️ Customisasi

### Mengubah Warna
Edit file `style.css`:
```css
:root {
    --bs-success: #00e676;  /* Warna utama */
}
```

### Mengubah Logo
Ganti file `tkper.png` dengan logo baru (recommended: 200x200px, PNG dengan background transparan)

### Mengubah Kontak
Edit di setiap halaman bagian footer atau contact.php

### Mengubah WhatsApp Number
Cari dan ganti `628123456789` dengan nomor WhatsApp sekolah

## 📱 Responsive Breakpoints

- **Mobile**: < 768px
- **Tablet**: 768px - 991px
- **Desktop**: ≥ 992px

## ⚡ Performance

- Lazy loading images
- Minified CSS/JS dari CDN
- Optimized database queries
- Caching dengan browser cache headers

## 🐛 Troubleshooting

### Error: "Connection failed"
- Pastikan MySQL berjalan
- Cek kredensial di `db.php`
- Pastikan database `db_news` sudah dibuat

### Gambar tidak muncul
- Pastikan folder `uploads/` ada dan writable
- Chmod 755 atau 777 untuk folder uploads

### Login gagal
- Pastikan sudah run `setup_admin.php`
- Default: username `admin`, password `admin123`
- Clear browser cache

## 📝 TODO / Future Features

- [ ] Edit berita
- [ ] Approve/reject pendaftaran dengan email notification
- [ ] Gallery management di admin
- [ ] Testimonial approval system
- [ ] Export data to Excel
- [ ] Statistics charts di dashboard
- [ ] Multi-language support
- [ ] SEO optimization
- [ ] PWA (Progressive Web App)

## 👥 Credit

Developed for TK Pertiwi 14 Semarang
- Bootstrap Team for Bootstrap Framework
- Font Awesome Team for Icons
- Animate.css for animations

## 📄 License

Proprietary - © 2025 TK Pertiwi 14. All rights reserved.

## 📞 Support

Untuk bantuan atau pertanyaan:
- Email: tkpertiwi14@email.com
- Phone: +62 812-3456-7890
- WhatsApp: +62 812-3456-7890

---

**PENTING**: Setelah instalasi pertama, segera:
1. Ubah password admin default
2. Backup database secara berkala
3. Update kredensial database dengan password yang kuat
4. Aktifkan HTTPS untuk production

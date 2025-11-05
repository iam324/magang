# Update Floating Buttons - TK Pertiwi 14

## Tanggal: 21 Oktober 2025

## Ringkasan
Semua floating buttons di website TK Pertiwi 14 telah disamakan dengan standar yang ada di halaman home (index.php) untuk memberikan pengalaman pengguna yang konsisten di seluruh website.

## File yang Diperbarui
1. ✅ news.php
2. ✅ gallery.php
3. ✅ contact.php
4. ✅ registration.php
5. ✅ article.php

## Floating Buttons yang Ditambahkan

### 1. WhatsApp Floating Button (Hijau)
**Spesifikasi:**
- **Posisi**: Bottom right (20px dari bawah, 20px dari kanan)
- **Ukuran**: 60px × 60px
- **Warna**: Success green (btn-success)
- **Shape**: Rounded circle
- **Shadow**: shadow-lg untuk depth effect
- **Icon**: WhatsApp icon (fab fa-whatsapp fa-2x)
- **Link**: https://wa.me/628123456789
- **Pre-filled message**: "Halo TK Pertiwi 14, saya ingin bertanya tentang pendaftaran"
- **Tooltip**: "Chat via WhatsApp"
- **Z-index**: 1000
- **Target**: Opens in new tab

**Kode:**
```html
<a href="https://wa.me/628123456789?text=Halo%20TK%20Pertiwi%2014%2C%20saya%20ingin%20bertanya%20tentang%20pendaftaran" 
   class="btn btn-success position-fixed rounded-circle shadow-lg" 
   style="bottom: 20px; right: 20px; width: 60px; height: 60px; z-index: 1000; display: flex; align-items: center; justify-content: center;" 
   target="_blank"
   title="Chat via WhatsApp">
    <i class="fab fa-whatsapp fa-2x"></i>
</a>
```

### 2. Scroll to Top Button (Hitam)
**Spesifikasi:**
- **Posisi**: Bottom right (90px dari bawah, 20px dari kanan) - di atas WhatsApp button
- **Ukuran**: 50px × 50px
- **Warna**: Dark (btn-dark)
- **Shape**: Rounded circle
- **Shadow**: shadow-lg
- **Icon**: Arrow up (fas fa-arrow-up)
- **Visibility**: Hidden by default, muncul setelah scroll 300px
- **Animation**: Smooth scroll ke top
- **Z-index**: 999
- **Behavior**: Auto show/hide berdasarkan scroll position

**Kode:**
```html
<button onclick="scrollToTop()" id="scrollTopBtn" class="btn btn-dark position-fixed rounded-circle shadow-lg" 
        style="bottom: 90px; right: 20px; width: 50px; height: 50px; display: none; z-index: 999;">
    <i class="fas fa-arrow-up"></i>
</button>
```

## JavaScript Functionality

### Scroll to Top Script
```javascript
// Scroll to Top functionality
window.onscroll = function() {
    var scrollTopBtn = document.getElementById("scrollTopBtn");
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        scrollTopBtn.style.display = "flex";
        scrollTopBtn.style.alignItems = "center";
        scrollTopBtn.style.justifyContent = "center";
    } else {
        scrollTopBtn.style.display = "none";
    }
};

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
```

**Cara Kerja:**
1. Mendeteksi posisi scroll menggunakan `window.onscroll`
2. Menampilkan button saat user scroll lebih dari 300px
3. Menyembunyikan button saat di posisi atas
4. Smooth scroll animation saat button diklik

## Perubahan Khusus per Halaman

### article.php
- **Dihapus**: "Back to News" button floating di kiri bawah
- **Alasan**: Menghindari terlalu banyak floating buttons yang mengganggu
- **Alternatif**: Tombol "Kembali ke Berita" masih tersedia di dalam konten artikel (di card footer)

### gallery.php
- **Dipertahankan**: Gallery filter dan modal image scripts
- **Ditambahkan**: Scroll to top functionality
- **Integrasi**: Scripts berjalan harmonis tanpa conflict

### registration.php
- **Dipertahankan**: Form validation script
- **Ditambahkan**: Scroll to top functionality
- **Benefit**: User dapat dengan mudah scroll ke atas setelah mengisi form panjang

### news.php & contact.php
- **Update**: Simple addition dari kedua floating buttons
- **No conflicts**: Tidak ada script khusus yang perlu dipertahankan

## Keuntungan Implementasi

### User Experience (UX)
1. **Konsistensi**: Semua halaman memiliki navigasi yang sama
2. **Accessibility**: Mudah menghubungi sekolah dari halaman mana pun
3. **Convenience**: Scroll to top mengurangi effort navigasi
4. **Professional**: Tampilan modern dan clean

### Technical Benefits
1. **Standardization**: Code yang uniform di semua halaman
2. **Maintainability**: Mudah untuk update di masa depan
3. **Performance**: JavaScript yang efficient
4. **Responsive**: Bekerja baik di desktop dan mobile

### Business Benefits
1. **Lead Generation**: WhatsApp button memudahkan calon orang tua untuk kontak
2. **Pre-filled Message**: Mengurangi friction dalam komunikasi awal
3. **Engagement**: User lebih lama di website karena navigasi yang mudah

## Testing Checklist
- ✅ Semua file validated tanpa syntax error
- ✅ WhatsApp button berfungsi dengan pre-filled message
- ✅ Scroll to top button muncul/hilang dengan benar
- ✅ Smooth scroll animation bekerja
- ✅ Tidak ada conflict dengan scripts lain
- ✅ Z-index tidak overlap dengan elemen lain
- ✅ Responsive di berbagai ukuran layar

## Browser Compatibility
- ✅ Chrome/Edge (Modern browsers)
- ✅ Firefox
- ✅ Safari
- ✅ Mobile browsers (iOS/Android)

## Future Improvements (Optional)
1. Add fade-in/out animation untuk scroll button
2. Customize WhatsApp message per halaman
3. Add tooltip animation
4. Track button clicks via analytics
5. Add more floating action buttons (FAB) jika diperlukan

## Notes
- Buttons tidak mengganggu konten utama
- Posisi fixed memastikan selalu terlihat
- Z-index diatur untuk hierarchy yang benar
- Shadow memberikan depth dan visibility

# Panduan Cepat: Cara Verifikasi Pendaftaran

## 🚀 Quick Start (3 Langkah Mudah!)

### Langkah 1: Buka Menu Pendaftaran
```
1. Login ke admin: http://localhost/magang/login.php
2. Klik "Pendaftaran" di sidebar kiri
```

### Langkah 2: Lihat Pendaftaran Pending
```
Cari row dengan badge kuning "Pending"
```

### Langkah 3: Approve atau Reject
```
Pilih salah satu:
• Klik tombol HIJAU (✓) = Setujui
• Klik tombol MERAH (×) = Tolak
• Klik tombol MATA (👁️) = Lihat detail dulu
```

---

## 📸 Visual Guide

### Tampilan Tabel
```
┌───────────────────────────────────────────────────────────────────┐
│ Data Pendaftaran                                                  │
├────┬──────────┬────────────┬──────────┬──────────┬─────────┬─────┤
│ No │ Nama     │ Tgl Lahir  │ Ortu     │ Kontak   │ Status  │ Aksi│
├────┼──────────┼────────────┼──────────┼──────────┼─────────┼─────┤
│ 1  │ Ahmad    │ 10/05/2019 │ Ibu Siti │ 0812...  │ Pending │ 👁️✅❌│
│    │          │            │          │ siti@... │  ⚠️    │     │
├────┼──────────┼────────────┼──────────┼──────────┼─────────┼─────┤
│ 2  │ Putri    │ 20/03/2020 │ Pak Budi │ 0813...  │Approved │ 👁️ │
│    │          │            │          │ budi@... │  ✅    │Sudah│
└────┴──────────┴────────────┴──────────┴──────────┴─────────┴─────┘
```

### Tombol Aksi Explained
```
[👁️]  = Lihat Detail
        Klik ini untuk melihat info lengkap

[✅]  = Setujui
        Klik ini untuk approve pendaftaran

[❌]  = Tolak
        Klik ini untuk reject pendaftaran

[Diproses] = Sudah Diproses
             Tidak bisa diubah lagi
```

---

## 🎯 Cara 1: Verifikasi Langsung (Cepat)

### Untuk Approve:
```
1. Lihat row dengan status "Pending"
2. Klik tombol HIJAU (✅)
3. Popup konfirmasi muncul:
   "Apakah Anda yakin ingin menyetujui pendaftaran ini?"
4. Klik OK
5. ✅ Done! Status berubah jadi "Approved"
```

### Untuk Reject:
```
1. Lihat row dengan status "Pending"
2. Klik tombol MERAH (❌)
3. Popup konfirmasi muncul:
   "Apakah Anda yakin ingin menolak pendaftaran ini?"
4. Klik OK
5. ✅ Done! Status berubah jadi "Rejected"
```

---

## 👁️ Cara 2: Lihat Detail Dulu (Recommended)

### Step by Step:
```
1. Klik tombol MATA (👁️)

2. Modal popup muncul dengan info:
   ┌──────────────────────────────────────┐
   │ 📋 Detail Pendaftaran                │
   ├──────────────────────────────────────┤
   │ 👶 Data Anak:                        │
   │    • Nama: Ahmad Zaki                │
   │    • Tgl Lahir: 10/05/2019           │
   │    • Usia: 5 tahun ✅                │
   │                                      │
   │ 👨 Data Orang Tua:                   │
   │    • Nama: Ibu Siti                  │
   │    • Email: siti@email.com           │
   │    • Telepon: 0812-3456-7890         │
   │                                      │
   │ 🏠 Alamat:                           │
   │    Jl. Contoh No. 123, Semarang      │
   │                                      │
   │ 💬 Pesan:                            │
   │    Anak saya sangat antusias...      │
   ├──────────────────────────────────────┤
   │ [✅ Setujui] [❌ Tolak] [Tutup]      │
   └──────────────────────────────────────┘

3. Review semua data

4. Klik tombol:
   • [✅ Setujui Pendaftaran] = Approve
   • [❌ Tolak Pendaftaran] = Reject
   • [Tutup] = Batal, tidak ada perubahan

5. ✅ Done!
```

---

## ⚠️ Hal yang Perlu Diperhatikan

### Cek Usia Anak:
```
✅ SESUAI SYARAT TK:
   4 tahun → Boleh
   5 tahun → Boleh
   6 tahun → Boleh

❌ TIDAK SESUAI:
   3 tahun → Terlalu muda
   7 tahun → Terlalu tua
```

### Cek Kelengkapan Data:
```
Data Wajib:
✓ Nama anak
✓ Tanggal lahir
✓ Nama orang tua
✓ Email
✓ Telepon
✓ Alamat

Data Opsional:
• Pesan/catatan
```

### Decision Guide:
```
APPROVE ✅ Jika:
• Usia anak 4-6 tahun
• Data lengkap & valid
• Tidak ada red flag

REJECT ❌ Jika:
• Usia tidak sesuai
• Data tidak lengkap/invalid
• Ada masalah lain

PENDING ⚠️ Jika:
• Perlu klarifikasi
• Menunggu dokumen
• Perlu diskusi dengan kepala sekolah
```

---

## 🎨 Status Badge Explained

```
⚠️ PENDING (Kuning)
   = Belum diproses
   = Perlu action dari admin
   = Tombol aksi AKTIF

✅ APPROVED (Hijau)
   = Sudah disetujui
   = Pendaftaran diterima
   = Tombol aksi TIDAK AKTIF

❌ REJECTED (Merah)
   = Sudah ditolak
   = Pendaftaran ditolak
   = Tombol aksi TIDAK AKTIF
```

---

## 💡 Tips & Best Practices

### DO ✅:
```
✓ Cek detail sebelum approve/reject
✓ Verifikasi usia dari tanggal lahir
✓ Pastikan data lengkap
✓ Proses dalam 1-2 hari kerja
✓ Follow up jika reject (telepon/email)
```

### DON'T ❌:
```
✗ Jangan approve tanpa cek detail
✗ Jangan reject tanpa alasan jelas
✗ Jangan biarkan pending terlalu lama
✗ Jangan lupa follow up ke orang tua
```

---

## 🆘 Troubleshooting

### Problem 1: Tombol tidak berfungsi
```
Solution:
• Refresh halaman (F5)
• Clear browser cache
• Logout dan login lagi
```

### Problem 2: Status tidak berubah
```
Solution:
• Cek koneksi internet
• Cek apakah sudah klik OK di konfirmasi
• Refresh halaman
```

### Problem 3: Modal tidak muncul
```
Solution:
• Cek browser console (F12)
• Refresh halaman
• Pastikan JavaScript aktif
```

---

## 📞 Need Help?

```
Jika masih bingung:
1. Baca dokumentasi lengkap: FITUR_VERIFIKASI_PENDAFTARAN.md
2. Hubungi IT support
3. Tanya admin lain yang sudah paham
```

---

## ✅ Checklist Verifikasi

```
Sebelum APPROVE, pastikan:
☐ Nama anak jelas
☐ Usia 4-6 tahun
☐ Data orang tua lengkap
☐ Kontak valid (email & telepon)
☐ Alamat jelas
☐ Tidak ada data mencurigakan

Setelah APPROVE/REJECT:
☐ Status berubah di sistem
☐ Follow up ke orang tua (telepon/email)
☐ Catat di buku/sistem lain (jika ada)
☐ Koordinasi dengan bagian administrasi
```

---

**Mudah kan? Selamat mencoba!** 🎉

**Quick Reference:**
- 👁️ = Lihat Detail
- ✅ = Approve (Setujui)
- ❌ = Reject (Tolak)
- ⚠️ = Pending (Belum diproses)

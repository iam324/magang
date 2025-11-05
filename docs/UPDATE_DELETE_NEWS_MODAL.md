# Update: Modal Konfirmasi Hapus Berita

## Tanggal: 21 Oktober 2025

## Ringkasan
Sistem hapus berita telah diupgrade dari menggunakan pop-up browser native (`confirm()`) menjadi Bootstrap Modal yang lebih modern, informatif, dan user-friendly. Setelah menghapus berita, user akan tetap berada di halaman Kelola Berita (tidak redirect ke dashboard).

## File yang Dimodifikasi
1. **admin.php** - Menambahkan modal konfirmasi dan fungsi JavaScript
2. **delete_news.php** - Menambahkan session messages dan redirect ke section news

## Perubahan Detail

### 1. Dari Browser Confirm ke Bootstrap Modal

#### SEBELUM:
```javascript
<form action='delete_news.php' method='post' onsubmit='return confirm("Hapus berita ini?");'>
    <input type='hidden' name='id' value='<?php echo $row["id"]; ?>'>
    <button type='submit' class='btn btn-sm btn-danger'>
        <i class="fas fa-trash"></i> Hapus
    </button>
</form>
```

**Masalah:**
- Pop-up sederhana tanpa detail
- Tampilan tergantung browser
- Tidak bisa dikustomisasi
- Hanya text konfirmasi basic
- Tidak ada visual cues

#### SESUDAH:
```javascript
<button type='button' class='btn btn-sm btn-danger' 
        onclick='confirmDelete(<?php echo $row["id"]; ?>, "<?php echo htmlspecialchars(addslashes($row["title"])); ?>")'>
    <i class="fas fa-trash"></i> Hapus
</button>
```

**Keuntungan:**
- Modal Bootstrap yang modern
- Menampilkan judul berita yang akan dihapus
- Warning visual yang jelas
- Alert box dengan informasi lengkap
- Tombol yang lebih deskriptif

### 2. Modal Konfirmasi (Bootstrap)

```html
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Berita
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Apakah Anda yakin ingin menghapus berita ini?</p>
                <div class="alert alert-warning">
                    <strong><i class="fas fa-file-alt"></i> Judul:</strong>
                    <p class="mb-0" id="newsTitle"></p>
                </div>
                <p class="text-muted mb-0">
                    <small><i class="fas fa-info-circle"></i> Berita yang sudah dihapus tidak dapat dikembalikan.</small>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form id="deleteForm" action="delete_news.php" method="post">
                    <input type="hidden" name="id" id="deleteNewsId">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus Berita
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
```

**Fitur Modal:**
- Header merah (bg-danger) dengan icon warning
- Body dengan pertanyaan konfirmasi
- Alert box kuning menampilkan judul berita
- Peringatan bahwa data tidak dapat dikembalikan
- Footer dengan 2 tombol: Batal (secondary) dan Ya, Hapus (danger)
- Modal centered di layar
- Close button dan backdrop dismiss

### 3. Fungsi JavaScript

```javascript
function confirmDelete(newsId, newsTitle) {
    // Set the news ID in the hidden input
    document.getElementById('deleteNewsId').value = newsId;
    // Set the news title in the modal
    document.getElementById('newsTitle').textContent = newsTitle;
    // Show the modal
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
```

**Cara Kerja:**
1. Menerima parameter `newsId` dan `newsTitle`
2. Set ID ke hidden input dalam form
3. Set judul berita ke elemen modal
4. Instantiate dan show modal menggunakan Bootstrap API

### 4. Redirect dan Notification

#### delete_news.php - SEBELUM:
```php
if ($stmt_delete->execute()) {
    header("Location: admin.php");
    exit();
}
```

**Masalah:**
- Redirect ke dashboard
- Tidak ada notifikasi
- User harus klik menu "Kelola Berita" lagi

#### delete_news.php - SESUDAH:
```php
if ($stmt_delete->execute()) {
    // Delete the image file if exists
    if (!empty($image_path) && file_exists($image_path)) {
        unlink($image_path);
    }
    
    // Set success message
    $_SESSION['success_message'] = "Berita \"" . htmlspecialchars($article_title) . "\" berhasil dihapus!";
} else {
    // Set error message
    $_SESSION['error_message'] = "Gagal menghapus berita. Error: " . $conn->error;
}

// Redirect to admin page, news section
header("Location: admin.php?section=news");
exit();
```

**Keuntungan:**
- Redirect ke section news (`?section=news`)
- User tetap di halaman Kelola Berita
- Success/error message menggunakan session
- Menampilkan judul berita yang dihapus
- Lebih efisien dan user-friendly

### 5. Success/Error Alerts

Alert sudah ada di admin.php untuk menampilkan session messages:

```php
<?php if (isset($_SESSION['success_message'])): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success_message']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php unset($_SESSION['success_message']); endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_SESSION['error_message']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php unset($_SESSION['error_message']); endif; ?>
```

## Alur Proses Lengkap

1. **User klik tombol "Hapus"** di tabel berita
2. **JavaScript `confirmDelete()` dipanggil** dengan ID dan judul berita
3. **Modal konfirmasi ditampilkan** dengan detail berita
4. **User memilih:**
   - **Batal** → Modal ditutup, tidak ada perubahan
   - **Ya, Hapus Berita** → Form di-submit ke `delete_news.php`
5. **delete_news.php memproses:**
   - Get data berita (judul dan image path)
   - Hapus berita dari database
   - Hapus file gambar jika ada
   - Set success/error message ke session
6. **Redirect ke `admin.php?section=news`**
7. **Admin panel menampilkan:**
   - Otomatis membuka section "Kelola Berita"
   - Success alert: "Berita '[judul]' berhasil dihapus!"
   - User tetap di halaman yang sama

## Keamanan

### XSS Prevention
```php
// Escaping untuk JavaScript
onclick='confirmDelete(<?php echo $row["id"]; ?>, "<?php echo htmlspecialchars(addslashes($row["title"])); ?>")'

// Escaping untuk output HTML
$_SESSION['success_message'] = "Berita \"" . htmlspecialchars($article_title) . "\" berhasil dihapus!";
```

### SQL Injection Prevention
```php
// Using prepared statements
$stmt_delete = $conn->prepare("DELETE FROM articles WHERE id = ?");
$stmt_delete->bind_param("i", $article_id);
```

### Integer Validation
```php
$article_id = intval($_POST['id']);
```

## Manfaat Upgrade

### User Experience
- ✅ Konfirmasi yang lebih informatif
- ✅ Visual yang menarik dan profesional
- ✅ User tetap di halaman yang sama
- ✅ Feedback jelas tentang hasil operasi
- ✅ Mencegah kesalahan hapus dengan detail lengkap

### Technical
- ✅ Menggunakan Bootstrap components
- ✅ Session flash messages
- ✅ Proper error handling
- ✅ XSS dan SQL injection prevention
- ✅ Clean redirect dengan URL parameters

### Maintenance
- ✅ Mudah dikustomisasi styling
- ✅ Reusable pattern untuk delete operations lain
- ✅ Clear separation of concerns
- ✅ Documented code

## Testing Checklist
- ✅ Modal muncul dengan benar
- ✅ Judul berita ditampilkan di modal
- ✅ Tombol Batal menutup modal
- ✅ Tombol Ya menghapus berita
- ✅ File gambar terhapus dari server
- ✅ Success message ditampilkan
- ✅ User tetap di section news
- ✅ Tidak ada syntax error
- ✅ XSS prevention berfungsi
- ✅ Works di berbagai browser

## Future Improvements (Optional)
1. Undo functionality (soft delete)
2. Bulk delete dengan checkbox
3. Animation transitions untuk modal
4. Toast notifications sebagai alternatif alert
5. Audit log untuk tracking delete operations

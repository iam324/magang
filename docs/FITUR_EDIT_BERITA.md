# Fitur Edit Berita - TK Pertiwi 14

## Tanggal: 21 Oktober 2025

## Ringkasan
Fitur edit berita telah ditambahkan ke sistem admin TK Pertiwi 14. Admin sekarang dapat mengedit berita yang sudah dipublikasikan, termasuk mengubah judul, konten, dan gambar.

## File yang Dibuat
1. **edit_news.php** - Halaman form edit berita dengan preview gambar
2. **update_news.php** - Handler untuk memproses update berita

## File yang Dimodifikasi
1. **admin.php** - Menambahkan tombol Edit di tabel berita

## Fitur Lengkap

### 1. Tombol Edit di Admin Panel

**Lokasi:** admin.php - Section Kelola Berita - Tabel Daftar Berita

**Tampilan:**
```html
<div class="btn-group" role="group">
    <a href='edit_news.php?id=<?php echo $row["id"]; ?>' class='btn btn-sm btn-warning'>
        <i class="fas fa-edit"></i> Edit
    </a>
    <button type='button' class='btn btn-sm btn-danger' onclick='confirmDelete(...)'>
        <i class="fas fa-trash"></i> Hapus
    </button>
</div>
```

**Fitur:**
- Tombol kuning/warning untuk indikasi edit
- Icon Font Awesome (fa-edit)
- Button group bersama tombol Hapus
- Link ke halaman edit dengan parameter ID

### 2. Halaman Edit Berita (edit_news.php)

**Fitur Utama:**

#### a. Authentication Check
```php
require_once 'auth_check.php';
```
- Hanya admin yang login dapat mengakses
- Redirect ke login jika belum login

#### b. Validasi ID
```php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = "ID berita tidak valid.";
    header("Location: admin.php?section=news");
    exit();
}
```
- Validasi parameter ID dari URL
- Error message jika ID tidak valid
- Redirect ke section news

#### c. Fetch Data Berita
```php
$stmt = $conn->prepare("SELECT id, title, content, image_path FROM articles WHERE id = ?");
$stmt->bind_param("i", $article_id);
```
- Mengambil data berita dari database
- Prepared statement untuk keamanan
- Error handling jika berita tidak ditemukan

#### d. Form Edit dengan Pre-filled Data
```html
<input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
<textarea name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>
```
- Field pre-filled dengan data existing
- XSS prevention dengan htmlspecialchars()
- Required validation

#### e. Preview Gambar Saat Ini
```php
<?php if (!empty($article['image_path']) && file_exists($article['image_path'])): ?>
    <div class="mb-2">
        <p class="text-muted mb-2"><small>Gambar saat ini:</small></p>
        <img src="<?php echo htmlspecialchars($article['image_path']); ?>" 
             alt="Current Image" class="preview-image border">
    </div>
<?php endif; ?>
```
- Menampilkan preview gambar jika ada
- Max width/height 300px
- Rounded corners dan border
- File existence check

#### f. Upload Gambar Baru (Opsional)
```html
<input type="file" name="image" class="form-control" accept="image/*">
<small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
```
- Optional image upload
- Tetap pakai gambar lama jika tidak upload
- Accept only image files

#### g. Hidden Fields
```html
<input type="hidden" name="id" value="<?php echo $article['id']; ?>">
<input type="hidden" name="old_image" value="<?php echo htmlspecialchars($article['image_path']); ?>">
```
- ID untuk identify artikel
- old_image untuk reference saat delete

#### h. Action Buttons
- **Simpan Perubahan** (btn-success)
- **Batal** (btn-secondary) - Link ke admin.php?section=news

#### i. Info Box dengan Tips
- Tips untuk admin saat edit berita
- Alert box Bootstrap (alert-info)
- Bullet list dengan guidelines

### 3. Update Handler (update_news.php)

**Alur Proses:**

#### a. Authentication & Method Check
```php
session_start();
require_once 'auth_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process update
}
```

#### b. Get & Validate Input
```php
$article_id = intval($_POST['id']);
$title = trim($_POST['title']);
$content = trim($_POST['content']);
$old_image = $_POST['old_image'];

if (empty($title) || empty($content)) {
    $_SESSION['error_message'] = "Judul dan isi berita harus diisi.";
    header("Location: edit_news.php?id=" . $article_id);
    exit();
}
```
- Integer validation untuk ID
- Trim whitespace
- Required field validation
- Error message dan redirect back jika error

#### c. Handle Image Upload
```php
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (in_array($filetype, $allowed)) {
        // Generate unique filename
        $new_filename = uniqid() . '_' . time() . '.' . $filetype;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            // Delete old image
            if (!empty($old_image) && file_exists($old_image)) {
                unlink($old_image);
            }
            $image_path = $destination;
        }
    }
}
```
**Fitur Upload:**
- Check if new image uploaded
- File type validation (JPG, JPEG, PNG, GIF)
- Generate unique filename (uniqid + timestamp)
- Upload to uploads/ directory
- Delete old image if upload successful
- Keep old image if no new upload
- Error handling untuk upload gagal

#### d. Update Database
```php
$stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, image_path = ? WHERE id = ?");
$stmt->bind_param("sssi", $title, $content, $image_path, $article_id);

if ($stmt->execute()) {
    $_SESSION['success_message'] = "Berita \"" . htmlspecialchars($title) . "\" berhasil diperbarui!";
    header("Location: admin.php?section=news");
}
```
- Prepared statement untuk security
- Update 3 fields: title, content, image_path
- Success message dengan judul berita
- Error handling
- Redirect ke section news

## Alur Lengkap Edit Berita

```
1. Admin di halaman Kelola Berita
   ↓
2. Klik tombol "Edit" pada berita
   ↓
3. Redirect ke edit_news.php?id=[news_id]
   ↓
4. System:
   - Check authentication
   - Validate ID
   - Fetch article data
   - Display form with pre-filled data
   ↓
5. Admin melakukan perubahan:
   - Edit judul
   - Edit konten
   - Optional: Upload gambar baru
   ↓
6. Klik "Simpan Perubahan"
   ↓
7. Submit ke update_news.php
   ↓
8. System:
   - Validate input
   - Process image upload (if any)
   - Delete old image (if new image uploaded)
   - Update database
   - Set success message
   ↓
9. Redirect ke admin.php?section=news
   ↓
10. Display success alert
    "Berita '[judul]' berhasil diperbarui!"
```

## Keamanan

### Input Validation
- ✅ Required fields (title, content)
- ✅ Integer validation untuk ID
- ✅ Trim whitespace
- ✅ Empty check

### File Upload Security
- ✅ File type validation (whitelist)
- ✅ Unique filename generation
- ✅ Directory existence check
- ✅ File move error handling

### XSS Prevention
```php
htmlspecialchars($article['title'])
htmlspecialchars($article['content'])
htmlspecialchars($article['image_path'])
```

### SQL Injection Prevention
```php
$stmt = $conn->prepare("UPDATE articles SET ... WHERE id = ?");
$stmt->bind_param("sssi", $title, $content, $image_path, $article_id);
```

### Authentication
```php
require_once 'auth_check.php';
```

## UI/UX Features

### Responsive Design
- Bootstrap 5 grid system
- Centered layout (col-lg-8)
- Mobile-friendly form

### Visual Elements
- ✏️ Icon untuk Edit
- 📰 Icon untuk Form
- Preview image dengan styling
- Color-coded buttons
- Info box dengan tips

### Navigation
- Breadcrumb style header
- "Kembali" button di header
- "Batal" button di form
- Auto redirect setelah save

### Notifications
- Success alert (green)
- Error alert (red)
- Alert dismissible
- Icon pada setiap alert

## Error Handling

### Scenarios Covered:
1. **ID tidak valid** → Error message + redirect
2. **Berita tidak ditemukan** → Error message + redirect
3. **Required field kosong** → Error message + redirect back
4. **Invalid file type** → Error message + redirect back
5. **Upload gagal** → Error message + redirect back
6. **Database error** → Error message + redirect back

### Error Messages:
- "ID berita tidak valid."
- "Berita tidak ditemukan."
- "Judul dan isi berita harus diisi."
- "Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF."
- "Gagal mengupload gambar baru."
- "Gagal memperbarui berita: [error detail]"

## Testing Checklist

- ✅ Form validation PHP syntax
- ✅ Authentication working
- ✅ ID validation
- ✅ Data fetch correct
- ✅ Pre-filled form displays correctly
- ✅ Image preview shows
- ✅ Edit without image change works
- ✅ Edit with new image works
- ✅ Old image deleted when new uploaded
- ✅ Required validation works
- ✅ File type validation works
- ✅ Success message displays
- ✅ Redirect to news section works
- ✅ XSS prevention working
- ✅ SQL injection prevented
- ✅ Error handling working

## Comparison: CRUD Operations

| Feature | Create | Read | Update | Delete |
|---------|--------|------|--------|--------|
| Location | admin.php | news.php, article.php | edit_news.php | admin.php (modal) |
| Form | In admin panel | View only | Separate page | Confirmation modal |
| Pre-filled | No | N/A | Yes | N/A |
| Image | Upload new | Display | Preview + optional new | Auto-delete |
| Validation | Yes | No | Yes | Confirmation |
| Notification | Success | No | Success | Success |
| Redirect | Section news | N/A | Section news | Section news |

## Future Enhancements (Optional)

1. **Rich Text Editor** - TinyMCE/CKEditor untuk formatting
2. **Image Cropper** - Crop image sebelum upload
3. **Multiple Images** - Gallery untuk multiple images per artikel
4. **Categories/Tags** - Kategorisasi berita
5. **Draft System** - Save as draft sebelum publish
6. **Version History** - Track perubahan artikel
7. **Preview** - Preview before save
8. **Bulk Edit** - Edit multiple articles
9. **Schedule Publish** - Set publish date/time
10. **SEO Fields** - Meta description, keywords, etc.

<?php
require_once 'auth_check.php';
require_once 'db.php';

// Get article ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = "ID berita tidak valid.";
    header("Location: admin.php?section=news");
    exit();
}

$article_id = intval($_GET['id']);

// Fetch article data
$stmt = $conn->prepare("SELECT id, title, content, image_path FROM articles WHERE id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error_message'] = "Berita tidak ditemukan.";
    header("Location: admin.php?section=news");
    exit();
}

$article = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - TK Pertiwi 14</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .preview-image {
            max-width: 300px;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-edit text-success"></i> Edit Berita</h2>
                    <a href="admin.php?section=news" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_SESSION['error_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error_message']); endif; ?>

                <!-- Edit Form -->
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-newspaper"></i> Form Edit Berita</h5>
                    </div>
                    <div class="card-body">
                        <form action="update_news.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                            <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($article['image_path']); ?>">
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Berita *</label>
                                <input type="text" id="title" name="title" class="form-control" 
                                       value="<?php echo htmlspecialchars($article['title']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="content" class="form-label">Isi Berita *</label>
                                <textarea id="content" name="content" class="form-control" rows="12" required><?php echo htmlspecialchars($article['content']); ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Berita</label>
                                
                                <?php if (!empty($article['image_path']) && file_exists($article['image_path'])): ?>
                                <div class="mb-2">
                                    <p class="text-muted mb-2"><small>Gambar saat ini:</small></p>
                                    <img src="<?php echo htmlspecialchars($article['image_path']); ?>" 
                                         alt="<?php echo htmlspecialchars($article['title']); ?>" class="preview-image border">
                                </div>
                                <?php endif; ?>
                                
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, JPEG, PNG, GIF</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="admin.php?section=news" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i> <strong>Tips:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Pastikan judul berita menarik dan informatif</li>
                        <li>Isi berita harus jelas dan mudah dipahami</li>
                        <li>Upload gambar baru jika ingin mengubah gambar</li>
                        <li>Ukuran gambar maksimal 5MB</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>

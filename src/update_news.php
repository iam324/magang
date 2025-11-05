<?php
require_once 'auth_check.php';
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = intval($_POST['id']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $old_image_raw = $_POST['old_image'];
    $sanitized_old_image = '';
    // Sanitize $old_image to prevent path traversal
    if (!empty($old_image_raw) && strpos($old_image_raw, 'uploads/') === 0 && file_exists($old_image_raw)) {
        $sanitized_old_image = $old_image_raw;
    }
    $image_path = $sanitized_old_image; // Keep sanitized old image by default

    // Validate required fields
    if (empty($title) || empty($content)) {
        $_SESSION['error_message'] = "Judul dan isi berita harus diisi.";
        header("Location: edit_news.php?id=" . $article_id);
        exit();
    }

    // Handle new image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($filetype, $allowed)) {
            $upload_dir = 'uploads/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Generate unique filename
            $new_filename = uniqid() . '_' . time() . '.' . $filetype;
            $destination = $upload_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                // Delete old image if exists
                if (!empty($sanitized_old_image) && file_exists($sanitized_old_image)) {
                    unlink($sanitized_old_image);
                }
                $image_path = $destination;
            } else {
                $_SESSION['error_message'] = "Gagal mengupload gambar baru.";
                header("Location: edit_news.php?id=" . $article_id);
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.";
            header("Location: edit_news.php?id=" . $article_id);
            exit();
        }
    }

    // Update article in database
    $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, image_path = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $content, $image_path, $article_id);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Berita \"" . htmlspecialchars($title) . "\" berhasil diperbarui!";
        header("Location: admin.php?section=news");
    } else {
        $_SESSION['error_message'] = "Gagal memperbarui berita: " . $stmt->error;
        header("Location: edit_news.php?id=" . $article_id);
    }
    
    $stmt->close();
    $conn->close();
    exit();
} else {
    header("Location: admin.php?section=news");
    exit();
}
?>

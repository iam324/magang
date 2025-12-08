<?php
require_once 'auth_check.php';
require_once 'db.php';
require_once 'csrf_handler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image_path = '';
    $error_message = '';
    $success = false;

    // Validate input
    if (empty($title) || empty($content)) {
        $error_message = "Judul dan isi berita harus diisi!";
    } else {
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            $file_type = $_FILES['image']['type'];
            $file_size = $_FILES['image']['size'];
            
            // Validate file type
            if (!in_array($file_type, $allowed_types)) {
                $error_message = "Hanya file gambar (JPG, PNG, GIF) yang diperbolehkan!";
            }
            // Validate file size (max 5MB)
            elseif ($file_size > 5 * 1024 * 1024) {
                $error_message = "Ukuran file maksimal 5MB!";
            }
            else {
                $target_dir = "../uploads/news/";
                
                // Create uploads directory if not exists
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                // Generate unique filename
                $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $unique_filename = time() . '_' . uniqid() . '.' . $file_extension;
                $destination_path = $target_dir . $unique_filename;
                $image_path = "uploads/news/" . $unique_filename; // Path for DB
                
                // Move uploaded file
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination_path)) {
                    // success
                } else {
                    $_SESSION['error_message'] = "Gagal mengupload gambar!";
                    header("Location: admin.php?section=news&error=1");
                    exit();
                }
            }
        }
        
        // Insert to database if no errors
        if (empty($error_message)) {
            $stmt = $conn->prepare("INSERT INTO articles (title, content, image_path, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $title, $content, $image_path);
            
            if ($stmt->execute()) {
                $success = true;
                $_SESSION['success_message'] = "Berita berhasil ditambahkan!";
            } else {
                $error_message = "Error database: " . $stmt->error;
                // Delete uploaded image if database insert fails
                if (!empty($image_path) && file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            
            $stmt->close();
        } else {
            $_SESSION['error_message'] = $error_message;
        }
    }
    
    $conn->close();
    
    // Redirect back to admin panel
    if ($success) {
        header("Location: admin.php?section=news&success=1");
    } else {
        $_SESSION['error_message'] = $error_message;
        header("Location: admin.php?section=news&error=1");
    }
    exit();
} else {
    // If not POST request, redirect to admin
    header("Location: admin.php");
    exit();
}
?>
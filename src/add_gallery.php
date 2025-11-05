<?php
session_start();
require_once 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

//iam 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $image_path = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($filetype, $allowed)) {
            $upload_dir = '../uploads/gallery/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Generate unique filename
            $new_filename = uniqid() . '_' . time() . '.' . $filetype;
            $destination = $upload_dir . $new_filename;
            $image_path = 'uploads/gallery/' . $new_filename; // Clean path for DB
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            } else {
                $_SESSION['error_message'] = "Gagal mengupload gambar.";
                header("Location: admin.php?section=gallery");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.";
            header("Location: admin.php?section=gallery");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Silakan pilih gambar untuk diupload.";
        header("Location: admin.php?section=gallery");
        exit();
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO gallery (title, description, image_path, category, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $title, $description, $image_path, $category);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Foto berhasil ditambahkan ke galeri!";
    } else {
        $_SESSION['error_message'] = "Gagal menambahkan foto: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
    
    header("Location: admin.php?section=gallery");
    exit();
} else {
    header("Location: admin.php?section=gallery");
    exit();
}
?>

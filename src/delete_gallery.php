<?php
require_once 'auth_check.php';
require_once 'db.php';
require_once 'csrf_handler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    if (!validate_csrf_token($_POST['csrf_token'])) {
        $_SESSION['error_message'] = "Sesi tidak valid. Silakan coba lagi.";
        header("Location: admin.php?section=gallery");
        exit();
    }
    $id = intval($_POST['id']);
    
    // Get image path before deleting
    $stmt = $conn->prepare("SELECT image_path FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = $row['image_path'];
        
        // Delete from database
        $delete_stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
        $delete_stmt->bind_param("i", $id);
        
        if ($delete_stmt->execute()) {
            // Delete physical file if exists
            if (!empty($image_path) && file_exists($image_path)) {
                unlink($image_path);
            }
            $_SESSION['success_message'] = "Foto berhasil dihapus dari galeri!";
        } else {
            $_SESSION['error_message'] = "Gagal menghapus foto dari database.";
        }
        
        $delete_stmt->close();
    } else {
        $_SESSION['error_message'] = "Foto tidak ditemukan.";
    }
    
    $stmt->close();
    $conn->close();
}

header("Location: admin.php?section=gallery");
exit();
?>

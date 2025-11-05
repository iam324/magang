<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $article_id = intval($_POST['id']);

    // Get article title and image path before deleting
    $stmt_select = $conn->prepare("SELECT title, image_path FROM articles WHERE id = ?");
    $stmt_select->bind_param("i", $article_id);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();
    
    if ($result_select->num_rows > 0) {
        $article = $result_select->fetch_assoc();
        $article_title = $article['title'];
        $image_path = $article['image_path'];
        
        // Delete the article from database
        $stmt_delete = $conn->prepare("DELETE FROM articles WHERE id = ?");
        $stmt_delete->bind_param("i", $article_id);
        
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
        
        $stmt_delete->close();
    } else {
        $_SESSION['error_message'] = "Berita tidak ditemukan.";
    }
    
    $stmt_select->close();
    $conn->close();
    
    // Redirect to admin page, news section
    header("Location: admin.php?section=news");
    exit();
} else {
    // Redirect if no ID or not POST request
    header("Location: admin.php?section=news");
    exit();
}
?>

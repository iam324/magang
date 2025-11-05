<?php
require_once 'auth_check.php';
require_once 'db.php';
require_once 'csrf_handler.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (!validate_csrf_token(isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '')) {
        echo json_encode(['success' => false, 'message' => 'Sesi tidak valid. Silakan coba lagi.']);
        exit();
    }

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    
    // Validate input
    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
        exit();
    }
    
    if (!in_array($status, ['approved', 'rejected'])) {
        echo json_encode(['success' => false, 'message' => 'Status tidak valid']);
        exit();
    }
    
    // Update status
    $stmt = $conn->prepare("UPDATE registrations SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Status berhasil diupdate',
            'status' => $status
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Gagal mengupdate status: ' . $conn->error
        ]);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak valid']);
}
?>

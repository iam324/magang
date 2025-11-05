<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = htmlspecialchars(trim($_POST['message']));

    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        header("Location: contact.php?error=1&message=Semua%20kolom%20wajib%20diisi.");
        exit();
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?error=1&message=Format%20email%20tidak%20valid.");
        exit();
    }

    // Validate Phone (simple digits only check)
    if (!preg_match("/^\d{10,15}$/", $phone)) { // Assuming 10 to 15 digits for phone number
        header("Location: contact.php?error=1&message=Format%20nomor%20telepon%20tidak%20valid.");
        exit();
    }

    // Validate Subject against a whitelist
    $allowed_subjects = ['Pendaftaran', 'Informasi Umum', 'Kurikulum', 'Fasilitas', 'Biaya', 'Lainnya'];
    if (!in_array($subject, $allowed_subjects)) {
        header("Location: contact.php?error=1&message=Subjek%20tidak%20valid.");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

    if ($stmt->execute()) {
        header("Location: contact.php?success=1");
    } else {
        header("Location: contact.php?error=1");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: contact.php");
}
exit();
?>

<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $dob = $_POST['dob'];
    $parent_name = htmlspecialchars(trim($_POST['parent_name']));
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = htmlspecialchars(trim($_POST['address']));
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // Basic validation
    if (empty($name) || empty($dob) || empty($parent_name) || empty($email) || empty($phone) || empty($address)) {
        header("Location: registration.php?error=1&message=Semua%20kolom%20wajib%20diisi.");
        exit();
    }

    // Validate DOB
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dob) || !strtotime($dob)) {
        header("Location: registration.php?error=1&message=Format%20tanggal%20lahir%20tidak%20valid.");
        exit();
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: registration.php?error=1&message=Format%20email%20tidak%20valid.");
        exit();
    }

    // Validate Phone (simple digits only check)
    if (!preg_match("/^\d{10,15}$/", $phone)) { // Assuming 10 to 15 digits for phone number
        header("Location: registration.php?error=1&message=Format%20nomor%20telepon%20tidak%20valid.");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO registrations (name, dob, parent_name, email, phone, address, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $dob, $parent_name, $email, $phone, $address, $message);

    if ($stmt->execute()) {
        header("Location: registration.php?success=1");
    } else {
        header("Location: registration.php?error=1");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: registration.php");
}
exit();
?>

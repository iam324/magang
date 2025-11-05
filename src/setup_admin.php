<?php
// Run this file once to create admin user table and default admin
require_once 'db.php';

// Create admin_users table
$sql = "CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table admin_users created successfully<br>";
    
    // Create default admin (username: admin, password: admin123)
    $default_username = "admin";
    $default_password = password_hash("admin123", PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?) ON DUPLICATE KEY UPDATE username=username");
    $stmt->bind_param("ss", $default_username, $default_password);
    
    if ($stmt->execute()) {
        echo "Default admin created successfully<br>";
        echo "Username: admin<br>";
        echo "Password: admin123<br>";
        echo "<br><strong>PENTING: Segera ubah password default setelah login pertama!</strong><br>";
        echo "<br><a href='login.php'>Go to Login</a>";
    }
    
    $stmt->close();
} else {
    echo "Error creating table: " . $conn->error;
}

// Create registrations table
$sql = "CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    dob DATE NOT NULL,
    parent_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT,
    message TEXT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table registrations created successfully<br>";
}

// Create contacts table
$sql = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table contacts created successfully<br>";
}

// Create gallery table
$sql = "CREATE TABLE IF NOT EXISTS gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    image_path VARCHAR(255) NOT NULL,
    category VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table gallery created successfully<br>";
}

// Create testimonials table
$sql = "CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_name VARCHAR(100) NOT NULL,
    student_name VARCHAR(100) NOT NULL,
    testimonial TEXT NOT NULL,
    rating INT DEFAULT 5,
    image_path VARCHAR(255),
    status ENUM('pending', 'approved') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table testimonials created successfully<br>";
}

$conn->close();
?>

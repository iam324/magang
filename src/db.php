<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$dbname = "db_news";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  // Untuk production, jangan tampilkan detail error. Cukup pesan umum.
  // die("Connection failed: " . $conn->connect_error);
  die("Koneksi ke database gagal. Silakan coba lagi nanti.");
}
?>
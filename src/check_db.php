<?php
require_once 'db.php';

echo "<h3>Memeriksa Struktur Database (db_news)</h3>";

$tables = [
    'admin_users', 
    'articles',
    'registrations', 
    'contacts', 
    'gallery', 
    'testimonials'
];

foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    
    if ($result && $result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Tabel '<strong>$table</strong>' ditemukan.</p>";
        
        // Count rows
        $count_res = $conn->query("SELECT COUNT(*) as total FROM `$table`");
        $count_row = $count_res->fetch_assoc();
        echo "<p>Jumlah data: " . $count_row['total'] . "</p>";

    } else {
        echo "<p style='color: red;'>❌ Tabel '<strong>$table</strong>' tidak ditemukan.</p>";
        echo "<p>Silakan jalankan <a href='setup_admin.php' target='_blank'>setup_admin.php</a> untuk membuat tabel ini.</p>";
    }
    echo "<hr>";
}

$conn->close();
?>
<?php
// File untuk membuat admin baru dengan username dan password custom
require_once 'db.php';

// Username dan Password Baru untuk Admin TK Pertiwi 14
$new_username = "tkpertiwi14";
$new_password = "Pertiwi2025!";

// Hash password untuk keamanan
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Cek apakah tabel admin_users sudah ada
$table_check = $conn->query("SHOW TABLES LIKE 'admin_users'");

if(!$table_check || $table_check->num_rows == 0) {
    // Buat tabel jika belum ada
    $sql = "CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div style='padding: 20px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;'>";
        echo "✅ Tabel admin_users berhasil dibuat<br>";
        echo "</div>";
    } else {
        echo "<div style='padding: 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 20px;'>";
        echo "❌ Error membuat tabel: " . $conn->error . "<br>";
        echo "</div>";
        exit;
    }
}

// Hapus admin lama (jika ada)
$conn->query("DELETE FROM admin_users WHERE username = 'admin'");

// Tambahkan admin baru
$stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?) ON DUPLICATE KEY UPDATE password=?");
$stmt->bind_param("sss", $new_username, $hashed_password, $hashed_password);

if ($stmt->execute()) {
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Account Created - TK Pertiwi 14</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .success-card {
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                max-width: 600px;
                width: 100%;
            }
            .success-header {
                background: linear-gradient(135deg, #00e676 0%, #00b359 100%);
                padding: 2rem;
                text-align: center;
                color: white;
                border-radius: 15px 15px 0 0;
            }
            .credentials {
                background: #f8f9fa;
                padding: 1.5rem;
                border-radius: 10px;
                margin: 1.5rem 0;
                border-left: 4px solid #00e676;
            }
            .credential-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                background: white;
                border-radius: 5px;
                margin-bottom: 0.5rem;
            }
            .copy-btn {
                padding: 0.25rem 0.75rem;
                font-size: 0.875rem;
            }
        </style>
    </head>
    <body>
        <div class="success-card">
            <div class="success-header">
                <i class="fas fa-check-circle fa-4x mb-3"></i>
                <h2 class="mb-0">Admin Account Berhasil Dibuat!</h2>
            </div>
            <div class="p-4">
                <div class="alert alert-success">
                    <i class="fas fa-info-circle"></i> Akun admin baru telah dibuat dengan kredensial berikut:
                </div>

                <div class="credentials">
                    <h5 class="mb-3"><i class="fas fa-key text-success"></i> Kredensial Login Admin</h5>
                    
                    <div class="credential-item">
                        <div>
                            <strong>Username:</strong><br>
                            <code style="font-size: 1.2rem; color: #00e676;"><?php echo $new_username; ?></code>
                        </div>
                        <button class="btn btn-sm btn-outline-success copy-btn" onclick="copyText('<?php echo $new_username; ?>')">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                    </div>
                    
                    <div class="credential-item">
                        <div>
                            <strong>Password:</strong><br>
                            <code style="font-size: 1.2rem; color: #00e676;"><?php echo $new_password; ?></code>
                        </div>
                        <button class="btn btn-sm btn-outline-success copy-btn" onclick="copyText('<?php echo $new_password; ?>')">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                    </div>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> <strong>PENTING!</strong>
                    <ul class="mb-0 mt-2">
                        <li>Simpan kredensial ini di tempat yang aman</li>
                        <li>Admin lama (username: admin) telah dihapus</li>
                        <li>Password menggunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
                        <li>Jangan bagikan kredensial ini kepada orang lain</li>
                    </ul>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-lightbulb"></i> <strong>Tips Keamanan:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Ubah password secara berkala (setiap 3-6 bulan)</li>
                        <li>Jangan gunakan password yang sama di tempat lain</li>
                        <li>Selalu logout setelah selesai menggunakan admin panel</li>
                        <li>Gunakan HTTPS jika di production</li>
                    </ul>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <a href="login.php" class="btn btn-success btn-lg">
                        <i class="fas fa-sign-in-alt"></i> Login ke Admin Panel
                    </a>
                    <a href="index.php" class="btn btn-outline-secondary">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                </div>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        <i class="fas fa-shield-alt"></i> Password telah di-hash menggunakan algoritma keamanan tinggi
                    </small>
                </div>
            </div>
        </div>

        <script>
            function copyText(text) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('✅ Berhasil dicopy ke clipboard!');
                }, function(err) {
                    alert('❌ Gagal copy: ' + err);
                });
            }
        </script>
    </body>
    </html>
    <?php
} else {
    echo "<div style='padding: 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;'>";
    echo "❌ Error membuat admin: " . $stmt->error;
    echo "</div>";
}

$stmt->close();
$conn->close();
?>

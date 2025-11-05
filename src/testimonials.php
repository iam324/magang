<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni - TK Pertiwi 14</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .testimonial-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .testimonial-card:hover {
            transform: translateY(-10px);
        }
        .testimonial-header {
            background: linear-gradient(135deg, #00e676 0%, #00b359 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 15px 15px 0 0;
        }
        .rating {
            color: #ffc107;
        }
        .testimonial-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin-top: -40px;
        }
    </style>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <img src="../assets/tkpertiwilogo-removebg-preview.png" alt="TK Pertiwi 14 Logo" style="height: 40px; margin-right: 10px;"> 
                TK PERTIWI 14
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="news.php">BERITA</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">GALERI</a></li>
                    <li class="nav-item"><a class="nav-link" href="testimonials.php">TESTIMONI</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">KONTAK</a></li>
                </ul>
            </div>
            <a href="registration.php" class="btn btn-outline-dark">PENDAFTARAN</a>
        </div>
    </header>

    <div class="content-wrapper">
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">
                <i class="fas fa-quote-left text-success"></i> TESTIMONI ORANG TUA
            </h2>
            <p class="lead text-center mb-5">Apa kata orang tua murid tentang TK Pertiwi 14</p>
            
            <div class="row g-4">
                <?php
                require_once 'db.php';

                // Check if testimonials table exists
                $table_check = $conn->query("SHOW TABLES LIKE 'testimonials'");
                
                if($table_check && $table_check->num_rows > 0) {
                    $sql = "SELECT parent_name, student_name, testimonial, rating, image_path, created_at 
                            FROM testimonials WHERE status = 'approved' ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $image = !empty($row['image_path']) ? htmlspecialchars($row['image_path']) : 'https://ui-avatars.com/api/?name=' . urlencode($row['parent_name']) . '&background=00e676&color=fff&size=200';
                            $rating = intval($row['rating']);
                            
                            echo "<div class='col-md-6 col-lg-4'>";
                            echo "<div class='card testimonial-card h-100'>";
                            echo "<div class='testimonial-header text-center'>";
                            echo "<i class='fas fa-quote-right fa-2x mb-2'></i>";
                            echo "</div>";
                            echo "<div class='card-body text-center'>";
                            echo "<img src='{$image}' alt='" . htmlspecialchars($row['parent_name']) . "' class='testimonial-img'>";
                            echo "<h5 class='mt-3'>" . htmlspecialchars($row['parent_name']) . "</h5>";
                            echo "<p class='text-muted mb-2'><small>Orang Tua dari " . htmlspecialchars($row['student_name']) . "</small></p>";
                            echo "<div class='rating mb-3'>";
                            for($i = 1; $i <= 5; $i++) {
                                if($i <= $rating) {
                                    echo "<i class='fas fa-star'></i>";
                                } else {
                                    echo "<i class='far fa-star'></i>";
                                }
                            }
                            echo "</div>";
                            echo "<p class='card-text'><em>\"" . htmlspecialchars($row['testimonial']) . "\"</em></p>";
                            echo "<p class='text-muted'><small>" . date('F Y', strtotime($row['created_at'])) . "</small></p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='col-12'>";
                        echo "<div class='alert alert-info text-center'>";
                        echo "<i class='fas fa-info-circle'></i> Belum ada testimoni yang tersedia. Silakan berikan testimoni Anda melalui form di bawah.";
                        echo "</div>";
                    }
                } else {
                    // Table doesn\'t exist
                    echo "<div class=\'col-12\'>";
                    echo "<div class=\'alert alert-warning text-center\'>";
                    echo "<i class=\'fas fa-exclamation-triangle\'></i> <strong>Database belum disetup!</strong><br>";
                    echo "Silakan jalankan <a href=\'setup_admin.php\' class=\'alert-link\'>setup_admin.php</a> terlebih dahulu untuk membuat tabel database.";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>

            <!-- Add Testimonial Section -->
            <div class="mt-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">
                            <i class="fas fa-pen text-success"></i> Berikan Testimoni Anda
                        </h3>
                        <form action="submit_testimonial.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="parent_name" class="form-label">Nama Orang Tua *</label>
                                    <input type="text" class="form-control" id="parent_name" name="parent_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="student_name" class="form-label">Nama Anak *</label>
                                    <input type="text" class="form-control" id="student_name" name="student_name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating *</label>
                                <select class="form-select" id="rating" name="rating" required>
                                    <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                    <option value="4">⭐⭐⭐⭐ Baik</option>
                                    <option value="3">⭐⭐⭐ Cukup</option>
                                    <option value="2">⭐⭐ Kurang</option>
                                    <option value="1">⭐ Sangat Kurang</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="testimonial" class="form-label">Testimoni *</label>
                                <textarea class="form-control" id="testimonial" name="testimonial" rows="4" required placeholder="Ceritakan pengalaman Anda tentang TK Pertiwi 14..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Foto (Opsional)</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, maksimal 2MB</small>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-paper-plane"></i> Kirim Testimoni
                            </button>
                            <p class="text-center mt-2 mb-0"><small class="text-muted">Testimoni akan ditampilkan setelah disetujui oleh admin</small></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-school text-success"></i> TK Pertiwi 14</h5>
                    <p>Membentuk generasi cerdas, kreatif, dan berkarakter.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-map-marker-alt text-success"></i> Kontak</h5>
                    <p><i class="fas fa-phone"></i> +62 812-3456-7890</p>
                    <p><i class="fas fa-envelope"></i> opertiwisemarang@email.com</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-clock text-success"></i> Jam Operasional</h5>
                    <p>Senin - Kamis: 07:30 - 12:00</p>
                    <p>Jumat: 07:30 - 11:00</p>
                </div>
            </div>
            <div class="text-center mt-3 border-top pt-3">
                <p class="mb-0">&copy; 2025 TK Pertiwi 14. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/628123456789" class="btn btn-success position-fixed bottom-0 end-0 m-4 rounded-circle" style="width: 60px; height: 60px; z-index: 1000;" target="_blank">
        <i class="fab fa-whatsapp fa-2x"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - TK Pertiwi 14</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .gallery-item:hover {
            transform: scale(1.05);
        }
        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: all 0.3s ease;
        }
        .gallery-item:hover img {
            filter: brightness(70%);
        }
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            padding: 1rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }
        .filter-buttons .btn {
            margin: 0.25rem;
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
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="news.php"><i class="fas fa-newspaper"></i> BERITA</a></li>
                    <li class="nav-item"><a class="nav-link active" href="gallery.php"><i class="fas fa-images"></i> GALERI</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> KONTAK</a></li>
                </ul>
            </div>
            <a href="registration.php" class="btn btn-outline-dark"><i class="fas fa-user-plus"></i> PENDAFTARAN</a>
        </div>
    </header>

    <div class="content-wrapper">
    <!-- Header Section -->
    <section class="py-5 bg-success text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3"><i class="fas fa-images"></i> Galeri Foto</h1>
            <p class="lead">Dokumentasi kegiatan dan momen berharga di TK Pertiwi 14</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="filter-buttons text-center mb-4">
                <button class="btn btn-success filter-btn active" data-filter="all">Semua</button>
                <button class="btn btn-outline-success filter-btn" data-filter="kegiatan">Kegiatan</button>
                <button class="btn btn-outline-success filter-btn" data-filter="pembelajaran">Pembelajaran</button>
                <button class="btn btn-outline-success filter-btn" data-filter="event">Event</button>
                <button class="btn btn-outline-success filter-btn" data-filter="fasilitas">Fasilitas</button>
            </div>

            <div class="row g-4" id="gallery-container">
                <?php
                require_once 'db.php';
                require_once 'helpers.php';

                // Check if gallery table exists
                $table_check = $conn->query("SHOW TABLES LIKE 'gallery'");
                
                if($table_check && $table_check->num_rows > 0) {
                    $sql = "SELECT id, title, description, image_path, category FROM gallery ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $category = !empty($row['category']) ? htmlspecialchars($row['category']) : 'kegiatan';
                            // Check if image exists
                            $image_path = !empty($row['image_path']) ? $row['image_path'] : '';
                            $image = get_placeholder_image_svg(400, 250, 'Galeri TK Pertiwi 14');
                            
                            if (!empty($image_path) && file_exists(__DIR__ . '/' . $image_path)) {
                                $image = htmlspecialchars($image_path);
                            }
                            
                            echo "<div class='col-md-4 gallery-card' data-category='{$category}'>";
                            echo "<div class='gallery-item shadow-sm'>";
                            echo "<img src='" . $image . "' alt='" . htmlspecialchars($row['title']) . "' data-bs-toggle='modal' data-bs-target='#imageModal' data-image='" . $image . "' data-title='" . htmlspecialchars($row['title']) . "' data-description='" . htmlspecialchars($row['description']) . "' onerror=\"this.src='" . get_placeholder_image_svg(400, 250, 'Galeri TK Pertiwi 14') . "'\">";
                            echo "<div class='gallery-overlay'>";
                            echo "<h5>" . htmlspecialchars($row['title']) . "</h5>";
                            if(!empty($row['description'])) {
                                echo "<p class='mb-0'><small>" . htmlspecialchars(substr($row['description'], 0, 50)) . "...</small></p>";
                            }
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='col-12'>";
                        echo "<div class='alert alert-info text-center'>";
                        echo "<i class='fas fa-info-circle'></i> Belum ada foto di galeri. Admin dapat menambahkan foto melalui panel admin.";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    // Table doesn't exist
                    echo "<div class='col-12'>";
                    echo "<div class='alert alert-warning text-center'>";
                    echo "<i class='fas fa-exclamation-triangle'></i> <strong>Database belum disetup!</strong><br>";
                    echo "Silakan jalankan <a href='setup_admin.php' class='alert-link'>setup_admin.php</a> terlebih dahulu untuk membuat tabel database.";
                    echo "</div>";
                    echo "</div>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="modalImage" class="img-fluid" alt="">
                    <p class="mt-3" id="modalDescription"></p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-school text-success"></i> TK Pertiwi 14</h5>
                    <p>Membentuk generasi cerdas, kreatif, dan berkarakter dengan pendidikan berkualitas.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-map-marker-alt text-success"></i> Kontak Kami</h5>
                    <p><i class="fas fa-phone"></i> +62 812-3456-7890</p>
                    <p><i class="fas fa-envelope"></i> tkpertiwi14@email.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> Jl. Pahlawan No. 1, Mugassari, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50249</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-clock text-success"></i> Jam Operasional</h5>
                    <p><strong>Senin - Kamis:</strong> 07:30 - 12:00</p>
                    <p><strong>Jumat:</strong> 07:30 - 11:00</p>
                    <p><strong>Sabtu - Minggu:</strong> Libur</p>
                </div>
            </div>
            <div class="text-center mt-4 pt-4 border-top border-secondary">
                <p class="mb-0">&copy; 2025 TK Pertiwi 14. All Rights Reserved. | Made with <i class="fas fa-heart text-danger"></i></p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/628123456789?text=Halo%20TK%20Pertiwi%2014%2C%20saya%20ingin%20bertanya%20tentang%20pendaftaran" 
       class="btn btn-success position-fixed rounded-circle shadow-lg" 
       style="bottom: 20px; right: 20px; width: 60px; height: 60px; z-index: 1000; display: flex; align-items: center; justify-content: center;" 
       target="_blank"
       title="Chat via WhatsApp">
        <i class="fab fa-whatsapp fa-2x"></i>
    </a>

    <!-- Scroll to Top Button -->
    <button onclick="scrollToTop()" id="scrollTopBtn" class="btn btn-dark position-fixed rounded-circle shadow-lg" 
            style="bottom: 90px; right: 20px; width: 50px; height: 50px; display: none; z-index: 999;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gallery Filter
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active', 'btn-success'));
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.add('btn-outline-success'));
                this.classList.add('active', 'btn-success');
                this.classList.remove('btn-outline-success');
                
                const filter = this.dataset.filter;
                document.querySelectorAll('.gallery-card').forEach(card => {
                    if(filter === 'all' || card.dataset.category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Modal Image
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(img => {
            img.addEventListener('click', function() {
                document.getElementById('modalImage').src = this.dataset.image;
                document.getElementById('imageModalLabel').textContent = this.dataset.title;
                document.getElementById('modalDescription').textContent = this.dataset.description;
                document.getElementById('modalImage').alt = this.dataset.title;
            });
        });

        // Scroll to Top functionality
        window.onscroll = function() {
            var scrollTopBtn = document.getElementById("scrollTopBtn");
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                scrollTopBtn.style.display = "flex";
                scrollTopBtn.style.alignItems = "center";
                scrollTopBtn.style.justifyContent = "center";
            } else {
                scrollTopBtn.style.display = "none";
            }
        };

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>

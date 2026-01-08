<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - TK Pertiwi 14</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                    <li class="nav-item"><a class="nav-link active" href="news.php"><i class="fas fa-newspaper"></i> BERITA</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php"><i class="fas fa-images"></i> GALERI</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> KONTAK</a></li>
                </ul>
            </div>
            <a href="registration.php" class="btn btn-light"><i class="fas fa-user-plus"></i> PENDAFTARAN</a>
        </div>
    </header>

    <div class="content-wrapper">
    <section class="article-section py-5">
        <div class="container">
            <?php
            require_once 'db.php';
            require_once 'helpers.php';
            require_once 'helpers.php';

            if (isset($_GET['id'])) {
                $article_id = intval($_GET['id']);
                $stmt = $conn->prepare("SELECT title, content, image_path, created_at FROM articles WHERE id = ?");
                $stmt->bind_param("i", $article_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $article = $result->fetch_assoc();
                    // Check if image exists
                    $image_path = !empty($article['image_path']) ? $article['image_path'] : '';
                    $image = get_placeholder_image_svg(1200, 600);
                    
                    if (!empty($image_path) && file_exists(__DIR__ . '/../' . $image_path)) {
                        $image = '../' . htmlspecialchars($image_path);
                    }
                    
                    echo "<div class='row justify-content-center'>";
                    echo "<div class='col-lg-10'>";
                    echo "<div class='card shadow-lg border-0'>";
                    
                    // Header with breadcrumb
                    echo "<div class='card-header bg-white border-0 pt-4'>";
                    echo "<nav aria-label='breadcrumb'>";
                    echo "<ol class='breadcrumb mb-0'>";
                    echo "<li class='breadcrumb-item'><a href='index.php' class='text-decoration-none'><i class='fas fa-home'></i> Home</a></li>";
                    echo "<li class='breadcrumb-item'><a href='news.php' class='text-decoration-none'><i class='fas fa-newspaper'></i> Berita</a></li>";
                    echo "<li class='breadcrumb-item active' aria-current='page'>Detail</li>";
                    echo "</ol>";
                    echo "</nav>";
                    echo "</div>";
                    
                    // Article image
                    echo "<img src='" . $image . "' class='card-img-top' alt='" . htmlspecialchars($article['title']) . "' style='max-height: 500px; object-fit: cover;' onerror=\"this.src='" . get_placeholder_image_svg(1200, 600) . "'\">";
                    
                    // Article content
                    echo "<div class='card-body p-5'>";
                    echo "<div class='mb-3'>";
                    echo "<span class='badge bg-success'><i class='fas fa-newspaper'></i> BERITA</span>";
                    echo "</div>";
                    echo "<h1 class='card-title display-5 fw-bold mb-3'>" . htmlspecialchars($article["title"]) . "</h1>";
                    echo "<div class='d-flex align-items-center text-muted mb-4'>";
                    echo "<i class='far fa-calendar me-2'></i>";
                    echo "<span class='me-4'>" . date('d F Y', strtotime($article["created_at"])) . "</span>";
                    echo "<i class='far fa-clock me-2'></i>";
                    echo "<span>" . date('H:i', strtotime($article["created_at"])) . " WIB</span>";
                    echo "</div>";
                    echo "<hr class='my-4'>";
                    echo "<div class='article-content fs-5 lh-lg' style='text-align: justify;'>" . nl2br(htmlspecialchars($article["content"])) . "</div>";
                    echo "</div>";
                    
                    // Article footer with share buttons
                    echo "<div class='card-footer bg-light border-0 p-4'>";
                    echo "<div class='d-flex justify-content-between align-items-center'>";
                    echo "<div>";
                    echo "<h6 class='mb-2'>Bagikan Berita:</h6>";
                    echo "<a href='https://www.facebook.com/sharer/sharer.php?u=" . urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) . "' target='_blank' class='btn btn-sm btn-primary me-2'><i class='fab fa-facebook'></i> Facebook</a>";
                    echo "<a href='https://twitter.com/intent/tweet?url=" . urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) . "&text=" . urlencode($article['title']) . "' target='_blank' class='btn btn-sm btn-info me-2'><i class='fab fa-twitter'></i> Twitter</a>";
                    echo "<a href='https://wa.me/?text=" . urlencode($article['title'] . ' - http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) . "' target='_blank' class='btn btn-sm btn-success'><i class='fab fa-whatsapp'></i> WhatsApp</a>";
                    echo "</div>";
                    echo "<a href='news.php' class='btn btn-outline-success'><i class='fas fa-arrow-left'></i> Kembali ke Berita</a>";
                    echo "</div>";
                    echo "</div>";
                    
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-warning text-center'>";
                    echo "<i class='fas fa-exclamation-triangle fa-3x mb-3'></i>";
                    echo "<h4>Berita Tidak Ditemukan</h4>";
                    echo "<p>Maaf, berita yang Anda cari tidak dapat ditemukan.</p>";
                    echo "<a href='news.php' class='btn btn-success'><i class='fas fa-arrow-left'></i> Kembali ke Berita</a>";
                    echo "</div>";
                }

                $stmt->close();
            } else {
                echo "<div class='alert alert-danger text-center'>";
                echo "<i class='fas fa-times-circle fa-3x mb-3'></i>";
                echo "<h4>ID Berita Tidak Valid</h4>";
                echo "<p>Silakan pilih berita yang ingin dibaca dari halaman berita.</p>";
                echo "<a href='news.php' class='btn btn-success'><i class='fas fa-arrow-left'></i> Ke Halaman Berita</a>";
                echo "</div>";
            }

            $conn->close();
            ?>
        </div>
    </section>
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

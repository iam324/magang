<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TK Pertiwi 14 - Taman Kanak-Kanak Terbaik di Semarang</title>
    <meta name="description" content="TK Pertiwi 14 - Membentuk generasi cerdas, kreatif, dan berkarakter dengan pendidikan berkualitas">
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .hero-modern {
            background: linear-gradient(135deg, rgba(0, 230, 118, 0.9), rgba(0, 179, 89, 0.9)), url('https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=1200');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 600px;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .hero-modern::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, transparent 20%, rgba(0,0,0,0.2) 80%);
            animation: pulse 15s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .feature-icon {
            font-size: 3rem;
            background: linear-gradient(135deg, #00e676, #00b359);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-card {
            background: linear-gradient(135deg, #00e676, #00b359);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-10px);
        }
        .news-preview-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .news-preview-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
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
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-home"></i> HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="news.php"><i class="fas fa-newspaper"></i> BERITA</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php"><i class="fas fa-images"></i> GALERI</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> KONTAK</a></li>
                </ul>
            </div>
            <a href="registration.php" class="btn btn-light"><i class="fas fa-user-plus"></i> PENDAFTARAN</a>
        </div>
    </header>

    <div class="content-wrapper">
    <!-- Hero Section -->
    <section class="hero-modern">
        <div class="container position-relative" style="z-index: 1;">
            <div class="row align-items-center">
                <div class="col-lg-6 animate__animated animate__fadeInLeft">
                    <h1 class="display-3 fw-bold mb-4">Selamat Datang di<br><span class="text-warning">TK PERTIWI 14</span></h1>
                    <p class="lead mb-4">Membentuk generasi cerdas, kreatif, dan berkarakter dengan pendidikan berkualitas yang menyenangkan</p>
                    <div class="d-grid gap-3 d-md-flex">
                        <a href="registration.php" class="btn btn-warning btn-lg px-5">
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </a>
                        <a href="#about" class="btn btn-outline-light btn-lg px-5">
                            <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0 animate__animated animate__fadeInRight">
                    <img src="../assets/tkpertiwilogo-removebg-preview.png" alt="TK Pertiwi 14" class="img-fluid" style="max-height: 700px; filter: drop-shadow(0 10px 30px rgba(0,0,0,0.3));">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp">
                        <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                        <h2 class="display-4 fw-bold">15+</h2>
                        <p class="mb-0">Tahun Pengalaman</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h2 class="display-4 fw-bold">500+</h2>
                        <p class="mb-0">Siswa Alumni</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                        <h2 class="display-4 fw-bold">10+</h2>
                        <p class="mb-0">Guru Berpengalaman</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                        <i class="fas fa-award fa-3x mb-3"></i>
                        <h2 class="display-4 fw-bold">25+</h2>
                        <p class="mb-0">Prestasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" id="about">
        <div class="container">
            <h2 class="text-center mb-5">
                <i class="fas fa-star text-success"></i> Mengapa Memilih TK Pertiwi 14?
            </h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp">
                        <i class="fas fa-book-reader feature-icon mb-3"></i>
                        <h4>Kurikulum Terpadu</h4>
                        <p class="text-muted">Menggunakan kurikulum nasional yang disesuaikan dengan perkembangan anak</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                        <i class="fas fa-users-cog feature-icon mb-3"></i>
                        <h4>Guru Profesional</h4>
                        <p class="text-muted">Didukung oleh guru-guru yang berpengalaman dan bersertifikat</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <i class="fas fa-school feature-icon mb-3"></i>
                        <h4>Fasilitas Lengkap</h4>
                        <p class="text-muted">Ruang kelas nyaman, area bermain, dan perpustakaan untuk mendukung pembelajaran</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                        <i class="fas fa-palette feature-icon mb-3"></i>
                        <h4>Pengembangan Kreativitas</h4>
                        <p class="text-muted">Program seni, musik, dan aktivitas kreatif untuk mengasah bakat anak</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                        <i class="fas fa-heartbeat feature-icon mb-3"></i>
                        <h4>Lingkungan Aman</h4>
                        <p class="text-muted">Keamanan dan kenyamanan anak adalah prioritas utama kami</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
                        <i class="fas fa-hand-holding-heart feature-icon mb-3"></i>
                        <h4>Pembentukan Karakter</h4>
                        <p class="text-muted">Menanamkan nilai-nilai moral dan akhlak mulia sejak dini</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="vision-mission py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">
                <i class="fas fa-bullseye text-success"></i> VISI DAN MISI
            </h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 shadow border-0 animate__animated animate__fadeInLeft">
                        <div class="card-body text-center p-5">
                            <div class="icon fs-1 mb-3">
                                <i class="fas fa-eye text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h3 class="card-title text-success mb-4">VISI</h3>
                            <p class="card-text lead">Terwujudnya Peserta Didik TK Pertiwi 14 Semarang Yang Sehat, Kreatif, Mandiri, Berakhlak Mulia dan Berjiwa Nasionalis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 shadow border-0 animate__animated animate__fadeInRight">
                        <div class="card-body text-center p-5">
                            <div class="icon fs-1 mb-3">
                                <i class="fas fa-bullseye text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h3 class="card-title text-success mb-4">MISI</h3>
                            <p class="card-text lead">Memastikan pembelajaran menggembirakan melalui penciptaan suasana belajar yang positif, aman, dan menyenangkan, dimana kegembiraan menjadi kondisi emosional yang mendukung optimal learning dan perkembangan holistik anak.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Preview Section -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-newspaper text-success"></i> Berita Terbaru</h2>
                <a href="news.php" class="btn btn-outline-success">Lihat Semua <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="row g-4">
                <?php
                require_once 'db.php';
                require_once 'helpers.php';
                $sql = "SELECT id, title, content, image_path, created_at FROM articles ORDER BY created_at DESC LIMIT 3";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Check if image exists, if not use placeholder
                        $image_path = !empty($row['image_path']) ? $row['image_path'] : '';
                        $image = get_placeholder_image_svg(400, 250);
                        
                        if (!empty($image_path) && file_exists(__DIR__ . '/' . $image_path)) {
                            $image = htmlspecialchars($image_path);
                        }
                        
                        echo "<div class='col-md-4'>";
                        echo "<div class='card news-preview-card shadow-sm h-100'>";
                        echo "<img src='" . $image . "' class='card-img-top' alt='" . htmlspecialchars($row['title']) . "' style='height: 200px; object-fit: cover;' onerror=\"this.src='" . get_placeholder_image_svg(400, 250) . "'\">";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
                        echo "<p class='card-text text-muted'>" . htmlspecialchars(substr($row['content'], 0, 100)) . "...</p>";
                        echo "<div class='d-flex justify-content-between align-items-center'>";
                        echo "<small class='text-muted'><i class='far fa-calendar'></i> " . date('d M Y', strtotime($row['created_at'])) . "</small>";
                        echo "<a href='article.php?id=" . $row['id'] . "' class='btn btn-sm btn-success'>Baca <i class='fas fa-arrow-right'></i></a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-12'><div class='alert alert-info text-center'>Belum ada berita</div></div>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">
                <i class="fas fa-question-circle text-success"></i> Pertanyaan yang Sering Diajukan
            </h2>
            <div class="accordion mx-auto" id="faqAccordion" style="max-width: 800px;">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Berapa usia minimal untuk mendaftar di TK Pertiwi 14?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Usia minimal untuk mendaftar adalah 4 tahun untuk Kelompok A dan 5 tahun untuk Kelompok B.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Apa saja dokumen yang diperlukan untuk pendaftaran?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Dokumen yang diperlukan: Fotocopy Akta Kelahiran, Fotocopy Kartu Keluarga, Pas Foto anak 3x4 (2 lembar), dan Fotocopy KTP Orang Tua.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Kapan waktu pendaftaran dibuka?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pendaftaran siswa baru dibuka setiap tahun pada bulan Januari hingga April untuk tahun ajaran baru yang dimulai bulan Juli.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Apa saja fasilitas yang tersedia?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Fasilitas yang tersedia meliputi ruang kelas ber-AC, area bermain outdoor dan indoor, perpustakaan, ruang komputer, area seni, dan kantin.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            Apakah ada program ekstrakurikuler?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya, kami menyediakan berbagai program ekstrakurikuler seperti menari, menyanyi, melukis, dan olahraga yang disesuaikan dengan minat dan bakat anak.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #00e676 0%, #00b359 100%);">
        <div class="container text-center text-white">
            <h2 class="display-5 fw-bold mb-4">Siap Bergabung dengan Keluarga Besar TK Pertiwi 14?</h2>
            <p class="lead mb-4">Daftarkan putra-putri Anda sekarang dan berikan pendidikan terbaik untuk masa depan mereka!</p>
            <div class="d-grid gap-3 d-md-flex justify-content-center">
                <a href="registration.php" class="btn btn-light btn-lg px-5">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </a>
                <a href="contact.php" class="btn btn-outline-light btn-lg px-5">
                    <i class="fas fa-phone"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <section class="purpose py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">
                <i class="fas fa-target text-success"></i> TUJUAN PENDIDIKAN
            </h2>
            <p class="lead text-center mb-5">TK Pertiwi 14 menetapkan tujuan yang terukur untuk mewujudkan visi yang telah ditetapkan:</p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-start border-success border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">1</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title">Kesehatan Fisik & Mental</h5>
                                    <p class="card-text">Mengembangkan kesehatan fisik dan mental anak melalui pembiasaan pola hidup sehat, aktivitas motorik yang beragam, dan penciptaan lingkungan pembelajaran yang aman dan nyaman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-start border-success border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">2</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title">Kemandirian Anak</h5>
                                    <p class="card-text">Mengembangkan kemandirian anak sesuai tahap perkembangannya melalui stimulasi yang tepat pada seluruh aspek kognitif, bahasa, dan keterampilan berpikir dasar.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-start border-success border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">3</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title">Kreativitas & Inovasi</h5>
                                    <p class="card-text">Menumbuhkan kreativitas dan inovasi dengan memberikan kesempatan luas bagi anak untuk berekspresi, bereksperimen, dan menghasilkan karya-karya orisinal melalui berbagai media dan aktivitas seni.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-start border-success border-4 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">4</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title">Karakter & Akhlak Mulia</h5>
                                    <p class="card-text">Membentuk karakter dan akhlak mulia melalui keteladanan, pembiasaan, internalisasi nilai-nilai spiritual dalam kehidupan sehari-hari.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card border-start border-success border-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <span class="badge bg-success rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">5</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="card-title">Kesiapan Sekolah</h5>
                                    <p class="card-text">Mempersiapkan kesiapan sekolah yang mencakup kemampuan akademik dasar, sosial-emosional, dan kemandirian yang diperlukan untuk melanjutkan pendidikan ke jenjang berikutnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if(target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.card, .stat-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
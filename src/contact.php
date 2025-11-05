<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - TK Pertiwi 14</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .contact-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }
        .contact-card:hover {
            transform: translateY(-10px);
        }
        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #00e676, #00b359);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
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
                    <li class="nav-item"><a class="nav-link" href="gallery.php"><i class="fas fa-images"></i> GALERI</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php"><i class="fas fa-envelope"></i> KONTAK</a></li>
                </ul>
            </div>
            <a href="registration.php" class="btn btn-outline-dark"><i class="fas fa-user-plus"></i> PENDAFTARAN</a>
        </div>
    </header>

    <div class="content-wrapper">
    <!-- Header Section -->
    <section class="py-5 bg-success text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3"><i class="fas fa-envelope"></i> Hubungi Kami</h1>
            <p class="lead">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami!</p>
        </div>
    </section>

    <!-- Contact Cards -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card contact-card shadow-sm text-center p-4 h-100">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5>Alamat</h5>
                        <p class="text-muted">Jl. Pahlawan No. 1, Mugassari, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50249</p>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-map"></i> Lihat di Peta
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card contact-card shadow-sm text-center p-4 h-100">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Telepon</h5>
                        <p class="text-muted">+62 812-3456-7890</p>
                        <a href="tel:+628123456789" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-phone-alt"></i> Hubungi Sekarang
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card contact-card shadow-sm text-center p-4 h-100">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Email</h5>
                        <p class="text-muted">tkpertiwi14@email.com</p>
                        <a href="mailto:tkpertiwi14@email.com" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-paper-plane"></i> Kirim Email
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <h3 class="text-center mb-4">
                                <i class="fas fa-comments text-success"></i> Kirim Pesan
                            </h3>
                            <?php if(isset($_GET['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fas fa-check-circle"></i> Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php endif; ?>
                            
                            <form action="submit_contact.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama Lengkap *</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Nomor Telepon *</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subjek *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Pilih Subjek</option>
                                        <option value="Pendaftaran">Pendaftaran Siswa Baru</option>
                                        <option value="Informasi Umum">Informasi Umum</option>
                                        <option value="Kurikulum">Kurikulum & Pembelajaran</option>
                                        <option value="Fasilitas">Fasilitas</option>
                                        <option value="Biaya">Biaya Pendidikan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Pesan *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Tuliskan pesan Anda di sini..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100 py-3">
                                    <i class="fas fa-paper-plane"></i> Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h3 class="text-center mb-4"><i class="fas fa-map-marked-alt text-success"></i> Lokasi Kami</h3>
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.206545845267!2d110.4534!3d-6.9931!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTknMzUuMiJTIDExMMKwMjcnMTIuMiJF!5e0!3m2!1sen!2sid!4v1234567890" 
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Working Hours -->
    <section class="py-5">
        <div class="container">
            <h3 class="text-center mb-4"><i class="fas fa-clock text-success"></i> Jam Operasional</h3>
            <div class="card shadow-sm mx-auto" style="max-width: 600px;">
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td><i class="fas fa-calendar-day text-success"></i> <strong>Senin - Kamis</strong></td>
                            <td class="text-end">07:30 - 12:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-day text-success"></i> <strong>Jumat</strong></td>
                            <td class="text-end">07:30 - 11:00</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-day text-muted"></i> <strong>Sabtu - Minggu</strong></td>
                            <td class="text-end text-muted">Libur</td>
                        </tr>
                    </table>
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
    </script>
</body>
</html>
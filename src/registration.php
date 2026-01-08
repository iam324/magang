<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru - TK Pertiwi 14</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .registration-header {
            background: linear-gradient(135deg, #00e676 0%, #00b359 100%);
            color: white;
            padding: 3rem 0;
        }
        .step {
            text-align: center;
            position: relative;
        }
        .step-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #00e676, #00b359);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 1rem;
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
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> KONTAK</a></li>
                </ul>
            </div>
            <a href="registration.php" class="btn btn-light"><i class="fas fa-user-plus"></i> PENDAFTARAN</a>
        </div>
    </header>

    <div class="content-wrapper">
    <!-- Header Section -->
    <section class="py-5 bg-success text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3"><i class="fas fa-user-plus"></i> Pendaftaran Siswa Baru</h1>
            <p class="lead">Tahun Ajaran 2025/2026</p>
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-4 h-100">
                        <i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>
                        <h5>Periode Pendaftaran</h5>
                        <p class="text-muted">Januari - April 2025</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-4 h-100">
                        <i class="fas fa-child fa-3x text-success mb-3"></i>
                        <h5>Usia Siswa</h5>
                        <p class="text-muted">4-6 Tahun</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-4 h-100">
                        <i class="fas fa-money-bill-wave fa-3x text-success mb-3"></i>
                        <h5>Biaya Pendaftaran</h5>
                        <p class="text-muted">Gratis</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5"><i class="fas fa-list-ol text-success"></i> Langkah Pendaftaran</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h5>Isi Formulir</h5>
                        <p class="text-muted">Lengkapi formulir pendaftaran online</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-number">2</div>
                        <h5>Verifikasi Data</h5>
                        <p class="text-muted">Datang ke Sekolah dan Memverifikasi data Anda</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step">
                        <div class="step-number">3</div>
                        <h5>Konfirmasi</h5>
                        <p class="text-muted">Terima konfirmasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Form -->
    <section class="registration-form py-5 bg-light">
        <div class="container">
            <div class="card shadow-lg border-0 mx-auto" style="max-width: 800px;">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">
                        <i class="fas fa-edit text-success"></i> Formulir Pendaftaran
                    </h2>
                    
                    <?php if(isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle"></i> Pendaftaran berhasil! Kami akan menghubungi Anda segera.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <form action="submit_registration.php" method="POST" class="needs-validation" novalidate>
                        <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-user text-success"></i> Data Anak</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap Anak *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">Nama lengkap harus diisi</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dob" class="form-label">Tanggal Lahir *</label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                                <div class="invalid-feedback">Tanggal lahir harus diisi</div>
                            </div>
                        </div>

                        <h5 class="border-bottom pb-2 mb-3 mt-4"><i class="fas fa-users text-success"></i> Data Orang Tua</h5>
                        <div class="mb-3">
                            <label for="parent_name" class="form-label">Nama Orang Tua / Wali *</label>
                            <input type="text" class="form-control" id="parent_name" name="parent_name" required>
                            <div class="invalid-feedback">Nama orang tua harus diisi</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Email harus valid</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Nomor Telepon / WhatsApp *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9+\-\s]+">
                                <div class="invalid-feedback">Nomor telepon harus valid</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap *</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                            <div class="invalid-feedback">Alamat harus diisi</div>
                        </div>

                        <h5 class="border-bottom pb-2 mb-3 mt-4"><i class="fas fa-comment text-success"></i> Informasi Tambahan</h5>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan / Catatan (Opsional)</label>
                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Tuliskan informasi tambahan yang perlu kami ketahui..."></textarea>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="agree" required>
                            <label class="form-check-label" for="agree">
                                Saya menyetujui bahwa data yang saya berikan adalah benar dan dapat dipertanggungjawabkan *
                            </label>
                            <div class="invalid-feedback">Anda harus menyetujui pernyataan ini</div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-3">
                            <i class="fas fa-paper-plane"></i> Kirim Formulir Pendaftaran
                        </button>
                        <p class="text-center mt-3 text-muted mb-0">
                            <small>* Wajib diisi</small>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Required Documents -->
            <div class="mt-5">
                <div class="card shadow-sm mx-auto" style="max-width: 800px;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-file-alt text-success"></i> Dokumen yang Diperlukan</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fas fa-check text-success"></i> Fotocopy Akta Kelahiran (1 lembar)</li>
                            <li class="list-group-item"><i class="fas fa-check text-success"></i> Fotocopy Kartu Keluarga (1 lembar)</li>
                            <li class="list-group-item"><i class="fas fa-check text-success"></i> Pas Foto anak ukuran 3x4 (2 lembar)</li>
                            <li class="list-group-item"><i class="fas fa-check text-success"></i> Fotocopy KTP Orang Tua (masing-masing 1 lembar)</li>
                        </ul>
                        <div class="alert alert-info mt-3 mb-0">
                            <i class="fas fa-info-circle"></i> <strong>Catatan:</strong> Dokumen-dokumen di atas dapat dibawa saat verifikasi data di sekolah.
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
        // Form validation
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

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
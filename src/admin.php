<?php
require_once 'auth_check.php';
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - TK Pertiwi 14</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: fixed !important;
            top: 0;
            left: 0;
            z-index: 9999 !important;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8) !important;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin: 0.25rem 0.5rem;
            transition: all 0.3s;
            cursor: pointer !important;
            display: block !important;
            text-decoration: none !important;
            user-select: none;
            border: none;
            background: transparent;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15) !important;
            color: #FFFF00 !important;
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.25) !important;
            color: white !important;
            font-weight: 600;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }
        .stat-card-admin {
            border-left: 4px solid #00e676;
        }
        .content-section {
            display: none !important;
            animation: fadeIn 0.3s ease-in;
        }
        .content-section.active {
            display: block !important;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative !important;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center py-4">
            <img src="../assets/tkpertiwilogo-removebg-preview.png" alt="Logo" class="img-fluid mb-3" style="max-height: 80px;">
            <h5 class="text-white">Admin Panel</h5>
            <p class="text-white-50 mb-0"><small><?php echo htmlspecialchars($_SESSION['admin_username']); ?></small></p>
        </div>
        <nav class="nav flex-column px-2">
            <a href="#" class="nav-link active" data-section="dashboard">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="#" class="nav-link" data-section="news">
                <i class="fas fa-newspaper"></i> Kelola Berita
            </a>
            <a href="#" class="nav-link" data-section="registrations">
                <i class="fas fa-user-plus"></i> Pendaftaran
            </a>
            <a href="#" class="nav-link" data-section="contacts">
                <i class="fas fa-envelope"></i> Pesan Kontak
            </a>
            <a href="#" class="nav-link" data-section="gallery">
                <i class="fas fa-images"></i> Galeri
            </a>
            <hr class="text-white-50 mx-3">
            <a class="nav-link" href="index.php" target="_blank">
                <i class="fas fa-globe"></i> Lihat Website
            </a>
            <a class="nav-link text-danger" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
                    <!-- Dashboard Section -->
                    <div id="dashboard-section" class="content-section active">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2><i class="fas fa-tachometer-alt text-success"></i> Dashboard</h2>
                            <span class="text-muted"><?php echo date('l, d F Y'); ?></span>
                        </div>

                        <div class="row g-4 mb-4">
                            <?php
                            // Get statistics with error handling
                            $total_articles = 0;
                            $total_registrations = 0;
                            $total_contacts = 0;
                            $total_gallery = 0;
                            
                            // Check and count articles
                            $result = $conn->query("SELECT COUNT(*) as count FROM articles");
                            if($result) $total_articles = $result->fetch_assoc()['count'];
                            
                            // Check and count registrations
                            $table_check = $conn->query("SHOW TABLES LIKE 'registrations'");
                            if($table_check && $table_check->num_rows > 0) {
                                $result = $conn->query("SELECT COUNT(*) as count FROM registrations WHERE status='pending'");
                                if($result) $total_registrations = $result->fetch_assoc()['count'];
                            }
                            
                            // Check and count contacts
                            $table_check = $conn->query("SHOW TABLES LIKE 'contacts'");
                            if($table_check && $table_check->num_rows > 0) {
                                $result = $conn->query("SELECT COUNT(*) as count FROM contacts WHERE status='unread'");
                                if($result) $total_contacts = $result->fetch_assoc()['count'];
                            }
                            
                            // Check and count gallery
                            $table_check = $conn->query("SHOW TABLES LIKE 'gallery'");
                            if($table_check && $table_check->num_rows > 0) {
                                $result = $conn->query("SELECT COUNT(*) as count FROM gallery");
                                if($result) $total_gallery = $result->fetch_assoc()['count'];
                            }
                            ?>
                            <div class="col-md-3">
                                <div class="card stat-card-admin shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="text-muted">Total Berita</h6>
                                                <h2 class="mb-0"><?php echo $total_articles; ?></h2>
                                            </div>
                                            <div class="text-success">
                                                <i class="fas fa-newspaper fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-admin shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="text-muted">Pendaftaran Baru</h6>
                                                <h2 class="mb-0"><?php echo $total_registrations; ?></h2>
                                            </div>
                                            <div class="text-primary">
                                                <i class="fas fa-user-plus fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-admin shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="text-muted">Pesan Belum Dibaca</h6>
                                                <h2 class="mb-0"><?php echo $total_contacts; ?></h2>
                                            </div>
                                            <div class="text-warning">
                                                <i class="fas fa-envelope fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-admin shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="text-muted">Foto Galeri</h6>
                                                <h2 class="mb-0"><?php echo $total_gallery; ?></h2>
                                            </div>
                                            <div class="text-info">
                                                <i class="fas fa-images fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activities -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0"><i class="fas fa-clock"></i> Berita Terbaru</h5>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $recent_news = $conn->query("SELECT title, created_at FROM articles ORDER BY created_at DESC LIMIT 5");
                                        if($recent_news->num_rows > 0):
                                            while($row = $recent_news->fetch_assoc()):
                                        ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                            <span><?php echo htmlspecialchars(substr($row['title'], 0, 40)); ?>...</span>
                                            <small class="text-muted"><?php echo date('d/m/Y', strtotime($row['created_at'])); ?></small>
                                        </div>
                                        <?php endwhile; else: ?>
                                        <p class="text-muted text-center">Belum ada berita</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="fas fa-users"></i> Pendaftaran Terbaru</h5>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $recent_reg = $conn->query("SELECT name, created_at FROM registrations ORDER BY created_at DESC LIMIT 5");
                                        if($recent_reg->num_rows > 0):
                                            while($row = $recent_reg->fetch_assoc()):
                                        ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                            <span><?php echo htmlspecialchars($row['name']); ?></span>
                                            <small class="text-muted"><?php echo date('d/m/Y', strtotime($row['created_at'])); ?></small>
                                        </div>
                                        <?php endwhile; else: ?>
                                        <p class="text-muted text-center">Belum ada pendaftaran</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Management Section -->
                    <div id="news-section" class="content-section">
                        <h2 class="mb-4"><i class="fas fa-newspaper text-success"></i> Kelola Berita</h2>

                        <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success_message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['success_message']); endif; ?>

                        <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_SESSION['error_message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['error_message']); endif; ?>
                        
                        <!-- Add News Form -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="fas fa-plus"></i> Tambah Berita Baru</h5>
                            </div>
                            <div class="card-body">
                                <form action="add_news.php" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul Berita *</label>
                                        <input type="text" id="title" name="title" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Isi Berita *</label>
                                        <textarea id="content" name="content" class="form-control" rows="8" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Gambar Berita</label>
                                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Simpan Berita
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- News List -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Berita</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT id, title, created_at FROM articles ORDER BY created_at DESC";
                                            $result = $conn->query($sql);
                                            $no = 1;
                                            if ($result->num_rows > 0):
                                                while($row = $result->fetch_assoc()):
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($row["title"]); ?></td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($row["created_at"])); ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href='edit_news.php?id=<?php echo $row["id"]; ?>' class='btn btn-sm btn-warning'>
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <button type='button' class='btn btn-sm btn-danger' onclick='confirmDelete(<?php echo $row["id"]; ?>, "<?php echo htmlspecialchars(addslashes($row["title"])); ?>")'>
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endwhile; else: ?>
                                            <tr><td colspan="4" class="text-center text-muted">Belum ada berita</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel">
                                            <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Berita
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-3">Apakah Anda yakin ingin menghapus berita ini?</p>
                                        <div class="alert alert-warning">
                                            <strong><i class="fas fa-file-alt"></i> Judul:</strong>
                                            <p class="mb-0" id="newsTitle"></p>
                                        </div>
                                        <p class="text-muted mb-0"><small><i class="fas fa-info-circle"></i> Berita yang sudah dihapus tidak dapat dikembalikan.</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> Batal
                                        </button>
                                        <form id="deleteForm" action="delete_news.php" method="post" style="display:inline;">
                                            <input type="hidden" name="id" id="deleteNewsId">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Ya, Hapus Berita
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Registrations Section -->
                    <div id="registrations-section" class="content-section">
                        <h2 class="mb-4"><i class="fas fa-user-plus text-primary"></i> Data Pendaftaran</h2>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anak</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Orang Tua</th>
                                                <th>Kontak</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM registrations ORDER BY created_at DESC";
                                            $result = $conn->query($sql);
                                            $no = 1;
                                            if ($result && $result->num_rows > 0):
                                                while($row = $result->fetch_assoc()):
                                                // Calculate age
                                                $age = '';
                                                if (!empty($row["dob"])) {
                                                    $dob = new DateTime($row["dob"]);
                                                    $now = new DateTime();
                                                    $diff = $now->diff($dob);
                                                    $age = $diff->y;
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                                <td>
                                                    <?php 
                                                    if (!empty($row["dob"])) {
                                                        echo date('d F Y', strtotime($row["dob"])); 
                                                    } else {
                                                        echo '<span class="text-muted">-</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($row["parent_name"]); ?></td>
                                                <td>
                                                    <?php echo htmlspecialchars($row["phone"]); ?><br>
                                                    <small><?php echo htmlspecialchars($row["email"]); ?></small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?php echo $row['status']=='pending'?'warning':($row['status']=='approved'?'success':'danger'); ?>">
                                                        <?php echo ucfirst($row['status']); ?>
                                                    </span>
                                                </td>
                                                <td class="text-nowrap">
                                                    <button class="btn btn-sm btn-info me-1" 
                                                            onclick="showRegistrationDetail(<?php echo htmlspecialchars(json_encode($row)); ?>, '<?php echo $age; ?>')" 
                                                            title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <?php if($row['status'] == 'pending'): ?>
                                                    <button class="btn btn-sm btn-success me-1" 
                                                            onclick="approveRegistration(<?php echo $row['id']; ?>)" 
                                                            title="Setujui">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger me-1" 
                                                            onclick="rejectRegistration(<?php echo $row['id']; ?>)" 
                                                            title="Tolak">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    <?php else: ?>
                                                    <button class="btn btn-sm btn-danger" 
                                                            onclick="deleteRegistration(<?php echo $row['id']; ?>)" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endwhile; else: ?>
                                            <tr><td colspan="7" class="text-center text-muted">Belum ada pendaftaran</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Single Dynamic Modal for Registration Details -->
                        <div class="modal fade" id="registrationDetailModal" tabindex="-1" aria-labelledby="registrationDetailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="registrationDetailModalLabel">
                                            <i class="fas fa-user-circle"></i> Detail Pendaftaran
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <h6 class="text-success border-bottom pb-2">
                                                    <i class="fas fa-child"></i> Data Anak
                                                </h6>
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td width="40%" class="text-muted"><strong>Nama</strong></td>
                                                        <td id="detail-child-name">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted"><strong>Tanggal Lahir</strong></td>
                                                        <td id="detail-child-dob">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted"><strong>Usia</strong></td>
                                                        <td id="detail-child-age">-</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <h6 class="text-success border-bottom pb-2">
                                                    <i class="fas fa-user"></i> Data Orang Tua
                                                </h6>
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td width="40%" class="text-muted"><strong>Nama</strong></td>
                                                        <td id="detail-parent-name">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted"><strong>Email</strong></td>
                                                        <td id="detail-parent-email">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted"><strong>Telepon</strong></td>
                                                        <td id="detail-parent-phone">-</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <h6 class="text-success border-bottom pb-2">
                                                    <i class="fas fa-map-marker-alt"></i> Alamat
                                                </h6>
                                                <p class="bg-light p-3 rounded" id="detail-address">-</p>
                                            </div>
                                        </div>
                                        <div class="row" id="detail-message-section" style="display:none;">
                                            <div class="col-12 mb-3">
                                                <h6 class="text-success border-bottom pb-2">
                                                    <i class="fas fa-comment"></i> Pesan
                                                </h6>
                                                <p class="bg-light p-3 rounded" id="detail-message">-</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="text-success border-bottom pb-2">
                                                    <i class="fas fa-info-circle"></i> Informasi Pendaftaran
                                                </h6>
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td width="30%" class="text-muted"><strong>Status</strong></td>
                                                        <td id="detail-status">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted"><strong>Tanggal Daftar</strong></td>
                                                        <td id="detail-created-at">-</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="detail-action-buttons">
                                            <!-- Buttons will be inserted here by JavaScript -->
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Success Notification Modal -->
                        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-body text-center p-5">
                                        <div class="mb-4">
                                            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                                        </div>
                                        <h4 class="mb-3" id="successTitle">Berhasil!</h4>
                                        <p class="text-muted mb-0" id="successMessage">Operasi berhasil dilakukan</p>
                                    </div>
                                    <div class="modal-footer border-0 justify-content-center pb-4">
                                        <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal" onclick="location.reload()">
                                            <i class="fas fa-check"></i> OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Notification Modal -->
                        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-body text-center p-5">
                                        <div class="mb-4">
                                            <i class="fas fa-times-circle text-danger" style="font-size: 5rem;"></i>
                                        </div>
                                        <h4 class="mb-3">Gagal!</h4>
                                        <p class="text-muted mb-0" id="errorMessage">Terjadi kesalahan</p>
                                    </div>
                                    <div class="modal-footer border-0 justify-content-center pb-4">
                                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm Delete Modal -->
                        <div class="modal fade" id="confirmDeleteRegistrationModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-body text-center p-5">
                                        <div class="mb-4">
                                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 5rem;"></i>
                                        </div>
                                        <h4 class="mb-3">Konfirmasi Hapus</h4>
                                        <p class="text-muted mb-0">Apakah Anda yakin ingin menghapus data pendaftaran ini?</p>
                                        <p class="text-danger small mb-0 mt-2"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
                                        <input type="hidden" id="deleteRegistrationId" value="">
                                    </div>
                                    <div class="modal-footer border-0 justify-content-center pb-4">
                                        <button type="button" class="btn btn-secondary px-4 me-2" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> Batal
                                        </button>
                                        <button type="button" class="btn btn-danger px-4" onclick="confirmDeleteRegistration()">
                                            <i class="fas fa-trash"></i> Ya, Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contacts Section -->
                    <div id="contacts-section" class="content-section">
                        <h2 class="mb-4"><i class="fas fa-envelope text-warning"></i> Pesan Kontak</h2>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Subjek</th>
                                                <th>Pesan</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
                                            $result = $conn->query($sql);
                                            $no = 1;
                                            if ($result && $result->num_rows > 0):
                                                while($row = $result->fetch_assoc()):
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>
                                                    <?php echo htmlspecialchars($row["name"]); ?><br>
                                                    <small><?php echo htmlspecialchars($row["email"]); ?></small>
                                                </td>
                                                <td><?php echo htmlspecialchars($row["subject"]); ?></td>
                                                <td><?php echo htmlspecialchars(substr($row["message"], 0, 50)); ?>...</td>
                                                <td><?php echo date('d/m/Y', strtotime($row["created_at"])); ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo $row['status']=='unread'?'danger':'secondary'; ?>">
                                                        <?php echo ucfirst($row['status']); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php endwhile; else: ?>
                                            <tr><td colspan="6" class="text-center text-muted">Belum ada pesan</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Section -->
                    <div id="gallery-section" class="content-section">
                        <h2 class="mb-4"><i class="fas fa-images text-info"></i> Kelola Galeri</h2>

                        <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success_message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['success_message']); endif; ?>

                        <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_SESSION['error_message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['error_message']); endif; ?>
                        
                        <!-- Add Gallery Form -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="fas fa-plus"></i> Tambah Foto Galeri</h5>
                            </div>
                            <div class="card-body">
                                <form action="add_gallery.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="gallery_title" class="form-label">Judul Foto *</label>
                                                <input type="text" id="gallery_title" name="title" class="form-control" required placeholder="Contoh: Kegiatan Belajar Mengajar">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Kategori *</label>
                                                <select id="category" name="category" class="form-select" required>
                                                    <option value="">-- Pilih Kategori --</option>
                                                    <option value="kegiatan">Kegiatan</option>
                                                    <option value="pembelajaran">Pembelajaran</option>
                                                    <option value="event">Event</option>
                                                    <option value="fasilitas">Fasilitas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Deskripsi singkat tentang foto ini..."></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gallery_image" class="form-label">Upload Foto *</label>
                                        <input type="file" id="gallery_image" name="image" class="form-control" accept="image/*" required>
                                        <small class="text-muted">Format: JPG, JPEG, PNG, atau GIF. Maksimal 5MB</small>
                                    </div>
                                    <button type="submit" class="btn btn-info text-white">
                                        <i class="fas fa-upload"></i> Upload Foto
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Gallery List -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Foto Galeri</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                // Check if gallery table exists
                                $table_check = $conn->query("SHOW TABLES LIKE 'gallery'");
                                
                                if($table_check && $table_check->num_rows > 0):
                                    $sql = "SELECT id, title, description, image_path, category, created_at FROM gallery ORDER BY created_at DESC";
                                    $result = $conn->query($sql);
                                    
                                    if ($result && $result->num_rows > 0):
                                ?>
                                <div class="row g-3">
                                    <?php while($row = $result->fetch_assoc()): ?>
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <?php 
                                            $image_path = !empty($row['image_path']) ? $row['image_path'] : '';
                                            $image = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="400" height="250"%3E%3Crect fill="%2300e676" width="400" height="250"/%3E%3Ctext fill="white" font-family="Arial" font-size="20" x="50%25" y="50%25" text-anchor="middle" dominant-baseline="middle"%3EGaleri%3C/text%3E%3C/svg%3E';
                                            
                                            if (!empty($image_path) && file_exists(__DIR__ . '/' . $image_path)) {
                                                $image = htmlspecialchars($image_path);
                                            }
                                            ?>
                                            <img src="<?php echo $image; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['title']); ?>" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h6>
                                                <p class="card-text"><small class="text-muted"><?php echo htmlspecialchars($row['description']); ?></small></p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="badge bg-info"><?php echo htmlspecialchars($row['category']); ?></span>
                                                    <small class="text-muted"><?php echo date('d/m/Y', strtotime($row['created_at'])); ?></small>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-white">
                                                <form action="delete_gallery.php" method="post" style="display:inline;" onsubmit="return confirm('Hapus foto ini dari galeri?');">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                                <?php else: ?>
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle"></i> Belum ada foto di galeri. Silakan tambahkan foto baru di atas.
                                </div>
                                <?php endif; ?>
                                <?php else: ?>
                                <div class="alert alert-warning text-center">
                                    <i class="fas fa-exclamation-triangle"></i> <strong>Tabel galeri belum ada!</strong><br>
                                    Silakan jalankan <a href="setup_admin.php" class="alert-link">setup_admin.php</a> terlebih dahulu.
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to show section - Enhanced version with event listeners
        function showSection(sectionName) {
            console.log('=== showSection called ===');
            console.log('Section name:', sectionName);
            
            try {
                // Remove active from all nav links
                const allLinks = document.querySelectorAll('.sidebar .nav-link');
                console.log('Found nav links:', allLinks.length);
                
                allLinks.forEach(function(link) {
                    link.classList.remove('active');
                });

                // Add active to clicked link
                const activeLink = document.querySelector('[data-section="' + sectionName + '"]');
                if (activeLink) {
                    activeLink.classList.add('active');
                    console.log('Active link updated');
                } else {
                    console.warn('Active link not found for:', sectionName);
                }

                // Hide all sections
                const allSections = document.querySelectorAll('.content-section');
                console.log('Found sections:', allSections.length);
                
                allSections.forEach(function(section) {
                    section.classList.remove('active');
                    section.style.display = 'none';
                });

                // Show selected section
                const targetSection = document.getElementById(sectionName + '-section');
                if (targetSection) {
                    targetSection.classList.add('active');
                    targetSection.style.display = 'block';
                    console.log('✅ Section displayed:', sectionName);
                    
                    // Scroll to top
                    window.scrollTo(0, 0);
                } else {
                    console.error('❌ Section not found:', sectionName + '-section');
                }
            } catch (error) {
                console.error('Error in showSection:', error);
            }
            
            return false;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('=== Admin panel initializing ===');
            
            // Add click event listeners to all navigation links
            const navLinks = document.querySelectorAll('[data-section]');
            console.log('Setting up event listeners for', navLinks.length, 'links');
            
            navLinks.forEach(function(link) {
                const section = link.getAttribute('data-section');
                
                // Add event listener
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Link clicked:', section);
                    showSection(section);
                    return false;
                });
                
                console.log('Event listener added for:', section);
            });

            // Check URL parameters for section
            const urlParams = new URLSearchParams(window.location.search);
            const section = urlParams.get('section');

            if (section) {
                console.log('Opening section from URL:', section);
                setTimeout(function() {
                    showSection(section);
                }, 100);
            } else {
                // Show dashboard by default
                setTimeout(function() {
                    showSection('dashboard');
                }, 100);
            }
            
            console.log('=== Admin panel initialized ===');
        });

        // Function to show delete confirmation modal
        function confirmDelete(newsId, newsTitle) {
            // Set the news ID in the hidden input
            document.getElementById('deleteNewsId').value = newsId;
            // Set the news title in the modal
            document.getElementById('newsTitle').textContent = newsTitle;
            // Show the modal
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        // Function to show registration detail in modal
        function showRegistrationDetail(data, age) {
            // Fill child data
            document.getElementById('detail-child-name').textContent = data.name || '-';
            
            if (data.dob) {
                const dobDate = new Date(data.dob);
                const formattedDob = dobDate.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
                document.getElementById('detail-child-dob').textContent = formattedDob;
                document.getElementById('detail-child-age').innerHTML = age ? `<span class="badge bg-info">${age} tahun</span>` : '-';
            } else {
                document.getElementById('detail-child-dob').textContent = '-';
                document.getElementById('detail-child-age').textContent = '-';
            }
            
            // Fill parent data
            document.getElementById('detail-parent-name').textContent = data.parent_name || '-';
            document.getElementById('detail-parent-email').textContent = data.email || '-';
            document.getElementById('detail-parent-phone').textContent = data.phone || '-';
            
            // Fill address
            document.getElementById('detail-address').textContent = data.address || '-';
            
            // Fill message (show/hide section)
            if (data.message && data.message.trim() !== '') {
                document.getElementById('detail-message').textContent = data.message;
                document.getElementById('detail-message-section').style.display = 'block';
            } else {
                document.getElementById('detail-message-section').style.display = 'none';
            }
            
            // Fill status
            let statusBadge = '';
            if (data.status === 'pending') {
                statusBadge = '<span class="badge bg-warning">Pending</span>';
            } else if (data.status === 'approved') {
                statusBadge = '<span class="badge bg-success">Approved</span>';
            } else if (data.status === 'rejected') {
                statusBadge = '<span class="badge bg-danger">Rejected</span>';
            }
            document.getElementById('detail-status').innerHTML = statusBadge;
            
            // Fill created date
            if (data.created_at) {
                const createdDate = new Date(data.created_at);
                const formattedDate = createdDate.toLocaleString('id-ID', { 
                    day: '2-digit', 
                    month: '2-digit', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                document.getElementById('detail-created-at').textContent = formattedDate;
            }
            
            // Show/hide action buttons based on status
            const actionButtonsDiv = document.getElementById('detail-action-buttons');
            if (data.status === 'pending') {
                actionButtonsDiv.innerHTML = `
                    <button type="button" class="btn btn-success me-2" onclick="approveRegistration(${data.id}); bootstrap.Modal.getInstance(document.getElementById('registrationDetailModal')).hide();">
                        <i class="fas fa-check"></i> Setujui Pendaftaran
                    </button>
                    <button type="button" class="btn btn-danger me-2" onclick="rejectRegistration(${data.id}); bootstrap.Modal.getInstance(document.getElementById('registrationDetailModal')).hide();">
                        <i class="fas fa-times"></i> Tolak Pendaftaran
                    </button>
                `;
            } else {
                actionButtonsDiv.innerHTML = `
                    <button type="button" class="btn btn-danger me-2" onclick="deleteRegistration(${data.id}); bootstrap.Modal.getInstance(document.getElementById('registrationDetailModal')).hide();">
                        <i class="fas fa-trash"></i> Hapus Data
                    </button>
                `;
            }
            
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('registrationDetailModal'));
            modal.show();
        }

        // Function to show success modal
        function showSuccessModal(title, message) {
            document.getElementById('successTitle').textContent = title;
            document.getElementById('successMessage').textContent = message;
            const modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();
        }

        // Function to show error modal
        function showErrorModal(message) {
            document.getElementById('errorMessage').textContent = message;
            const modal = new bootstrap.Modal(document.getElementById('errorModal'));
            modal.show();
        }

        // Function to approve registration
        function approveRegistration(id) {
            fetch('update_registration_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&status=approved'
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    showSuccessModal('Pendaftaran Disetujui!', 'Pendaftaran berhasil disetujui. Status telah diupdate.');
                } else {
                    showErrorModal('Gagal menyetujui pendaftaran: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal('Terjadi kesalahan saat memproses permintaan');
            });
        }

        // Function to reject registration
        function rejectRegistration(id) {
            fetch('update_registration_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&status=rejected'
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    showSuccessModal('Pendaftaran Ditolak!', 'Pendaftaran berhasil ditolak. Status telah diupdate.');
                } else {
                    showErrorModal('Gagal menolak pendaftaran: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorModal('Terjadi kesalahan saat memproses permintaan');
            });
        }

        // Function to delete registration (show confirmation modal)
        function deleteRegistration(id) {
            document.getElementById('deleteRegistrationId').value = id;
            const modal = new bootstrap.Modal(document.getElementById('confirmDeleteRegistrationModal'));
            modal.show();
        }

        // Function to confirm delete registration
        function confirmDeleteRegistration() {
            const id = document.getElementById('deleteRegistrationId').value;
            
            fetch('delete_registration.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id
            })
            .then(response => response.json())
            .then(data => {
                // Close confirmation modal
                bootstrap.Modal.getInstance(document.getElementById('confirmDeleteRegistrationModal')).hide();
                
                if(data.success) {
                    showSuccessModal('Data Dihapus!', 'Data pendaftaran berhasil dihapus dari sistem.');
                } else {
                    showErrorModal('Gagal menghapus data: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                bootstrap.Modal.getInstance(document.getElementById('confirmDeleteRegistrationModal')).hide();
                showErrorModal('Terjadi kesalahan saat menghapus data');
            });
        }
    </script>
</body>
</html>



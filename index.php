<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            border-radius: 0 0 50px 50px;
            margin-bottom: 40px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .menu-card {
            text-align: center;
            padding: 30px;
            height: 100%;
        }
        .menu-card i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #667eea;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-building"></i> Sistem Karyawan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php"><i class="bi bi-house-door"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_karyawan.php"><i class="bi bi-people"></i> Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_absensi.php"><i class="bi bi-calendar-check"></i> Absensi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Sistem Manajemen Karyawan</h1>
            <p class="lead">Kelola data karyawan dan absensi dengan mudah dan efisien</p>
        </div>
    </div>

    <!-- Menu Utama -->
    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card menu-card">
                    <i class="bi bi-person-plus"></i>
                    <h4>Tambah Karyawan</h4>
                    <p>Daftarkan karyawan baru ke dalam sistem</p>
                    <a href="tambah_karyawan.php" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card menu-card">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <h4>Absen Masuk</h4>
                    <p>Catat waktu kedatangan karyawan</p>
                    <a href="absen_masuk.php" class="btn btn-success btn-lg">
                        <i class="bi bi-door-open"></i> Absen Masuk
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card menu-card">
                    <i class="bi bi-box-arrow-right"></i>
                    <h4>Absen Pulang</h4>
                    <p>Catat waktu kepulangan karyawan</p>
                    <a href="absen_pulang.php" class="btn btn-warning btn-lg">
                        <i class="bi bi-door-closed"></i> Absen Pulang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2023 Sistem Manajemen Karyawan. All rights reserved.</p>
            <p>
                <i class="bi bi-github"></i> 
                <i class="bi bi-linkedin"></i> 
                <i class="bi bi-twitter"></i>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
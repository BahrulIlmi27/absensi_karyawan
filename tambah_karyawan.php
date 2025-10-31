<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];
    
    $sql = "INSERT INTO karyawan (nama, jabatan, alamat, tanggal_bergabung) 
            VALUES ('$nama', '$jabatan', '$alamat', '$tanggal_bergabung')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Karyawan berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            margin: -30px -30px 30px -30px;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 30px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
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
                        <a class="nav-link" href="index.php"><i class="bi bi-house-door"></i> Beranda</a>
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

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="bi bi-person-plus"></i> Tambah Karyawan Baru</h2>
                <p>Isi data karyawan dengan lengkap</p>
            </div>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                        <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" required>
                    </div>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Simpan Data Karyawan
                    </button>
                </div>
                
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .table-container {
            margin: 30px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead {
            background-color: #f8f9fa;
        }
        .table tbody tr:hover {
            background-color: #f1f3f9;
        }
        .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            margin: 20px;
        }
        .btn-add:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
        .badge {
            font-size: 0.85em;
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
                        <a class="nav-link active" href="daftar_karyawan.php"><i class="bi bi-people"></i> Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_absensi.php"><i class="bi bi-calendar-check"></i> Absensi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="bi bi-people"></i> Daftar Karyawan</h2>
            <a href="tambah_karyawan.php" class="btn btn-primary btn-add">
                <i class="bi bi-plus-circle"></i> Tambah Karyawan
            </a>
        </div>
        
        <div class="table-container">
            <div class="table-header">
                <h3>Data Seluruh Karyawan</h3>
                <p>Total Karyawan: <?php 
                    $sql = "SELECT COUNT(*) as total FROM karyawan";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    echo $row['total'];
                ?></p>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Alamat</th>
                            <th>Tanggal Bergabung</th>
                            <th>Masa Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM karyawan ORDER BY nama ASC";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                // Hitung masa kerja
                                $tanggal_bergabung = new DateTime($row['tanggal_bergabung']);
                                $today = new DateTime();
                                $interval = $tanggal_bergabung->diff($today);
                                $masa_kerja = $interval->y . " tahun " . $interval->m . " bulan";
                                
                                echo "<tr>";
                                echo "<td><span class='badge bg-primary'>".$row['id']."</span></td>";
                                echo "<td><strong>".$row['nama']."</strong></td>";
                                echo "<td>".$row['jabatan']."</td>";
                                echo "<td>".$row['alamat']."</td>";
                                echo "<td>".date('d M Y', strtotime($row['tanggal_bergabung']))."</td>";
                                echo "<td>".$masa_kerja."</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4'>Tidak ada data karyawan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
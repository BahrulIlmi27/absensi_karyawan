<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi</title>
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
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
        .filter-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .status-badge {
            font-size: 0.85em;
        }
        .status-masuk {
            background-color: #ffc107;
        }
        .status-selesai {
            background-color: #28a745;
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
                        <a class="nav-link active" href="daftar_absensi.php"><i class="bi bi-calendar-check"></i> Absensi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4"><i class="bi bi-calendar-check"></i> Daftar Absensi Karyawan</h2>
        
        <!-- Filter -->
        <div class="filter-container">
            <form method="GET" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label">Filter Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" 
                               value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="karyawan" class="form-label">Filter Karyawan</label>
                        <select class="form-select" id="karyawan" name="karyawan">
                            <option value="">Semua Karyawan</option>
                            <?php
                            $sql = "SELECT * FROM karyawan ORDER BY nama ASC";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $selected = (isset($_GET['karyawan']) && $_GET['karyawan'] == $row['id']) ? 'selected' : '';
                                    echo "<option value='".$row['id']."' $selected>".$row['nama']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="table-container">
            <div class="table-header">
                <h3>Riwayat Absensi</h3>
                <p>Menampilkan data absensi karyawan</p>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Status</th>
                            <th>Durasi Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query dengan filter
                        $query = "SELECT a.id, k.nama, a.tanggal, a.jam_masuk, a.jam_pulang 
                                  FROM absensi a
                                  JOIN karyawan k ON a.id_karyawan = k.id
                                  WHERE 1=1";
                        
                        if (isset($_GET['tanggal']) && !empty($_GET['tanggal'])) {
                            $query .= " AND a.tanggal = '".$_GET['tanggal']."'";
                        }
                        
                        if (isset($_GET['karyawan']) && !empty($_GET['karyawan'])) {
                            $query .= " AND a.id_karyawan = ".$_GET['karyawan'];
                        }
                        
                        $query .= " ORDER BY a.tanggal DESC, a.jam_masuk DESC";
                        
                        $result = $conn->query($query);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                // Hitung durasi kerja
                                $durasi = "-";
                                if ($row['jam_pulang'] != NULL) {
                                    $masuk = new DateTime($row['jam_masuk']);
                                    $pulang = new DateTime($row['jam_pulang']);
                                    $interval = $masuk->diff($pulang);
                                    $durasi = $interval->h . " jam " . $interval->i . " menit";
                                }
                                
                                // Status
                                if ($row['jam_pulang'] == NULL) {
                                    $status = "<span class='badge status-badge status-masuk'>Masuk</span>";
                                } else {
                                    $status = "<span class='badge status-badge status-selesai'>Selesai</span>";
                                }
                                
                                echo "<tr>";
                                echo "<td><span class='badge bg-primary'>".$row['id']."</span></td>";
                                echo "<td><strong>".$row['nama']."</strong></td>";
                                echo "<td>".date('d M Y', strtotime($row['tanggal']))."</td>";
                                echo "<td>".$row['jam_masuk']."</td>";
                                echo "<td>".$row['jam_pulang']."</td>";
                                echo "<td>".$status."</td>";
                                echo "<td>".$durasi."</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center py-4'>Tidak ada data absensi</td></tr>";
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
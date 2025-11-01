<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_karyawan = $_POST['id_karyawan'];
    $tanggal = date('Y-m-d');
    $jam_masuk = date('H:i:s');
    
    $cek = "SELECT * FROM absensi WHERE id_karyawan = $id_karyawan AND tanggal = '$tanggal'";
    $result = $conn->query($cek);
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Anda sudah absen masuk hari ini!'); window.location='absen_masuk.php';</script>";
    } else {
        $sql = "INSERT INTO absensi (id_karyawan, tanggal, jam_masuk) 
                VALUES ($id_karyawan, '$tanggal', '$jam_masuk')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Absen masuk berhasil!'); window.location='index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .absen-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .absen-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 20px;
            margin: -30px -30px 30px -30px;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 12px 30px;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #218838 0%, #1ea080 100%);
        }
        .time-display {
            background-color: #e9f7ef;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
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
        <div class="absen-container">
            <div class="absen-header">
                <h2><i class="bi bi-box-arrow-in-right"></i> Absen Masuk</h2>
                <p>Silakan pilih nama Anda untuk melakukan absen masuk</p>
            </div>
            
            <div class="time-display">
                <h4><i class="bi bi-clock"></i> Waktu Sekarang</h4>
                <h3 id="current-time"></h3>
            </div>
            
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="id_karyawan" class="form-label">Pilih Karyawan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                        <select class="form-select" id="id_karyawan" name="id_karyawan" required>
                            <option value="">-- Pilih Karyawan --</option>
                            <?php
                            $sql = "SELECT * FROM karyawan ORDER BY nama ASC";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row['id']."'>".$row['nama']." - ".$row['jabatan']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-door-open"></i> Absen Masuk Sekarang
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
    <script>
        // Update waktu real-time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit' 
            });
            const dateString = now.toLocaleDateString('id-ID', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            document.getElementById('current-time').innerHTML = `${dateString}<br>${timeString}`;
        }
        
        updateTime();
        setInterval(updateTime, 1000);
    </script>
</body>
</html>
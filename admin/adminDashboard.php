<?php
include '../koneksi/koneksi.php';

$result = mysqli_query($conn, 'SELECT COUNT(*) AS jumlah_user FROM user');

// mysqli_fetch_assoc =  untuk mengambil hasil query dalam bentuk array asosiatif
$data =  mysqli_fetch_assoc($result);
$jumlahUser = $data['jumlah_user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="picture/logo (1).png" type="image/x-icon">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/admin/adminDashboard.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>DadProject</h2>
            </div>
            <ul>
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="manageUser.php">Pengguna</a></li>
                <li><a href="manageClasses.php">Kelas</a></li>
                <li><a href="manageCategoryClass.php">Kategori Kelas</a></li>
                <li><a href="manageContact.php">Kontak</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Dashboard</h1>
                <hr>
                <br>
                <p>Selamat Datang, Admin</p>
            </header>
            <div class="stats-container">
                <!-- Manajemen Pengguna -->
                <div class="stat-card">

                    <div class="stat-head">
                        <i class="fa-solid fa-user"></i>
                        <div class="side">
                            <h3><?= $jumlahUser; ?><p>Pengguna</p>
                            </h3>
                        </div>
                    </div>

                    <a href="manageUser.php">
                        <div class="stat-foot">
                            <p>Lihat Detail</p>
                            <i class="fa-solid fa-circle-right"></i>
                        </div>
                    </a>
                </div>

                <div class="stat-card">
                    <div class="stat-head">
                        <i class="fa-solid fa-landmark"></i>
                        <h3>20<p>Kelas</p>
                        </h3>
                    </div>
                    <a href="manageClasses.php">
                        <div class="stat-foot">
                            <p>Lihat Detail</p>
                            <i class="fa-solid fa-circle-right"></i>
                        </div>
                    </a>
                </div>

                <div class="stat-card">
                    <div class="stat-head">
                        <i class="fa-solid fa-folder-tree"></i>
                        <h3>20<p>Kategori Kelas</p>
                        </h3>
                    </div>
                    <a href="manageCategoryClass.php">
                        <div class="stat-foot">
                            <p>Lihat Detail</p>
                            <i class="fa-solid fa-circle-right"></i>
                        </div>
                    </a>
                </div>

                <div class="stat-card">
                    <div class="stat-head">
                        <i class="fa-solid fa-bell"></i>
                        <h3>
                            <p>Notifikasi</p>
                        </h3>
                    </div>
                    <a href="login.php">
                        <div class="stat-foot">
                            <p>Lihat Detail</p>
                            <i class="fa-solid fa-circle-right"></i>
                        </div>
                    </a>
                </div>

                <div class="stat-card">
                    <div class="stat-head">
                        <i class="fa-solid fa-chart-column"></i>
                        <h3>
                            <p>Statistika dan Data</p>
                        </h3>
                    </div>
                    <a href="login.php">
                        <div class="stat-foot">
                            <p>Lihat Detail</p>
                            <i class="fa-solid fa-circle-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
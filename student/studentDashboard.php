<?php
session_start();
$currentPage = $_GET['page'] ?? 'kelas';
include '../koneksi/koneksi.php';

// PAGINATION SETTINGS
$limit = 4; // JUMLAH DATA PER HALAMAN
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$offset = ($page - 1) * $limit;

// HITUNG TOTAL DATA DAN HALAMAN
$totalDataQuery = "SELECT COUNT(*) as total FROM kelas";
$totalResult = mysqli_query($conn, $totalDataQuery);
$totalData = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalData / $limit);

// AMBIL DATA SESUAI HALAMAN
$query = "SELECT * FROM kelas LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// GET STUDENT ID
$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- NAVBAR SECTION -->
    <nav>
        <div class="navbar">
            <img class="logo" src="../picture/logo1.png " alt="Dad project">
            <div class="links-container">
                <ul class="nav-links">
                    <li><a href="../index.php" class="<?= ($currentPage == 'home') ? 'active' : '' ?>">Home</a></li>
                    <li><a href="studentDashboard.php?page=notifikasi" class="<?= ($currentPage == 'notifikasi') ? 'active' : '' ?>">Notifikasi</a></li>
                    <li><a href="studentDashboard.php?page=kelas" class="<?= ($currentPage == 'kelas') ? 'active' : '' ?>">Kelas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- SIDEBAR SECTION -->
        <div class="sidebar-section">
            <?php include 'components/sidebarStudent.php'; ?>
        </div>

        <!-- MAIN SECTION -->
        <main>
            <div class="main-content">
                <?php if ($currentPage == 'notifikasi') : ?>
                    <h1>Notifikasi</h1>
                    <div class="notifikasi-container">
                        <div class="notifikasi-card">
                            <p><?= $student_id ?></p>
                        </div>
                    </div>
                    <div class="notifikasi-container">
                        <div class="notifikasi-card">
                            <p>Pesan</p>
                        </div>
                    </div>
                    <div class="notifikasi-container">
                        <div class="notifikasi-card">
                            <p>Pesan</p>
                        </div>
                    </div>

                <?php elseif ($currentPage == 'kelas') : ?>
                    <h1>Informasi Kelas</h1>
                    <div class=" kelas-container">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <!-- JAVASCRIPT -->
                        <div class="kelas-card">
                            <div class="kelas-head">
                                <div class="imgbox">
                                    <img src="../picture/<?= $row['foto']?>" alt="">
                                </div>
                                <div class="side">
                                    <h3><?= $row['title_kelas']?></h3>
                                </div>
                            </div>

                            <div class="kelas-foot">
                                <a href="#" class="kelas-link">
                                    <p>Lihat Detail</p>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>            
                    </div>
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="studentDashboard.php?page=kelas&p=<?= $page - 1 ?>">« Prev</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="studentDashboard.php?page=kelas&p=<?= $i ?>" 
                            class="<?= ($i == $page) ? 'active-page' : '' ?>">
                            <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <a href="studentDashboard.php?page=kelas&p=<?= $page + 1 ?>">Next »</a>
                        <?php endif; ?>
                    </div>

                <?php else : ?>
                    <h1>Halaman tidak ditemukan</h1>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>

</html>
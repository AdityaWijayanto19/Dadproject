<?php
session_start();
$currentPage = $_GET['page'] ?? 'kelas';
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
                            <p>Pesan</p>
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
                        <!-- JAVASCRIPT -->
                        <div class="kelas-card">
                            <div class="kelas-head">
                                <div class="imgbox">
                                    <img src="../picture/javascriptLogo.png" alt="">
                                </div>
                                <div class="side">
                                    <h3>Javascript</h3>
                                </div>
                            </div>

                            <div class="kelas-foot">
                                <a href="#" class="kelas-link">
                                    <p>Lihat Detail</p>
                                </a>
                            </div>
                        </div>

                        <!-- PHP -->
                        <div class="kelas-card">
                            <div class="kelas-head">
                                <div class="imgbox">
                                    <img src="../picture/phpLogo.png" alt="">
                                </div>
                                <div class="side">
                                    <h3>PHP</h3>
                                </div>
                            </div>

                            <div class="kelas-foot">
                                <a href="#" class="kelas-link">
                                    <p>Lihat Detail</p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <h1>Halaman tidak ditemukan</h1>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>

</html>
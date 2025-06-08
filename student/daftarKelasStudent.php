<?php
    session_start();
    $currentPage = 'kelas'; // Menandai halaman ini sebagai bagian dari 'kelas'
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas - Student</title>
    <link rel="stylesheet" href="css/student.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'components/sidebarStudent.php'; ?>
        <div class="content-area">
            <?php include 'components/navbarStudent.php'; ?>
            <main>
                <h1 class="page-title">Daftar Kelas</h1>
                <div class="main-content">
                    <div class="tabs">
                        <div class="tab-item active">Kelas Diikuti</div>
                        <div class="tab-item">Kelas Tersedia</div>
                    </div>

                    <a href="detailKelasStudent.php" class="class-list-item">
                        <div class="video-placeholder">
                            <i class="fa-solid fa-play"></i>
                        </div>
                        <div class="class-info">
                            <h3>Belajar JavaScript Dasar</h3>
                            <p>Pait Xjiot</p>
                            <span class="tag tag-enrolled">Lanjutkan Belajar</span>
                        </div>
                    </a>

                    <a href="detailKelasStudent.php" class="class-list-item">
                        <img src="https://images.unsplash.com/photo-1542744095-291d1f67b221" alt="Python Class">
                        <div class="class-info">
                            <h3>Belajar Python untuk Pemula</h3>
                            <p>Guin Xjiot</p>
                            <button class="btn btn-light tag-join">Gabung</button>
                        </div>
                    </a>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
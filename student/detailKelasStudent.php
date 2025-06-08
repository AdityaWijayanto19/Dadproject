<?php
    session_start();
    $currentPage = 'kelas'; // Halaman ini juga bagian dari 'kelas'
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas - Student</title>
    <link rel="stylesheet" href="css/student.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'components/sidebarStudent.php'; ?>
        <div class="content-area">
            <?php include 'components/navbarStudent.php'; ?>
            <main>
                <h1 class="page-title">Detail Kelas: Belajar JavaScript Dasar</h1>
                <div class="main-content">
                    <div class="tabs">
                        <div class="tab-item active">Daftar Materi</div>
                        <div class="tab-item">Mentor</div>
                        <div class="tab-item">Diskusi</div>
                    </div>
                    
                    <!-- Contoh Daftar Materi -->
                    <div class="class-list-item">
                        <div class="video-placeholder">
                            <i class="fa-solid fa-play"></i>
                        </div>
                        <div class="class-info">
                            <h3>1. Pengenalan JavaScript</h3>
                            <p>Durasi: 10 menit</p>
                        </div>
                    </div>
                    <div class="class-list-item">
                        <div class="video-placeholder">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="class-info">
                            <h3>2. Variabel dan Tipe Data</h3>
                            <p>Durasi: 15 menit</p>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</body>
</html>
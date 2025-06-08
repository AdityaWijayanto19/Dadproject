<?php
    session_start();
    $currentPage = 'notifikasi'; // Menandai halaman ini sebagai 'notifikasi'
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Student</title>
    <link rel="stylesheet" href="css/student.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'components/sidebarStudent.php'; ?>
        <div class="content-area">
            <?php include 'components/navbarStudent.php'; ?>
            <main>
                <h1 class="page-title">Notifikasi</h1>
                <div class="main-content">
                    <div class="notification-list">
                        <a href="#" class="notification-item">
                            <div class="notification-item-content">
                                <div class="notification-icon icon-f">F</div>
                                <div class="notification-text">
                                    <strong>Forum:</strong> Ada balasan baru di topik "Closure JS".
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right notification-arrow"></i>
                        </a>
                        <a href="#" class="notification-item">
                            <div class="notification-item-content">
                                <div class="notification-icon icon-u">U</div>
                                <div class="notification-text">
                                    <strong>Kelas Python:</strong> Materi baru "List & Tuples" telah ditambahkan.
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right notification-arrow"></i>
                        </a>
                    </div>
                    <br>
                    <button class="btn btn-light">Tandai Semua Dibaca</button>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
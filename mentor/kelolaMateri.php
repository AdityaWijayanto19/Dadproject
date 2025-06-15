<?php
session_start();
include '../koneksi/koneksi.php';

$mentor_id = $_SESSION['mentor_id'];
$kelas_id = $_GET['kelas_id'];

$queryKelas = mysqli_query($conn, "SELECT * FROM kelas WHERE kelas_id = '$kelas_id'");
$data_kelas = mysqli_fetch_assoc($queryKelas); 

$queryMentor = mysqli_query($conn, "
    SELECT user.nama_lengkap 
    FROM mentors 
    JOIN user ON mentors.user_id = user.user_id 
    WHERE mentors.mentor_id = '$mentor_id'
");

$dataMentor = mysqli_fetch_assoc($queryMentor);
$nama_mentor = $dataMentor['nama_lengkap'] ?? 'Mentor';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/mentorDashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include 'components/sidebar.php'; ?>
        <div class="content-area">
            <header class="header-kelas">
                <h1 class="page-title">Detail Kelas: <?= htmlspecialchars($data_kelas['title_kelas']) ?></h1>
                <div class="tabs">
                    <a href="#" class="tab-item active">Konten</a>
                    <a class="tab-item" href="uploadKonten.php?kelas_id=<?= $kelas_id ?>">Upload Konten</a>
                </div>
            </header>
            <main>
                <div class="class-list-item">
                    <div class="video-placeholder">
                        <i class="fa-solid fa-play"></i>
                    </div>
                    <div class="class-info">
                        <h3>Pengenalan JavaScript</h3>
                        <p>Pengenalan JavaScript dari 0 agar mudah di mengerti</p>
                    </div>
                    <div class="class-actions">
                        <a href="/path/to/edit/1" class="btn-action btn-edit" title="Edit Konten">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="btn-action btn-delete" title="Hapus Konten"
                            onclick="return confirm('Anda yakin ingin menghapus konten ini?');">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>

                <div class="class-list-item">
                    <div class="video-placeholder">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="class-info">
                        <h3>Variabel dan Tipe Data</h3>
                        <p>Belajar variable dan Tipe data semuanya</p>
                    </div>
                    <div class="class-actions">
                        <a href="/path/to/edit/2" class="btn-action btn-edit" title="Edit Konten">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="btn-action btn-delete" title="Hapus Konten"
                            onclick="return confirm('Anda yakin ingin menghapus konten ini?');">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
</body>

</html>
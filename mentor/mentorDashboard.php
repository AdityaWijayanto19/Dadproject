<?php
session_start();
include '../koneksi/koneksi.php';

$mentor_id = $_SESSION['mentor_id'];
$result = query("SELECT * FROM `kelas` WHERE `mentor_id` = '$mentor_id'");

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Mentor';
$nama_lengkap = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Mentor';

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mentor</title>
    <link rel="stylesheet" href="css/mentorDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <?php include 'components/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
                <hr>
                <p>Selamat Datang, <?= $nama_lengkap ?></p>
            </header>
            <div class="card-grid">
                <?php foreach ( $result as $row ): ?>
                    <div class="card">
                        <div class="class-card-banner"
                            style="background-image: url('../picture/<?= htmlspecialchars($row['foto']) ?>'); background-size: cover; background-position: center;">
                        </div>
                        <div class="class-card-content">
                            <h3><?= htmlspecialchars($row['title_kelas']) ?></h3>
                            <div class="class-card-stats"><?= htmlspecialchars($row['desk_kelas']) ?></div>
                            <div class="class-card-stats"><span>80 Students</span> • <span>15 Modul</span></div>
                        </div>
                        <div class="class-card-footer">
                            <div class="class-actions">
                                <a href="editKelas.php?kelas_id=<?= $row['kelas_id'] ?>" class="btn-action btn-edit"
                                    title="Edit Kelas">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="hapusKelas.php?kelas_id=<?= $row['kelas_id'] ?>" class="btn-action btn-delete"
                                    title="Hapus Kelas" onclick="return confirm('Anda yakin ingin menghapus Kelas ini?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                            <div>
                                <a class="btn btn-secondary" href="kelolaMateri.php?kelas_id=<?= $row['kelas_id'] ?>">
                                    Kelola Materi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </main>
    </div>
    <script src="js/navbar.js"></script>
</body>

</html>
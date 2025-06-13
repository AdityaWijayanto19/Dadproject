<?php
session_start();
include '../koneksi/koneksi.php';

$mentor_id = $_SESSION['mentor_id'];
$result = mysqli_query($conn, "SELECT * FROM `kelas` WHERE `mentor_id` = '$mentor_id'");

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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mentor</title>
    <link rel="stylesheet" href="css/mentorDashboard.css">
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
                <p>Selamat Datang, <?= $nama_mentor ?></p>
            </header>
            <div class="card-grid">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
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
                            <a class="btn btn-secondary" href="kelolaMateri.php?kelas_id=<?= $row['kelas_id'] ?>">Kelola
                                Materi</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </main>
    </div>
    <script src="js/navbar.js"></script>
</body>

</html>
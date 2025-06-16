<?php
session_start();
include '../koneksi/koneksi.php';

// Keamanan: Pastikan mentor sudah login
if (!isset($_SESSION['mentor_id'])) {
    header("Location: login.php"); // Ganti dengan halaman login Anda
    exit();
}

// Keamanan: Pastikan kelas_id ada di URL
if (!isset($_GET['kelas_id'])) {
    header("Location: mentorDashboard.php"); // Kembali ke dashboard jika tidak ada ID
    exit();
}

$mentor_id = $_SESSION['mentor_id'];
$kelas_id = $_GET['kelas_id'];

// Ambil data kelas untuk verifikasi kepemilikan dan menampilkan judul
$kelas_query = query("SELECT * FROM kelas WHERE kelas_id = '$kelas_id' AND mentor_id = '$mentor_id'");
if (count($kelas_query) == 0) {
    // Jika kelas tidak ditemukan atau bukan milik mentor ini, kembalikan ke dashboard
    header("Location: mentorDashboard.php");
    exit();
}
$kelas = $kelas_query[0]; // Ambil detail kelas

// Ambil semua konten/materi untuk kelas ini, diurutkan berdasarkan kolom 'urutan'
$contents = query("SELECT * FROM content WHERE kelas_id = '$kelas_id' ORDER BY urutan ASC");

$nama_lengkap = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Mentor';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Materi - <?= htmlspecialchars($kelas['title_kelas']) ?></title>
    <!-- Gunakan CSS yang sama dengan dashboard -->
    <link rel="stylesheet" href="css/mentorDashboard.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar yang sama -->
        <?php include 'components/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <!-- Judul halaman dinamis sesuai nama kelas -->
                <h1>Detail Kelas: <?= htmlspecialchars($kelas['title_kelas']) ?></h1>
                
                <!-- Navigasi Tab -->
                <nav class="tabs">
                    <a href="#" class="active">Konten</a>
                    <a href="uploadKonten.php?kelas_id=<?= $kelas_id ?>">Upload Konten</a>
                </nav>
            </header>
            
            <section class="content-list">
                <?php if (empty($contents)): ?>
                    <div class="empty-state">
                        <p>Belum ada materi di kelas ini. Silakan tambahkan materi baru.</p>
                        <a href="uploadKonten.php?kelas_id=<?= $kelas_id ?>" class="btn">Upload Konten Pertama</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($contents as $content): ?>
                        <article class="content-item">
                            <div class="thumbnail">
                                <?php 
                                    // Menampilkan ikon berdasarkan tipe konten
                                    switch ($content['content_type']) {
                                        case 'video':
                                            echo '<i class="fa-solid fa-play"></i>';
                                            break;
                                        case 'pdf':
                                            echo '<i class="fa-solid fa-file-pdf"></i>';
                                            break;
                                        case 'text':
                                            echo '<i class="fa-solid fa-file-lines"></i>';
                                            break;
                                        default:
                                            echo '<i class="fa-solid fa-lock"></i>'; // Default atau jika ada status 'locked'
                                            break;
                                    }
                                ?>
                            </div>
                            <div class="details">
                                <h4><?= htmlspecialchars($content['content_title']) ?></h4>
                                <p><?= htmlspecialchars($content['content_deskripsi']) ?></p>
                            </div>
                            <div class="actions">
                                <a href="editKonten.php?content_id=<?= $content['content_id'] ?>&kelas_id=<?= $kelas_id ?>" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="hapusKonten.php?content_id=<?= $content['content_id'] ?>&kelas_id=<?= $kelas_id ?>" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus materi ini?');">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </main>
    </div>
    <script src="js/navbar.js"></script>
</body>
</html>
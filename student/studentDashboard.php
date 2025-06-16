<?php
// Selalu mulai session di baris paling atas
session_start();

// --- BAGIAN 1: KEAMANAN DAN INISIALISASI ---

// Langkah 1: Pastikan pengguna sudah login. Ini adalah solusi utama untuk bug Anda.
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada user_id di session, paksa pengguna kembali ke halaman login.
    header('Location: ../component/login.php'); // Sesuaikan path ke halaman login Anda
    exit(); // Hentikan eksekusi skrip
}

// Jika lolos, kita bisa melanjutkan dengan aman
include '../koneksi/koneksi.php';
$currentPage = $_GET['page'] ?? 'kelas';
$user_id = (int)$_SESSION['user_id'];
$sweetAlertScript = ''; // Variabel untuk menampung script SweetAlert

// --- BAGIAN 2: LOGIKA PEMROSESAN FORM ENROLLMENT ---

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_enroll'])) {
    
    if (isset($_POST['enrollment_key']) && !empty($_POST['enrollment_key'])) {
        $enrollKey = $_POST['enrollment_key'];

        // Ambil student_id dari user_id dengan aman
        $stmt_student = $conn->prepare("SELECT student_id FROM students WHERE user_id = ?");
        $stmt_student->bind_param("i", $user_id);
        $stmt_student->execute();
        $studentResult = $stmt_student->get_result();
        
        if ($studentResult->num_rows > 0) {
            $student_id = $studentResult->fetch_assoc()['student_id'];
            
            // Cek apakah key valid dan dapatkan kelas_id
            $stmt_key = $conn->prepare("SELECT kelas_id FROM enrollment_key WHERE enrollment_key = ?");
            $stmt_key->bind_param("s", $enrollKey);
            $stmt_key->execute();
            $keyResult = $stmt_key->get_result();
            
            if ($keyResult->num_rows > 0) {
                $kelas_id = $keyResult->fetch_assoc()['kelas_id'];

                // Cek apakah sudah pernah enroll sebelumnya
                $stmt_check = $conn->prepare("SELECT kelas_student_id FROM kelas_student WHERE student_id = ? AND course_id = ?");
                $stmt_check->bind_param("ii", $student_id, $kelas_id);
                $stmt_check->execute();
                
                if ($stmt_check->get_result()->num_rows == 0) {
                    // Jika belum, insert ke tabel kelas_student
                    $stmt_insert = $conn->prepare("INSERT INTO kelas_student (student_id, course_id) VALUES (?, ?)");
                    $stmt_insert->bind_param("ii", $student_id, $kelas_id);
                    if ($stmt_insert->execute()) {
                        $sweetAlertScript = "<script>
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Anda telah berhasil terdaftar di kelas baru.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => { window.location.href = 'studentDashboard.php?page=kelas'; });
                        </script>";
                    }
                    $stmt_insert->close();
                } else {
                    $sweetAlertScript = "<script>Swal.fire('Info', 'Anda sudah terdaftar di kelas ini.', 'info');</script>";
                }
                $stmt_check->close();
            } else {
                $sweetAlertScript = "<script>Swal.fire('Gagal!', 'Enrollment key yang Anda masukkan tidak valid.', 'error');</script>";
            }
            $stmt_key->close();
        }
        $stmt_student->close();
    } else {
         $sweetAlertScript = "<script>Swal.fire('Perhatian!', 'Harap masukkan enrollment key.', 'warning');</script>";
    }
}

// --- BAGIAN 3: LOGIKA PENGAMBILAN DATA UNTUK TAMPILAN ---

// Dapatkan student_id yang akan digunakan untuk semua query tampilan
$stmt_get_student_id = $conn->prepare("SELECT student_id FROM students WHERE user_id = ?");
$stmt_get_student_id->bind_param("i", $user_id);
$stmt_get_student_id->execute();
$student_id_result = $stmt_get_student_id->get_result();
$student_id = ($student_id_result->num_rows > 0) ? $student_id_result->fetch_assoc()['student_id'] : 0;
$stmt_get_student_id->close();

// Pagination Settings
$limit = 4;
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data kelas yang diambil siswa ini (untuk pagination yang akurat)
$stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM kelas_student WHERE student_id = ?");
$stmt_total->bind_param("i", $student_id);
$stmt_total->execute();
$totalData = $stmt_total->get_result()->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);
$stmt_total->close();

// Ambil data kelas sesuai halaman dengan aman
$query = "
    SELECT 
        k.kelas_id, k.title_kelas, k.foto_kelas, kk.jenis AS kategori
    FROM kelas_student ks
    JOIN kelas k ON ks.course_id = k.kelas_id
    JOIN kategori_kelas kk ON k.kategori_id = kk.kategori_kelas_id
    WHERE ks.student_id = ? ORDER BY k.title_kelas ASC LIMIT ? OFFSET ?";
$stmt_data = $conn->prepare($query);
$stmt_data->bind_param("iii", $student_id, $limit, $offset);
$stmt_data->execute();
$result = $stmt_data->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav>
        <div class="navbar">
            <img class="logo" src="../picture/logo1.png" alt="Dad project">
            <div class="links-container">
                <ul class="nav-links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="studentDashboard.php?page=notifikasi" class="<?= ($currentPage == 'notifikasi') ? 'active' : '' ?>">Notifikasi</a></li>
                    <li><a href="studentDashboard.php?page=kelas" class="<?= ($currentPage == 'kelas') ? 'active' : '' ?>">Kelas Saya</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="sidebar-section">
            <?php include 'components/sidebarStudent.php'; ?>
        </div>
        <main>
            <div class="main-content">
                <?php if ($currentPage == 'notifikasi'): ?>
                    <h1>Notifikasi</h1>
                    <p>Fitur notifikasi akan segera hadir.</p>
                <?php elseif ($currentPage == 'kelas'): ?>
                    <div class="head">
                        <h1>Kelas yang Anda Ambil</h1>
                        <form action="studentDashboard.php?page=kelas" method="POST" class="enroll-form">
                            <input class="search" type="text" name="enrollment_key" placeholder="Masukkan Enrollment Key..." required>
                            <button class="btnEnroll" type="submit" name="submit_enroll">Daftar Kelas</button>
                        </form>
                    </div>
                    <div class="kelas-container">
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <div class="kelas-card">
                                    <div class="kelas-head">
                                        <div class="imgbox">
                                            <img src="../picture/<?= htmlspecialchars($row['foto_kelas']) ?>" alt="Gambar kelas <?= htmlspecialchars($row['title_kelas']) ?>">
                                        </div>
                                        <div class="side">
                                            <h3><?= htmlspecialchars($row['title_kelas']) ?></h3>
                                        </div>
                                    </div>
                                    <div class="kelas-foot">
                                        <a href="../component/detailMateri.php?id=<?= $row['kelas_id'] ?>" class="kelas-link">
                                            <p>Lihat Materi</p>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                        <?php endif; ?>
                    </div>
                    <div class="pagination">
                        <?php if ($totalPages > 1): ?>
                            <?php if ($page > 1): ?><a href="studentDashboard.php?page=kelas&p=<?= $page - 1 ?>">« Prev</a><?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?><a href="studentDashboard.php?page=kelas&p=<?= $i ?>" class="<?= ($i == $page) ? 'active-page' : '' ?>"><?= $i ?></a><?php endfor; ?>
                            <?php if ($page < $totalPages): ?><a href="studentDashboard.php?page=kelas&p=<?= $page + 1 ?>">Next »</a><?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <h1>Halaman tidak ditemukan</h1>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Script SweetAlert akan dicetak di sini jika ada -->
    <?php echo $sweetAlertScript; ?>
</body>
</html>
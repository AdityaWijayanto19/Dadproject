<?php
session_start();
require '../koneksi/koneksi.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

$profile_link = '#';
if ($user_role === 'admin') {
    $profile_link = 'admin/adminDashboard.php';
} elseif ($user_role === 'mentor') {
    $profile_link = 'mentor/mentorDashboard.php';
} elseif ($user_role === 'student') {
    $profile_link = 'student/dashboardStudent.php';
}


// GET DATA KELAS
$data_kelas = query("SELECT kelas.kelas_id, kelas.title_kelas, kelas.foto, kelas.desk_kelas, mentors.nama_depan, mentors.nama_belakang, 
                    kategori_kelas.jenis FROM kelas JOIN mentors ON kelas.mentor_id = mentors.mentor_id
                    JOIN kategori_kelas ON kelas.kategori_id = kategori_kelas.kategori_kelas_id");

// GET DATA KATEGORI
$data_kategori = query("SELECT * FROM kategori_kelas");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#0F172A]">
    <nav class="fixed top-0 right-0 left-0">
        <div class="flex h-20 p-10 bg-[#0F172A] items-center justify-between shadow-xl/30">
            <div class="flex justify-center items-center gap-5">
                <img class="h-10 hover:scale-105 duration-300" src="../picture/logo1.png" alt="Dad project">
            </div>
            <div class="flex justify-center items-center">
                <ul class="flex items-center text-white gap-10">
                    <li class="text-xl hover:text-[#BE185D] hover:scale-105 duration-300"><a
                            href="../index.php">Home</a></li>
                    <li class="text-xl hover:text-[#BE185D] hover:scale-105 duration-300"><a href="#">Kelas</a></li>
                    <li class="text-xl hover:text-[#BE185D] hover:scale-105 duration-300"><a
                            href="kontak.php">Kontak</a></li>
                    <?php if ($user_role === 'admin'): ?>
                        <li class="text-xl hover:text-[#BE185D] hover:scale-105 duration-300"><a
                                href="../admin/adminDashboard.php">Dashboard Admin</a></li>
                    <?php elseif ($user_role === 'mentor'): ?>
                        <li class="text-xl hover:text-[#BE185D] hover:scale-105 duration-300"><a
                                href="../mentor/mentorDashboard.php">Dashboard Mentor</a></li>
                    <?php elseif ($user_role === 'student'): ?>
                        <li class="text-xl hover:text-[#BE185D] hover:scale-105 duration-300"><a
                                href="../student/dashboardStudent.php">Dashboard Siswa</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="flex justify-center items-center text-white gap-10">
                <?php if ($user_id): ?>
                    <a class="text-xl hover:text-[#BE185D] hover:scale-105 duration-300"
                        href="<?= htmlspecialchars($profile_link) ?>">Profile</a>
                    <a class="text-xl hover:text-[#BE185D] hover:scale-105 duration-300" href="../logout.php">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- main content -->
    <div class="flex justify-center items-center mt-30">
        <form class="flex gap-2" action="" method="post">
            <input
                class="h-5 w-60 p-5 bg-[#1C2435] border border-[#1C2435] focus:border-[#BE185D] focus:outline-none text-base text-white rounded-[20px] shadow-xl/30 hover:shadow-lg hover:shadow-[#BE185D] hover:scale-102 duration-300 "
                type="text" name="search" placeholder="cari kelas...">
            <select
                class="p-2 text-white text-base bg-[#1C2435] rounded-[10px] focus:border-[#BE185D] focus:outline-none shadow-xl/30 hover:shadow-lg hover:shadow-[#BE185D] hover:scale-102 duration-300"
                name="kategori" id="kategori" value="kategori">
                <?php foreach ($data_kategori as $kategori): ?>
                    <option value="<?= $kategori['kategori_kelas_id'] ?>"><?= $kategori['jenis'] ?></option>
                <?php endforeach; ?>
            </select>

        </form>
    </div>
    <section class="p-15">
        <div class="grid grid-cols-4 gap-6 place-items-center p-10 w-full h-fit bg-[#1C2435] rounded-[15px]">
        <?php foreach ($data_kelas as $kelas): ?>
            <a href="../component/kelasDetail.php?kelas_id=<?= $kelas['kelas_id'] ?>"
                class="block w-70 h-90 rounded-xl overflow-hidden shadow-md hover:shadow-lg hover:scale-102 transition duration-300 bg-white">
                <img class="h-40 w-full object-cover" src="../picture/<?= $kelas['foto'] ?>" alt="<?= $kelas['title_kelas'] ?>">
                <p class="m-1 bg-[#C084FC] w-fit px-2 py-1 text-[#581C87] text-sm rounded-lg"><?= $kelas['jenis'] ?></p>
                <div class="flex flex-col p-4 justify-center items-center">
                    <h3 class="text-lg font-semibold text-gray-800"><?= $kelas['title_kelas'] ?></h3>
                    <p class="mt-5 text-sm text-gray-500"><?= substr($kelas['desk_kelas'], 0, 100) . '...' ?></p>
                    <p class="mt-2 text-sm text-gray-500">Mentor: <?= $kelas['nama_depan'] . ' ' . $kelas['nama_belakang'] ?></p>
                </div>
            </a>
        <?php endforeach; ?>                
        </div>
    </section>
</body>

</html>
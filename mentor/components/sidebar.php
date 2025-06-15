<?php
    $mentor_id = $_SESSION['mentor_id'];
?>

<aside class="sidebar">
    <div class="user-profile">
        <div class="avatar">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            </svg>
        </div>
        <h2>Mentor</h2>
        <p><?= $nama_mentor ?></p>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="mentorDashboard.php">Dashboard</a></li>
            <li><a href="../component/comingSoon.php">Tugas & Kuis</a></li>
            <li><a href="../component/comingSoon.php">Penilaian</a></li>
            <li><a href="../component/comingSoon.php">Sertifikat Kelulusan</a></li>
            <li><a href="pengaturanMentor.php">Pengaturan</a></li>
        </ul>
    </nav>
</aside>
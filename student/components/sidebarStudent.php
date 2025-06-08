<?php
// Variabel $currentPage akan didefinisikan di setiap halaman utama
// untuk menandai halaman mana yang sedang aktif.
if (!isset($currentPage)) {
    $currentPage = ''; // Default value
}
?>

<div class="sidebar">
    <div class="profile-section">
        <?php if (isset($_SESSION['info']['picture'])): ?>
            <img src="<?= htmlspecialchars($_SESSION['info']['picture']) ?>" class="profile-img" referrerpolicy="no-referrer">
        <?php else: ?>
            <img src="https://i.pravatar.cc/100" class="profile-img" alt="Profile Picture">
        <?php endif; ?>
        
        <h2 class="username">
            <?php echo isset($_SESSION['info']['name']) ? htmlspecialchars($_SESSION['info']['name']) : 'Nama Student'; ?>
        </h2>
    </div>
    <nav class="navigation">
        <a href="dashboardStudent.php" class="<?= ($currentPage == 'dashboard') ? 'active' : '' ?>">Dashboard</a>
        <a href="daftarKelasStudent.php" class="<?= ($currentPage == 'kelas') ? 'active' : '' ?>">Kelas Saya</a>
        <a href="notifikasiStudent.php" class="<?= ($currentPage == 'notifikasi') ? 'active' : '' ?>">Notifikasi</a>
        <a href="profilStudent.php" class="<?= ($currentPage == 'profil') ? 'active' : '' ?>">Profil & Pengaturan</a>
        <a href="logout.php">Logout</a>
    </nav>
</div>
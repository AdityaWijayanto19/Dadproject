<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Dashboard Mentor</title>
    <link rel="stylesheet" href="css/mentorDashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <?php include 'components/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1>Pengaturan Akun</h1>
            </div>

            <!-- Kartu Pengaturan Profil -->
            <div class="settings-card">
                <h2>Informasi Profil</h2>
                <form>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="John Doe">
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" value="john.doe@example.com" disabled>
                        <small>Email tidak dapat diubah.</small>
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru"
                            placeholder="Masukkan password baru">
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                        <input type="password" id="konfirmasi_password" name="konfirmasi_password"
                            placeholder="Ketik ulang password baru">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>

            <!-- Kartu Pengaturan Notifikasi -->
            <div class="settings-card">
                <h2>Preferensi Notifikasi</h2>
                <form>
                    <div class="form-check">
                        <input type="checkbox" id="notif-tugas" name="notif-tugas" checked>
                        <label for="notif-tugas">Kirim notifikasi email saat ada tugas baru yang perlu dinilai.</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="notif-update" name="notif-update">
                        <label for="notif-update">Kirim notifikasi email tentang pembaruan platform.</label>
                    </div>
                </form>
            </div>

            <!-- Kartu Zona Berbahaya -->
            <div class="settings-card danger-zone">
                <h2>Zona Berbahaya</h2>
                <p>Tindakan ini akan menonaktifkan akun Anda secara permanen dan tidak dapat diurungkan.</p>
                <button type="button" class="btn btn-danger">Nonaktifkan Akun Saya</button>
            </div>

        </main>
    </div>

    <script src="js/navbar.js"></script>
</body>

</html>
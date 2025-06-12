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
        <?php include 'components/sidebar.php'; ?>

        <main class="main-content">
            <header>
                <h1>Pengaturan</h1>
                <hr>
            </header>

            <div class="settings-card">
                <h2>Informasi Profil</h2>
                <form>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="Nama User">
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" value="user@example.com" disabled>
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

            <div class="settings-card">
                <h2>Preferensi Notifikasi</h2>
                <form>
                    <div class="form-check">
                        <input type="checkbox" id="notif-tugas" name="notif-tugas" checked>
                        <label for="notif-tugas">Kirim notifikasi saat ada kelas yang sudah di upload oleh admin.</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="notif-update" name="notif-update">
                        <label for="notif-update">Kirim notifikasi jika upload konten sudah di setujui admin.</label>
                    </div>
                </form>
            </div>

            <div class="settings-card danger-zone">
                <h2>Zona Berbahaya</h2>
                <p>Tindakan ini akan Menghapus akun Anda secara permanen dan tidak dapat dikembalikan.</p>
                <br/>
                <button type="button" class="btn btn-danger">Hapus Akun Saya</button>
            </div>

        </main>
    </div>

    <script src="js/navbar.js"></script>
</body>

</html>
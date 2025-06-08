<?php
    session_start();
    $currentPage = 'profil'; // Menandai halaman ini sebagai 'profil'
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Student - Student</title>
    <link rel="stylesheet" href="css/student.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'components/sidebarStudent.php'; ?>
        <div class="content-area">
            <?php include 'components/navbarStudent.php'; ?>
            <main>
                <h1 class="page-title">Profil & Pengaturan</h1>
                <div class="main-content">
                    <h2>Informasi Akun</h2>
                    <p><strong>Nama:</strong> <?php echo isset($_SESSION['info']['name']) ? htmlspecialchars($_SESSION['info']['name']) : 'Nama Student'; ?></p>
                    <p><strong>Email:</strong> <?php echo isset($_SESSION['info']['email']) ? htmlspecialchars($_SESSION['info']['email']) : 'email@student.com'; ?></p>
                    <br>
                    <button class="btn btn-primary">Ubah Profil</button>
                    <button class="btn btn-light">Ubah Password</button>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
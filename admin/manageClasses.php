<?php 
require '../koneksi/koneksi.php';

$data = query("SELECT * FROM `kelas`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="picture/logo (1).png" type="image/x-icon">
    <title>Kelola Kelas-DadProject</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="../css/kelas.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>DadProject</h2>
            </div>
            <ul>
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="manageUser.php">Pengguna</a></li>
                <li><a href="manageClasses.php">Kelas</a></li>
                <li><a href="manageCategoryClass.php">Kategori Kelas</a></li>
                <li><a href="#">Notifikasi</a></li>
                <li><a href="#">Statistik dan Data Pengguna</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Manajemen Kelas</h1>
                <hr>
                <br>
                <p>Selamat Datang, Admin</p>
            </header>

            <div class="boxbtn">
                <button><a href="#">Tambah kelas</a></button>
            </div>
            
            <div>
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>NO.</th>
                        <th>Aksi</th>
                        <th>Title kelas</th>
                        <th>foto</th>
                        <th>deskripsi kelas</th>
                        <th>ID mentor</th>
                        <th>Kategori</th>
                    </tr>
                    <?php $i=1; ?>
                    <?php foreach($data as $dt) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <button class="hapus"><a href="#">Hapus</a></button>
                            <button class="edit"><a href="#">Edit</a></button>
                        </td>
                        <td><?= $dt["title_kelas"] ?></td>
                        <td><?= $dt["foto"] ?></td>
                        <td><?= $dt["desk_kelas"] ?></td>
                        <td><?= $dt["mentor_id"] ?></td>
                        <td><?= $dt["kategori"] ?></td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
</body>
</html>

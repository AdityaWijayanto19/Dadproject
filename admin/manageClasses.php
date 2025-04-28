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
<<<<<<< HEAD
    <link rel="stylesheet" href="../css/adminDashboard.css">
=======
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="../css/kelas.css">
>>>>>>> b8c58dcd828c1209efb7c9cb459866617d0f6629
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
                <button><a href="addClasses.php">Tambah kelas</a></button>
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
                    <?php $i = 1; ?>
                    <?php foreach ($data as $dt): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td>
                                <button class="hapus"><a href="#" onclick="confirm(<?= $dt['kelas_id'] ?>)">Hapus</a></button>
                                <button class="edit"><a href="editKelas.php?id=<?= $dt['kelas_id']; ?>">Edit</a></button>
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

        <script>
            function confirm(id) {
                Swal.fire({
                    title: "yakin ?",
                    text: "data akan dihapus permanent!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'hapusKelas.php?id=' + id;
                    }
                });
            }
        </script>
</body>

</html>
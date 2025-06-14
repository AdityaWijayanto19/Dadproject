<?php
require '../koneksi/koneksi.php';

$data = query('SELECT * FROM `kategori_kelas`');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="picture/logo (1).png" type="image/x-icon">
    <title>Kelola Kategori Kelas-DadProject</title>
    <link rel="stylesheet" href="../css/admin/adminDashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
  table{
    width: 100%;
    margin-top: 10px;
    border-collapse: collapse;
    border-color: #0F172A;
    font-size: 14px;
}

th{
    padding: 10px 20px;
    text-align: center;
    background-color: #0F172A;
    color: white;
}

td{
    padding: 10px 20px;
    text-align: justify; 
}

tbody tr:nth-child(even):hover{
    background-color: rgb(225, 224, 224);
}

tbody tr:nth-child(odd):hover{
    background-color: rgb(225, 224, 224);
}

tbody tr:nth-child(odd){
    background-color: white;
}

tbody tr:nth-child(even){
    background-color: white;
}

.boxbtn{
    display: flex;
    justify-content: right;
    align-items: center;
}

.boxbtn button{
    display: inline-block;
    vertical-align: middle;
    user-select: none;
    background-color: #C084FC; 
    border: 1px solid #C084FC;
    padding: 0.375rem 0.75rem; 
    line-height: 1.5;
    border-radius: 0.375rem; 
    transition: all 0.15s ease-in-out;
    cursor: pointer;
}

.boxbtn button:hover {
    background-color: #9333EA;
    border-color: #9333EA;
    transform: scale(1.05);
  }
  

.boxbtn button a{
    font-family: 'Poppins', sans-serif;
    color: white;
    font-weight: 400;
    font-size: 1rem; 
    text-decoration: none;
    text-align: center;
}

td button{
    margin-top: 10px;
    display: inline-block;
    vertical-align: middle;
    user-select: none;
    padding: 0.375rem 0.75rem; 
    line-height: 1.5;
    border-radius: 0.375rem; 
    transition: all 0.15s ease-in-out;
    cursor: pointer;
}

td button a{
    font-family: 'Poppins', sans-serif;
    color: white;
    font-weight: 400;
    font-size: 1rem; 
    text-decoration: none;
    text-align: center;
}

td .hapus{
    border: 1px solid  #dc3545;
    background-color: #dc3545;
}

td .hapus:hover {
    background-color:  #bb2d3b;
    border-color:  #b02a37;
    transform: scale(1.05);
  }

td .edit{
    border: 1px solid #0d6efd;
    background-color: #0d6efd; 
}

td .edit:hover {
    background-color:  #0b5ed7;
    border-color:  #0a58ca;
    transform: scale(1.05);
  }
</style>

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
                <li><a href="manageContact.php">Kontak</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Manajemen Kategori Kelas</h1>
                <hr>
                <br>
                <p>Selamat Datang, Admin</p>
            </header>

            <div class="boxbtn">
                <button><a href="addKategoriKelas.php">Tambah kategori kelas</a></button>
            </div>

            <div>
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>NO.</th>
                        <th>Aksi</th>
                        <th>Jenis</th>
                        <th>deskripsi </th>
                        <th>foto</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($data as $dt): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td>
                                <button class="hapus"><a href="#" onclick="confirm(<?= $dt['kategori_kelas_id'] ?>)">Hapus</a></button>
                                <button class="edit"><a href="editkategoriKelas.php?id=<?= $dt['kategori_kelas_id']; ?>">Edit</a></button>
                            </td>
                            <td><?= $dt["jenis"] ?></td>
                            <td><?= $dt["deskripsi"] ?></td>
                            <td><?= $dt["foto"] ?></td>
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
                        window.location.href = 'hapusCategoryClass.php?id=' + id;
                    }
                });
            }
        </script>
</body>

</html>
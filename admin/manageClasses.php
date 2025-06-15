<?php
require '../koneksi/koneksi.php';

$data = query("SELECT kelas.kelas_id, kelas.title_kelas, kelas.foto, kelas.desk_kelas, mentors.nama_depan, mentors.nama_belakang, 
                kategori_kelas.jenis, enrollment_key.enrollment_key FROM kelas JOIN mentors ON kelas.mentor_id = mentors.mentor_id
                JOIN kategori_kelas ON kelas.kategori_id = kategori_kelas.kategori_kelas_id LEFT JOIN enrollment_key ON kelas.kelas_id = enrollment_key.kelas_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="picture/logo (1).png" type="image/x-icon">
    <title>Kelola Kelas-DadProject</title>
    <link rel="stylesheet" href="../css/admin/adminDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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
                <li><a href="../logout.php">Logout</a></li>
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
                        <th>Enrollment</th>
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
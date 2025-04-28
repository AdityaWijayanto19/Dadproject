<?php
require "../koneksi/koneksi.php";
$alert = "";

$id = $_GET['id'];
$data = query("SELECT * FROM kelas WHERE `kelas_id`= $id");

if (isset($_POST['submit'])) {
    if (edit($_POST, $id) > 0) {
        $alert = "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'data telah berhasil diubah.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                window.location.href = 'manageClasses.php'; //berpindah kehalaman lain
            });
            </script>";
    } else {
        $alert = "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'belum ada data yang diubah.',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi' 
                }).then(() => {
                window.location.href = 'manageClasses.php';
            });
            </script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<style>
    .form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 90px;
    }

    .bungkus {
        height: 580px;
        width: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.53);
    }

    ul {
        margin-left: 0;
        list-style-type: none;
    }

    li {
        margin: 10px;
        display: flex;
        flex-direction: column;
    }

    .label {
        width: 250px;
        height: 5px;
        padding: 15px;
        border: 1px solid black;
        border-radius: 10px;
    }

    .desc{
        height: 95px;
        padding: 5px;
        width: 350px;
        border-radius: 10px;
        border: 1px solid black;
        text-align: start;
    }

    button {
        height: 40px;
        width: 130px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
</style>

<body>
    <?= $alert ?>

    <form class="form" action="" method="POST" enctype="multipart/form-data">
        <div class="bungkus">
            <h1>EDIT KELAS</h1>

            <?php foreach ($data as $dt): ?>
                <ul>
                    <li>
                        <label for="title">Title kelas</label>
                        <input class="label" type="text" name="title" id="title" required value="<?= $dt['title_kelas'] ?>">
                    </li>

                    <li>
                        <label for="foto">foto</label>
                        <input class="foto" type="file" name="foto" id="foto" value="<?= $dt['foto'] ?>">
                    </li>

                    <li>
                        <label for="desc">Deskripsi kelas</label>
                        <textarea class="desc" type="text" name="desc" id="desc" required><?= $dt['desk_kelas'] ?></textarea>
                    </li>

                    <li>
                        <label for="mentor">ID mentor</label>
                        <input class="label" type="text" name="mentor" id="mentor" required value="<?= $dt['mentor_id'] ?>">
                    </li>

                    <li>
                        <label for="kategori">Kategori</label>
                        <input class="label" type="text" name="kategori" id="kategori" required value="<?= $dt['kategori'] ?>">
                    </li>
                </ul>
                <button type="submit" name="submit">Tambah Kelas</button>
                <a href="manageClasses.php">Kembali</a>
            <?php endforeach; ?>
        </div>
    </form>
</body>

</html>
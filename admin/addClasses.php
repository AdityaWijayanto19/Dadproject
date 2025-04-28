<?php
require '../koneksi/koneksi.php';

$alert = "";
if (isset($_POST['submit'])) {

    if (tambah($_POST) > 0) {
        $alert = "
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: 'data telah berhasi ditambahkan.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'manageClasses.php'; //berpindah kehalaman lain
    });
</script>";
    } else {
        $alert = "
<script>
    Swal.fire({
        title: 'Gagal!',
        text: 'gagal saat menambahkan data.',
        icon: 'error',
        confirmButtonText: 'Coba Lagi'
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
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1>Tambah kelas</h1>

            <ul>
                <li>
                    <label for="title">Title kelas</label>
                    <input class="label" type="text" name="title" id="title" required>
                </li>

                <li>
                    <label for="foto">foto</label>
                    <input class="foto" type="file" name="foto" id="foto" required>
                </li>

                <li>
                    <label for="desc">Deskripsi kelas</label>
                    <textarea class="desc" type="text" name="desc" id="desc" required></textarea>
                </li>

                <li>
                    <label for="mentor">ID mentor</label>
                    <input class="label" type="text" name="mentor" id="mentor" required>
                </li>

                <li>
                    <label for="kategori">Kategori</label>
                    <input class="label" type="text" name="kategori" id="kategori" required>
                </li>
            </ul>
            <button type="submit" name="submit">Tambah Kelas</button>
            <a href="manageClasses.php">Kembali</a>
        </div>
    </form>

</body>

</html>
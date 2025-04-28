<?php
require "../controller/controlKelas.php";
$id = $_GET['id'];
$alert = "";


if (isset($_GET['id'])) {
    if (hapus($id) > 0) {
        $alert = "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'data telah berhasi dihapus.',
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
            text: 'gagal menghapus data.',
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
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?= $alert ?>
</body>
</html>
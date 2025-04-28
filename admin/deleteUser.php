<?php
    include_once '../controller/controlUser.php';

    // Menerima id user yang dipilih pengguna
    $user_id = (int)$_GET['user_id'];

    if (delete_user($user_id) > 0) {
        $alert = '<script>
                Swal.fire({
                    title: "Sukses!",
                    text: "User Berhasil di Hapus",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(function() {
                    window.location.href = "manageUser.php";
                });
            </script>';
    } else {
        $alert =  '<script>
                Swal.fire({
                    title: "Gagal!",
                    text: "User gagal di Hapus",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(function() {
                    window.location.href = "manageUser.php";
                });
            </script>';
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
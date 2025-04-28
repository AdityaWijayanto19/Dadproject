<?php
    include_once '../controller/controlUser.php';

    // Menerima id user yang dipilih pengguna
    $user_id = (int)$_GET['user_id'];

    if (delete_user($user_id) > 0) {
        echo '<script>
                alert("User Berhasil di Hapus");
                document.location.href = "manageUser.php";
            </script>';
    } else {
        echo '<script>
                alert("User gagal di Hapus");
                document.location.href = "manageUser.php";
            </script>';
    }
?>

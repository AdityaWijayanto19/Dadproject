<?php
    session_start();
    include '../koneksi/koneksi.php';

    function create_user($post) {
        global $conn;
    
        $nama_depan     = $post['namaDepan'];
        $nama_belakang  = $post['namaBelakang'];
        $nama_lengkap   = $nama_depan . ' ' . $nama_belakang;
        $email          = $post['email'];
        $username       = $post['username'];
        $plainPassword  = $post['kataSandi'];
        $password       = password_hash($plainPassword, PASSWORD_BCRYPT); // PASSWORD ENKRIPSI
        $role           = $post['role'];
        $status         = $post['status'];
        $expertise      = $post['expertise'];
    
        // Cek apakah email dan username sudah terdaftar
        $checkEmail = $conn->query("SELECT email FROM user WHERE email = '$email'");
        $checkUsername = $conn->query("SELECT username FROM user WHERE username = '$username'");
    
        if ($checkEmail->num_rows > 0) {
            $_SESSION['createUser_error'] = 'Email sudah terdaftar!';
            return false;  // Mengembalikan false jika terjadi error
        }
    
        if ($checkUsername->num_rows > 0) {
            $_SESSION['createUser_error'] = 'Username sudah terdaftar!';
            return false;  // Mengembalikan false jika terjadi error
        }
    
        // Menambah user ke tabel user
        $keTabelUser = mysqli_query($conn, "INSERT INTO user (nama_depan, nama_belakang, nama_lengkap, username, email, password, role) 
                                           VALUES ('$nama_depan', '$nama_belakang', '$nama_lengkap', '$username', '$email', '$password', '$role')");
    
        $user_id = mysqli_insert_id($conn);
    
        if ($role == 'student') {
            // Menambah ke tabel students
            $keTabelStudent = mysqli_query($conn, "INSERT INTO students (user_id, nama_depan, nama_belakang, status) 
                                                 VALUES ('$user_id', '$nama_depan', '$nama_belakang', '$status')");
            if (!$keTabelStudent) {
                die("Error student: " . mysqli_error($conn));
            }
        } elseif ($role == 'mentor') {
            // Menambah ke tabel mentor
            $keTabelMentor = mysqli_query($conn, "INSERT INTO mentors (user_id, nama_depan, nama_belakang, expertise) 
                                                  VALUES ('$user_id', '$nama_depan', '$nama_belakang', '$expertise')");
            if (!$keTabelMentor) {
                die("Error mentor: " . mysqli_error($conn));
            }
        } else {
            // Menambah ke tabel admin
            $keTabelAdmin = mysqli_query($conn, "INSERT INTO admin (user_id, nama_depan, nama_belakang) 
                                                 VALUES ('$user_id', '$nama_depan', '$nama_belakang')");
            if (!$keTabelAdmin) {
                die("Error admin: " . mysqli_error($conn));
            }
        }
        
        return true;  // Mengembalikan true jika berhasil
    }


    if (isset($_POST['tambahUser'])) { 
        if (create_user($_POST) > 0) {
            $alert = "<script>
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data user berhasil ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../admin/manageUser.php';
                    });
                </script>";
        } else {
            $alert = "<script>
                    Swal.fire({
                        title: 'Gagal!',
                        text: '". $_SESSION['createUser_error'] ."',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../admin/manageUser.php';
                    });
                </script>";
        }
    }

    function update_user($post){
        global $conn;

         // Ambil data dari form untuk update
         $user_id        = $post['userId']; //Untuk kebutuhan Uupdate
         $nama_depan     = $post['namaDepan'];
         $nama_belakang  = $post['namaBelakang'];
         $nama_lengkap   = $nama_depan . ' ' . $nama_belakang;
         $email          = $post['email'];
         $username       = $post['username'];
         $role           = $post['role'];
         $status         = $post['status'];
         $expertise      = $post['expertise'];
 
         // MENCARI TAU APAKAH EMAIL/PASSWORD/USERNAME SUDAH TERDAFTAR?
         $checkEmail = $conn->query("SELECT email FROM user WHERE email = '$email' AND user_id != '$user_id'"); // MENGEMBALIKAN OBJECT BERUPA mysqli_result;
         $checkUsername = $conn->query("SELECT username FROM user WHERE username = '$username' AND user_id != '$user_id'"); // MENGEMBALIKAN OBJECT BERUPA mysqli_result;
         
         if ($checkEmail->num_rows > 0) {
            $_SESSION['updateUser_error'] = 'Email sudah terdaftar!';
            return false;  // Mengembalikan false jika terjadi error
        }
    
        if ($checkUsername->num_rows > 0) {
            $_SESSION['updateUser_error'] = 'Username sudah terdaftar!';
            return false;  // Mengembalikan false jika terjadi error
        }
 
         // UPDATE data pengguna ke tabel user
         $keTabelUser = mysqli_query(
             $conn,
             "UPDATE user SET nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', nama_lengkap = '$nama_lengkap',
             email = '$email', username = '$username', role = '$role' WHERE user_id = '$user_id'"
         );
 
         // Update data di tabel students atau mentors jika perlu
         if ($role == 'student') {
             $keTabelStudent = mysqli_query(
                 $conn,
                 "UPDATE students SET nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', status = '$status' WHERE user_id = '$user_id'"
             );
         } elseif ($role == 'mentor') {
             $keTabelMentor = mysqli_query(
                 $conn,
                 "UPDATE mentors SET nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', expertise = '$expertise' WHERE user_id = '$user_id'"
             );
         } else {
             $keTabelAdmin = mysqli_query(
                 $conn,
                 "UPDATE admin SET nama_depan = '$nama_depan', nama_belakang = '$nama_belakang' WHERE user_id = '$user_id'"
             );
         }
         return true;
    }

    if (isset($_POST['editUser'])) {
        if (update_user($_POST) > 0) {
            $alert = "<script>
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data user berhasil diupdate',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../admin/manageUser.php';
                    });
                </script>";
        } else {
            $alert = "<script>
                    Swal.fire({
                        title: 'Gagal!',
                        text: '".$_SESSION['updateUser_error']."',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../admin/manageUser.php';
                    });
                </script>";
        }
    }

    function delete_user($user_id) {
        global $conn; // Pastikan menggunakan koneksi global
        
        // Query untuk menghapus data user
        $queryDelete = "DELETE FROM user WHERE user_id = '$user_id'";
    
        // Eksekusi query
        if (mysqli_query($conn, $queryDelete)) {
            return 1; // Mengembalikan 1 jika penghapusan berhasil
        } else {
            return 0; // Mengembalikan 0 jika penghapusan gagal
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
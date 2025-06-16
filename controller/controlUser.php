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
        $password       = password_hash($plainPassword, PASSWORD_BCRYPT); 
        $role           = $post['role'];
        $status         = $post['status'];
        $expertise      = $post['expertise'];
    
        // Cek apakah email dan username sudah terdaftar
        $checkEmail = $conn->query("SELECT email FROM user WHERE email = '$email'");
        $checkUsername = $conn->query("SELECT username FROM user WHERE username = '$username'");
    
        if ($checkEmail->num_rows > 0) {
            $_SESSION['createUser_error'] = 'Email sudah terdaftar!';
            return false;  
        }
    
        if ($checkUsername->num_rows > 0) {
            $_SESSION['createUser_error'] = 'Username sudah terdaftar!';
            return false;  
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
        
        return true;  
    }

    function update_user($post){
        global $conn;

         $user_id        = $post['userId']; 
         $nama_depan     = $post['namaDepan'];
         $nama_belakang  = $post['namaBelakang'];
         $nama_lengkap   = $nama_depan . ' ' . $nama_belakang;
         $email          = $post['email'];
         $username       = $post['username'];
         $role           = $post['role'];
         $status         = $post['status'];
         $expertise      = $post['expertise'];
 
         $checkEmail = $conn->query("SELECT email FROM user WHERE email = '$email' AND user_id != '$user_id'"); // MENGEMBALIKAN OBJECT BERUPA mysqli_result;
         $checkUsername = $conn->query("SELECT username FROM user WHERE username = '$username' AND user_id != '$user_id'"); // MENGEMBALIKAN OBJECT BERUPA mysqli_result;
         
         if ($checkEmail->num_rows > 0) {
            $_SESSION['updateUser_error'] = 'Email sudah terdaftar!';
            return false; 
        }
    
        if ($checkUsername->num_rows > 0) {
            $_SESSION['updateUser_error'] = 'Username sudah terdaftar!';
            return false; 
        }
 
         $keTabelUser = mysqli_query(
             $conn,
             "UPDATE user SET nama_depan = '$nama_depan', nama_belakang = '$nama_belakang', nama_lengkap = '$nama_lengkap',
             email = '$email', username = '$username', role = '$role' WHERE user_id = '$user_id'"
         );
 
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

    function delete_user($user_id) {
        global $conn; 
        
        $queryDelete = "DELETE FROM user WHERE user_id = '$user_id'";
    
        if (mysqli_query($conn, $queryDelete)) {
            return 1; 
        } else {
            return 0; 
        }
    }  
    
?>
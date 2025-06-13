<?php
session_start();
require '../koneksi/koneksi.php';

function redirectUser($role)
{
    switch ($role) {
        case 'admin':
            header('Location: ../admin/adminDashboard.php');
            break;
        case 'mentor':
            header('Location: ../mentor/mentorDashboard.php');
            break;
        case 'student':
            header('Location: ../student/dashboardStudent.php');
            break;
        default:
            $_SESSION['login_error'] = "Peran pengguna tidak dikenali.";
            header('Location: login.php');
            break;
    }
    exit();
}

if (isset($_POST['masuk'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['kataSandi'];

    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];
            if ($user['role'] === 'mentor') {
                // MENGAMBIL MENTOR_ID DI TABEL MENTORS
                $user_id = $user['user_id'];
                $queryMentor = "SELECT mentor_id FROM mentors WHERE user_id = '$user_id'";
                $resultMentor = mysqli_query($conn, $queryMentor);

                if ($resultMentor && mysqli_num_rows($resultMentor) === 1) {
                    $mentor = mysqli_fetch_assoc($resultMentor);
                    $_SESSION['mentor_id'] = $mentor['mentor_id'];
                } else {
                    $_SESSION['login_error'] = "Akun mentor belum terdaftar di tabel mentors.";
                    header("Location: login.php");
                    exit();
                }
            }


            header("Location: ../index.php");
            exit();

            // $_SESSION['info'] = [
            //     'name' => $user['nama_lengkap'],
            //     'email' => $user['email'],
            //     'picture' => $user['gambar'] ?? 'path/to/default.png'
            // ];
            // redirectUser($user['role']);
        }
    }

    $_SESSION['login_error'] = "Email atau kata sandi salah!";
    header("Location: login.php");
    exit();
} else if (isset($_POST['daftar'])) {
    $nama_depan = mysqli_real_escape_string($conn, $_POST['namaDepan']);
    $nama_belakang = mysqli_real_escape_string($conn, $_POST['namaBelakang']);
    $nama_lengkap = $nama_depan . ' ' . $nama_belakang;
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $plainPassword = $_POST['kataSandi'];
    $password = password_hash($plainPassword, PASSWORD_BCRYPT);
    $role = "student";

    $checkEmailQuery = "SELECT email FROM user WHERE email = '$email'";
    $checkUsernameQuery = "SELECT username FROM user WHERE username = '$username'";

    $resultEmail = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($resultEmail) > 0) {
        $_SESSION['register_error'] = 'Email sudah terdaftar!';
        header("Location: register.php");
        exit;
    }

    $resultUsername = mysqli_query($conn, $checkUsernameQuery);
    if (mysqli_num_rows($resultUsername) > 0) {
        $_SESSION['register_error'] = 'Username sudah terdaftar!';
        header("Location: register.php");
        exit;
    }

    $insertUserQuery = "INSERT INTO user (nama_depan, nama_belakang, nama_lengkap, username, email, password, role) VALUES
        ('$nama_depan', '$nama_belakang', '$nama_lengkap', '$username', '$email', '$password', '$role')";
    mysqli_query($conn, $insertUserQuery);

    $user_id = mysqli_insert_id($conn);

    $insertStudentQuery = "INSERT INTO students (user_id, nama_depan, nama_belakang, status) VALUES
        ('$user_id', '$nama_depan', '$nama_belakang', '$status')";
    mysqli_query($conn, $insertStudentQuery);

    header("Location: login.php");
    exit;
}

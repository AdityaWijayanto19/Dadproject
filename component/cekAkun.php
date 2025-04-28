<?php
// 1. Mulai session dan koneksi database
session_start();
require '../koneksi/koneksi.php';

// CEK TOMBOL APAKAH YANG DIPENCET?
if (isset($_POST['masuk'])) { // JIKA USER MENEKAN TOMBOL MASUK
    // MENGAMBIL DATA DARI FORM
    $email      = $_POST['email'];
    $password   = $_POST['kataSandi'];

    // VALIDASI PASSWORD
    $query = "SELECT * FROM user WHERE email = '$email'"; // MENGAMBIL DATA AKUN BERDASARKAN EMAIL UNTUK DICEK PASSWORDNYA
    $akun = query($query); // MENDAPATKAN DATA AKUN DARI DATABASE USER
    foreach ($akun as $akn) {
        $user = mysqli_fetch_assoc(mysqli_query($conn, $query)); // MENJADIKAN DATA SEBAGAI VARIABEL $user
        // PENGECEKAN PASSWORD YANG SUDAH DI HASH/ENKRIPSI
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id']; // MENYIMPAN ID USER
            header("Location: homePage.php");   // MENGARAHKAN KE HALAMAN HOMEPAGE
            exit;
        }
    }

    // JIKA GAGAL SIMPAN EROR UNTUK DITAMPILKAN DAN DIARAHKAN KEMBALI KE HALAMAN LOGIN
    $_SESSION['login_error'] = "Email atau password salah!";
    header("Location: login.php");
    exit;
} else if (isset($_POST['daftar'])) { // JIKA USER MENEKAN TOMBOL DAFTAR
    // MENGAMBIL DATA DARI FORM
    $nama_depan = $_POST['namaDepan'];
    $nama_belakang = $_POST['namaBelakang'];
    $nama_lengkap = $nama_depan . ' ' . $nama_belakang;
    $email = $_POST['email'];
    $username = $_POST['username'];
    $plainPassword = $_POST['kataSandi'];
    $password = password_hash($plainPassword, PASSWORD_BCRYPT); // PASSWORD ENKRIPSI
    $role = "student";
    $status = $_POST['status'];

    // MENCARI TAU APAKAH EMAIL/PASSWORD/USERNAME SUDAH TERDAFTAR?
    $checkEmail = $conn->query("SELECT email FROM user WHERE email = '$email'"); // MENGEMBALIKAN OBJECT BERUPA mysqli_result;
    $checkUsername = $conn->query("SELECT username FROM user WHERE username = '$username'"); // MENGEMBALIKAN OBJECT BERUPA mysqli_result;

    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email sudah terdaftar!';
        header("Location: register.php");
        exit;
    }

    if ($checkUsername->num_rows > 0) {
        $_SESSION['register_error'] = 'Username sudah terdaftar!';
        header("Location: register.php");
        exit;
    }

    $keTabelUser = mysqli_query(
        $conn,
        "INSERT INTO user (nama_depan, nama_belakang, nama_lengkap, username, email, password, role) VALUES
        ('$nama_depan', '$nama_belakang', '$nama_lengkap', '$username', '$email', '$password', '$role')"
    );

    $user_id = mysqli_insert_id($conn);

    $keTabelStudent = mysqli_query(
        $conn,
        "INSERT INTO students (user_id, nama_depan, nama_belakang, status) VALUES
        ('$user_id', '$nama_depan', '$nama_belakang', '$status')"
    );

    if (!$keTabelStudent) {
        die("Error student: " . mysqli_error($conn));
    }

    // JIKA BERHASIL MAKA AKAN PERGI KE HALAMAN LOGIN
    header("Location: login.php");
    exit;
}

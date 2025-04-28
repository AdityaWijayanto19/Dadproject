<?php
session_start();

// ARRAY ASSOC PESAN ERROR
$errors = [
    'daftar' => $_SESSION['register_error'] ?? ''
];

session_unset();

// FUNCTION UNTUK MENAMPILKAN ERROR
function showError($error)
{
    return !empty($error) ? "<p class = 'error-massage'> $error </p>" : '';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" href="../picture/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>
    <!-- navbar -->
    <nav>
        <div class="header">
            <div class="boxsearch left">
                <a href="../index.php">
                    <img class="foto" src="../picture/logo.png" alt="Dad project">
                </a>
                <input class="search" type="text" name="search" placeholder="cari...">
            </div>

            <div class="hamburger" onclick="toggleMenu()">&#9776;</div>

            <div class="boxsearch right nav-links" id="navLinks">
                <div class="boxbtn">
                    <a class="regbtn" href="login.php">Masuk</a>
                </div>
                <div class="boxbtn">
                    <a class="regbtn" href="register.php">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="containerForm">
            <!-- DIRECTION KE CEK AKUN UNTUK VALIDASI -->
            <form action="cekAkun.php" method="post">
                <!-- Logo DadProject -->
                <div class="formContainer">
                    <img src="../picture/logo.png" alt="Logo" class="imgLogo">
                </div>

                <!-- MENAMPILKAN ERROR -->
                <?= showError($errors['daftar']) ?>

                <!-- Input nama depan -->
                <div class="formContainer">
                    <input type="text" name="namaDepan" id="inputField" class="input" placeholder=" " required>
                    <label for="inputField" class="label">Nama Depan</label>
                </div>

                <!-- Input nama belakang -->
                <div class="formContainer">
                    <input type="text" name="namaBelakang" id="inputField" class="input" placeholder=" " required>
                    <label for="inputField" class="label">Nama Belakang</label>
                </div>

                <!-- Input email -->
                <div class="formContainer">
                    <input type="email" name="email" id="inputField" class="input" placeholder=" " required>
                    <label for="inputField" class="label">Email</label>
                </div>

                <!-- Input username -->
                <div class="formContainer">
                    <input type="username" name="username" id="inputField" class="input" placeholder=" " required>
                    <label for="inputField" class="label">Username</label>
                </div>

                <!-- Input kata sandi -->
                <div class="formContainer">
                    <input type="password" name="kataSandi" id="inputField" class="input" placeholder=" " required>
                    <label for="inputField" class="label">Kata Sandi</label>
                </div>

                <!-- Combo box -->
                <div class="formContainerSelect">
                    <label for="status" class="labelSelect">Status pengguna</label>
                    <select name="status" id="status">
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Siswa">Siswa</option>
                    </select>
                </div>

                <div class="formContainer">
                    <button type="submit" name="daftar" class="btnDaftar">Daftar</button>
                </div>
            </form>
        </div>

        <div class="containerDaftar">
            <p>Sudah punya akun? <a href="login.php">Masuk Akun</a></p>
        </div>
    </div>
</body>

</html>
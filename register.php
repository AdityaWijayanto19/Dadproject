<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" href="picture/logo (1).png" type="image/x-icon">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
    <div class="containerForm">
            <form action="login.php">
                <!-- Logo DadProject -->
                <div class="formContainer">
                    <img src="picture/logo (1).png" alt="Logo" class="imgLogo">
                </div>

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

                <!-- Input nama pengguna -->
                <div class="formContainer">
                    <input type="text" name="namaPengguna" id="inputField" class="input" placeholder=" " required>
                    <label for="inputField" class="label">Nama Pengguna</label>
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
                        <option value="option1">Mahasiswa</option>
                        <option value="option2">Siswa</option>
                    </select>
                </div>

                <div class="formContainer">
                    <button type="submit" class="btnDaftar">Daftar</button>
                </div>
            </form>
        </div>
        
        <div class = "containerDaftar">
            <p>Sudah punya akun? <a href="login.php">Masuk Akun</a></p>
        </div>  
    </div>
</body>
</html>

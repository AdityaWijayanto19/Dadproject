<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="picture/logo (1).png" type="image/x-icon">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
    <div class="containerForm">
            <form action="login.php">
                <!-- Logo DadProject -->
                <div class="formContainer">
                    <img src="picture/logo (1).png" alt="Logo" class="imgLogo">
                </div>

                <!-- Input email -->
                <div class="formContainer">
                    <input type="email" name="email" id="inputField" class="input" placeholder=" " required>
                    <label for="inputField" class="label">Email</label>
                </div>

                <!-- Input kata sandi -->
                <div class="formContainer">
                    <input type="password" name="kataSandi" id="inputField" class="input" placeholder=" " required>
                    <label for="inputField" class="label">Kata Sandi</label>
                </div>

                <div class="formContainer">
                    <button type="submit" class="btnDaftar">Masuk</button>
                </div>
            </form>
        </div>
        
        <div class = "containerMasuk">
            <p>Belum punya akun? <a href="register.php">Buat Akun</a></p>
        </div>  
    </div>
</body>
</html>

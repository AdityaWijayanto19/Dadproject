<?php
require 'koneksi/koneksi.php';

$data = query("SELECT * FROM `kelas`");
$hasil = $data;

if (isset($_POST['search'])) {
    $cari = htmlspecialchars($_POST['search']);

    $hasil = query("SELECT * FROM `kelas` WHERE `title_kelas` LIKE '%$cari%' ");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="picture/logo.png" type="image/x-icon">
    <title>home page | Dad Project</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <nav>
        <div class="header">
            <div class="boxsearch left">
                <img class="logo" src="picture/logo.png" alt="Dad project">
                <form action="" method="post">
                    <input class="search" type="text" name="search" placeholder="cari...">
                </form>
            </div>

            <div class="hamburger" onclick="toggleMenu()">&#9776;</div>

            <div class="boxsearch right nav-links" id="navLinks">
                <div class="boxbtn-log">
                    <a class="regbtn" href="component/login.php">Masuk</a>
                </div>
                <div class="boxbtn-reg">
                    <a class="regbtn" href="component/register.php">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- hero image -->
    <section>
        <div class="container">
            <img class="image-slide" src="picture/imghero1.jpg" alt="">
            <div class="slogan">
                <h3><span class="ungu">Bangun</span> karirmu sebagai Developer <span class="textdec">Profesional</span></h3>
                <p><span class="bordertext">Mulai belajar</span> terarah dengan learning path</p>
            </div>
        </div>

        <div class="container2">
            <div class="path">
                <button class="box" id="box">
                    <img class="imgpath" src="picture/logo.png" alt="">
                </button>
                <label for="box">FRONT-END DEVELOPER</label>
            </div>

            <div class="path">
                <button class="box" id="box">
                    <img class="imgpath" src="picture/logo.png" alt="">
                </button>
                <label for="box">BACK-END DEVELOPER</label>
            </div>

            <div class="path">
                <button class="box" id="box">
                    <img class="imgpath" src="picture/logo.png" alt="">
                </button>
                <label for="box">MOBILE DEVELOPER</label>
            </div>

            <div class="path">
                <button class="box" id="box">
                    <img class="imgpath" src="picture/logo.png" alt="">
                </button>
                <label for="box">IOT ENGINEER</label>
            </div>
        </div>
    </section>

    <section>
        <div class="boxkelas">
            <?php foreach ($hasil as $dt): ?>
                <div class="kelas">
                    <h3><?= $dt['title_kelas'] ?></h3>
                    <img class="foto" src="picture/<?= $dt['foto'] ?>" alt="">
                    <p>T<?= $dt['desk_kelas'] ?></p>
                    <button class="button">mulai Belajar</button>
                </div>
            <?php endforeach; ?>
        </div>

    </section>


    <script>
        const images = ["picture/imghero1.jpg", "picture/imghero2.png", "picture/thumbnails.jpg"];

        let currentIndex = 0;
        const imgelemet = document.querySelector(".image-slide");

        function changeImg() {
            currentIndex = (currentIndex + 1) % images.length;
            imgelemet.src = images[currentIndex];
        }

        setInterval(changeImg, 2000);


        function toggleMenu() {
            const nav = document.getElementById("navLinks");
            nav.classList.toggle("active");
        }
    </script>
</body>

</html>
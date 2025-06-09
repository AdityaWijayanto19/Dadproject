<?php
session_start();
require 'koneksi/koneksi.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

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
    <title>Home Page | Dad Project</title>
    <link rel="stylesheet" href="css/index/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <nav>
        <div class="navbar">
            <div class="boxSearch left">
                <img class="logo" src="picture/logo1.png" alt="Dad project">
                <form action="" method="post">
                    <input class="search" type="text" name="search" placeholder="Temukan tujuanmu disini">
                </form>
            </div>
            <div class="boxSearch center">
                <ul class="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Kelas</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                    <?php if ($user_role === 'admin') : ?>
                        <li><a href="admin/adminDashboard.php">Dashboard Admin</a></li>
                    <?php elseif ($user_role === 'mentor') : ?>
                        <li><a href="mentor/mentorDashboard.php">Dashboard Mentor</a></li>
                    <?php elseif ($user_role === 'student') : ?>
                        <li><a href="student/dashboardStudent.php">Dashboard Siswa</a></li>
                    <?php endif ?>

                </ul>
            </div>

            <div class="boxSearch right">

            </div>

            <!-- <div class="hamburger" onclick="toggleMenu()">&#9776;</div>

            <div class="boxsearch right nav-links" id="navLinks">
                <div class="boxbtn-log">
                    <a class="regbtn" href="component/login.php">Masuk</a>
                </div>
                <div class="boxbtn-reg">
                    <a class="regbtn" href="component/register.php">Daftar</a>
                </div>
            </div> -->
        </div>



    </nav>

    <!-- HERO SECTION -->
    <section class="firstSection">
        <div class="topSection">
            <div class="slogan">
                <h3 class="greeting">Bangun karirmu sebagai <span class="greet role">Developer Profesional</span></h3>
                <p>Belajar dengan arahan dan bangun fundamental pemrograman dengan</p>
                <p>kurikulum yang sistematis agar setiap langkahmu bisa menuju kesuksesan</p>
                <p>Daftar sekarang dan mulai belajar bersama kami</p>
            </div>
            <div class="button">
                <a class="btnRegister" href="component/register.php">Daftar Sekarang</a>
                <a class="btnLogin" href="component/login.php">Masuk</a>
            </div>
            <div class="imageContainer scroll" style="--t:50s">
                <div>
                    <img class="image-slide" src="picture/imghero1.jpg" alt="">
                    <img class="image-slide" src="picture/imghero2.png" alt="">
                    <img class="image-slide" src="picture/imghero3.jpg" alt="">
                    <img class="image-slide" src="picture/imghero1.jpg" alt="">
                    <img class="image-slide" src="picture/imghero2.png" alt="">
                    <img class="image-slide" src="picture/imghero3.jpg" alt="">
                    <img class="image-slide" src="picture/imghero1.jpg" alt="">
                    <img class="image-slide" src="picture/imghero2.png" alt="">
                    <img class="image-slide" src="picture/imghero3.jpg" alt="">
                </div>
                <div>
                    <img class="image-slide" src="picture/imghero1.jpg" alt="">
                    <img class="image-slide" src="picture/imghero2.png" alt="">
                    <img class="image-slide" src="picture/imghero3.jpg" alt="">
                    <img class="image-slide" src="picture/imghero1.jpg" alt="">
                    <img class="image-slide" src="picture/imghero2.png" alt="">
                    <img class="image-slide" src="picture/imghero3.jpg" alt="">
                    <img class="image-slide" src="picture/imghero1.jpg" alt="">
                    <img class="image-slide" src="picture/imghero2.png" alt="">
                    <img class="image-slide" src="picture/imghero3.jpg" alt="">
                </div>
            </div>
        </div>

        <div class="bottomSectiom">
            <!-- <div class="path">
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
            </div> -->
        </div>
    </section>

    <section class="secondSection">
        <!-- <div class="boxkelas">
            </?php foreach ($hasil as $dt): ?>
                <div class="kelas">
                    <h3></?= $dt['title_kelas'] ?></h3>
                    <img class="foto" src="picture/</?= $dt['foto'] ?>" alt="">
                    <p>T</?= $dt['desk_kelas'] ?></p>
                    <button class="button">mulai Belajar</button>
                </div>
            </?php endforeach; ?>
        </div> -->
    </section>


    <script>
        // TYPING ROLE TEXT
        const text = document.querySelector(".role");
        const textLoad = () => {
            setTimeout(() => {
                text.textContent = "Web Developer";
            }, 0);
            setTimeout(() => {
                text.textContent = "Front-End Developer";
            }, 4000);
            setTimeout(() => {
                text.textContent = "Back-End Developer";
            }, 8000);
            setTimeout(() => {
                text.textContent = "Mobile Developer";
            }, 12000);
            setTimeout(() => {
                text.textContent = "Data Scientist";
            }, 16000);
            setTimeout(() => {
                text.textContent = "UI/UX Designer";
            }, 20000);
            setTimeout(() => {
                text.textContent = "Game Developer";
            }, 24000);
            setTimeout(() => {
                text.textContent = "IOT Engineer";
            }, 28000);
        };

        textLoad();
        setInterval(textLoad, 32000);


        // const images = ["picture/imghero1.jpg", "picture/imghero2.png", "picture/thumbnails.jpg"];

        // let currentIndex = 0;
        // const imgelemet = document.querySelector(".image-slide");

        // function changeImg() {
        //     currentIndex = (currentIndex + 1) % images.length;
        //     imgelemet.src = images[currentIndex];
        // }

        // setInterval(changeImg, 2000);


        function toggleMenu() {
            const nav = document.getElementById("navLinks");
            nav.classList.toggle("active");
        }
    </script>
</body>

</html>
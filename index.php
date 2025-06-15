<?php
session_start();
require 'koneksi/koneksi.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$user_name = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Pengguna';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Username';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Email Pengguna';

$profile_link = '#';
if ($user_role === 'admin') {
    $profile_link = 'admin/adminDashboard.php';
} elseif ($user_role === 'mentor') {
    $profile_link = 'mentor/mentorDashboard.php';
} elseif ($user_role === 'student') {
    $profile_link = 'student/dashboardStudent.php';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="picture/logo.png" type="image/x-icon">
    <title>Home Page | Dad Project</title>
    <link rel="stylesheet" href="css/index/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <!-- NAVBAR SECTION -->
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
                    <li><a href="user/menuKelas.php">Kelas</a></li>
                    <li><a href="user/kontak.php">Kontak</a></li>
                    <?php if ($user_role === 'admin'): ?>
                        <li><a href="admin/adminDashboard.php">Dashboard Admin</a></li>
                    <?php elseif ($user_role === 'mentor'): ?>
                        <li><a href="mentor/mentorDashboard.php">Dashboard Mentor</a></li>
                    <?php elseif ($user_role === 'student'): ?>
                        <li><a href="student/studentDashboard.php">Dashboard Siswa</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="boxSearch right">
                <?php if ($user_id): ?>
                    <?php if ($user_role === 'admin'): ?>
                        <a class="btnProfile" href="admin/adminDashboard.php">Profile</a>
                    <?php elseif ($user_role === 'mentor'): ?>
                        <a class="btnProfile" href="mentor/mentorDashboard.php">Profile</a>
                    <?php elseif ($user_role === 'student'): ?>
                        <a class="btnProfile" href="student/studentDashboard.php">Profile</a>
                    <?php endif; ?>
                    <a class="btnLogout" href="logout.php">Logout</a>
                <?php endif; ?>
            </div>
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

            <?php if (!$user_id): ?>
                <div class="button">
                    <a class="btnRegister" href="component/register.php">Daftar Sekarang</a>
                    <a class="btnLogin" href="component/login.php">Masuk</a>
                </div>
            <?php endif; ?>

            <div class="imageContainer scroll" style="--t:80s">
                <div>
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
                </div>
            </div>
        </div>
    </section>

    <!-- LEARNING PATH SECTION -->
    <div class="bottomSectiom">
        <div class="path-container">
            <div class="section-title">
                <h3 class="greeting">Learning Path</h3>
                <p>Temukan cara belajar yang lebih terarah dengan jalur pembelajaran</p>
                <p>yang sudah disusun agar sesuai dengan kebutuhan Anda.</p>
            </div>
            <div class="section-header">
                <div class="slider-controls">
                    <button id="path-scroll-left" class="arrow-btn" aria-label="Scroll Left">←</button>
                    <button id="path-scroll-right" class="arrow-btn" aria-label="Scroll Right">→</button>
                </div>
            </div>

            <div class="path-slider">
                <div class="path-card" data-path="web" style="background-image: url('picture/webdeveloper.jpg');">
                    <div class="card-title">
                        <h3>Web Developer</h3>
                    </div>
                </div>
                <div class="path-card" data-path="mobile" style="background-image: url('picture/mobiledeveloper.jpg');">
                    <div class="card-title">
                        <h3>Mobile Developer</h3>
                    </div>
                </div>
                <div class="path-card" data-path="iot" style="background-image: url('picture/iotengineer.jpg');">
                    <div class="card-title">
                        <h3>IoT Engineer</h3>
                    </div>
                </div>
                <div class="path-card" data-path="data" style="background-image: url('picture/dataanalyst.jpg');">
                    <div class="card-title">
                        <h3>Data Scientist</h3>
                    </div>
                </div>
                <div class="path-card" data-path="game" style="background-image: url('picture/gamedeveloper.jpg');">
                    <div class="card-title">
                        <h3>Game Developer</h3>
                    </div>
                </div>
                <div class="path-card" data-path="ui-ux" style="background-image: url('picture/uiuxdesigner.jpg');">
                    <div class="card-title">
                        <h3>UI/UX Designer</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="path-details-container">

    </div>

    <div class="secondSection">

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const pathData = {
                mobile: {
                    title: "Mobile Developer",
                    classCount: "3 kelas",
                    studentCount: "299k siswa belajar di path ini",
                    description: "Kurikulum didesain dengan persetujuan dari Tim Google Android untuk mempersiapkan developer Android standar Global. Dicoding adalah Google Developer Authorized Training Partner.",
                    courses: [{
                            step: 1,
                            title: "Memulai Pemrograman dengan Kotlin",
                            rating: "4.84",
                            level: "Dasar",
                            img: "mobiledeveloper.jpg"
                        },
                        {
                            step: 2,
                            title: "Belajar Membuat Aplikasi Android untuk Pemula",
                            rating: "4.87",
                            level: "Pemula",
                            img: "mobiledeveloper.jpg"
                        },
                        {
                            step: 3,
                            title: "Belajar Fundamental Aplikasi Android",
                            rating: "4.84",
                            level: "Menengah",
                            img: "mobiledeveloper.jpg"
                        }
                    ]
                },
                web: {
                    title: "Web Developer",
                    classCount: "4 kelas",
                    studentCount: "450k siswa belajar di path ini",
                    description: "Belajar membuat website responsif dan modern dari dasar hingga menjadi seorang Full-Stack Web Developer handal dengan teknologi terkini.",
                    courses: [{
                            step: 1,
                            title: "Belajar Dasar Pemrograman Web",
                            rating: "4.85",
                            level: "Dasar",
                            img: "webdeveloper.jpg"
                        },
                        {
                            step: 2,
                            title: "Belajar Membuat Front-End Web untuk Pemula",
                            rating: "4.88",
                            level: "Pemula",
                            img: "webdeveloper.jpg"
                        },
                        {
                            step: 3,
                            title: "Belajar Fundamental Front-End Web Development",
                            rating: "4.86",
                            level: "Menengah",
                            img: "webdeveloper.jpg"
                        },
                        {
                            step: 4,
                            title: "Menjadi Front-End Web Developer Expert",
                            rating: "4.90",
                            level: "Expert",
                            img: "webdeveloper.jpg"
                        }
                    ]
                },
                data: {
                    title: "Data Scientist",
                    classCount: "3 kelas",
                    studentCount: "150k siswa belajar di path ini",
                    description: "Mulai karir di bidang data dengan mempelajari statistika, machine learning, dan visualisasi data yang relevan dengan kebutuhan industri.",
                    courses: [{
                            step: 1,
                            title: "Memulai Pemrograman Dengan Python",
                            rating: "4.89",
                            level: "Dasar",
                            img: "dataanalyst.jpg"
                        },
                        {
                            step: 2,
                            title: "Belajar Analisis Data dengan Python",
                            rating: "4.87",
                            level: "Pemula",
                            img: "dataanalyst.jpg"
                        },
                        {
                            step: 3,
                            title: "Belajar Machine Learning untuk Pemula",
                            rating: "4.88",
                            level: "Pemula",
                            img: "dataanalyst.jpg"
                        }
                    ]
                }
            };

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

            const pathSlider = document.querySelector(".path-slider");
            const pathScrollLeftBtn = document.getElementById("path-scroll-left");
            const pathScrollRightBtn = document.getElementById("path-scroll-right");

            if (pathSlider && pathScrollLeftBtn && pathScrollRightBtn) {
                const card = pathSlider.querySelector(".path-card");
                const scrollAmount = card ? card.offsetWidth + 24 : 424;
                pathScrollRightBtn.addEventListener("click", () => {
                    pathSlider.scrollLeft += scrollAmount;
                });
                pathScrollLeftBtn.addEventListener("click", () => {
                    pathSlider.scrollLeft -= scrollAmount;
                });
            }

            const pathDetailsContainer = document.getElementById("path-details-container");

            pathSlider.addEventListener('click', (e) => {
                const clickedCard = e.target.closest('.path-card');
                if (!clickedCard) return;

                const pathId = clickedCard.dataset.path;
                displayPathDetails(pathId, true);
            });

            function displayPathDetails(pathId, shouldScroll) {
                const cardToActivate = document.querySelector(`.path-card[data-path="${pathId}"]`);
                const data = pathData[pathId];

                document.querySelectorAll('.path-card').forEach(card => card.classList.remove('active'));

                if (cardToActivate && data) {
                    renderPathDetails(data);
                    pathDetailsContainer.style.display = 'block';

                    cardToActivate.classList.add('active');

                } else {
                    window.location.href = 'component/comingSoon.php';
                }
            }

            function renderPathDetails(data) {
                const coursesHTML = data.courses.map((course, index) => `
                    <div class="course-card">
                        <img src="picture/${course.img}" alt="${course.title}">
                        <div class="card-content">
                            <div class="card-step">Langkah ${index + 1}</div>
                            <h4>${course.title}</h4>
                        </div>
                    </div>
                `).join('');

                const detailsHTML = `
                    <div class="path-details-content">
                        <div class="path-info">
                            <h2>${data.title}</h2>
                            <div class="info-item"><span>${data.classCount}</span></div>
                            <div class="info-item"><span>${data.studentCount}</span></div>
                            <p class="description">${data.description}</p>
                        </div>
                        <div class="path-courses">
                            <div class="slider-controls-detail">
                                <button id="course-scroll-left" class="arrow-btn">←</button>
                                <button id="course-scroll-right" class="arrow-btn">→</button>
                            </div>
                            <div class="course-slider">${coursesHTML.length > 0 ? coursesHTML : '<p>Belum ada kelas untuk path ini.</p>'}</div>
                        </div>
                    </div>
                `;

                pathDetailsContainer.innerHTML = detailsHTML;
                initializeCourseSlider();
            }

            function initializeCourseSlider() {
                const slider = document.querySelector(".course-slider");
                const scrollLeftBtn = document.getElementById("course-scroll-left");
                const scrollRightBtn = document.getElementById("course-scroll-right");

                if (slider && scrollLeftBtn && scrollRightBtn) {
                    const card = slider.querySelector(".course-card");
                    if (!card) return;
                    const scrollAmount = card.offsetWidth + 20;
                    scrollRightBtn.addEventListener("click", () => {
                        slider.scrollLeft += scrollAmount;
                    });
                    scrollLeftBtn.addEventListener("click", () => {
                        slider.scrollLeft -= scrollAmount;
                    });
                }
            }
            displayPathDetails('web', false);
        });
    </script>
</body>

</html>
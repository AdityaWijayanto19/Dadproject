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

// GET LEARNING PATH
$data_kelas = query("SELECT * FROM kategori_kelas");

function generatePathId($jenis) {
    // GET ID KATEGORI KELAS
    $kategoriKelas = query("SELECT kategori_kelas_id FROM kategori_kelas WHERE jenis = '$jenis'");
    $idKelas = $kategoriKelas[0]['kategori_kelas_id'] ?? null;
    
    return $idKelas ? "$idKelas" : "path-default";
}

// GET KELAS DATA
function getKelasDataByJenis($jenis) {
    global $conn;
    $kelas = query("SELECT * FROM kelas JOIN kategori_kelas ON kelas.kategori_id = kategori_kelas.kategori_kelas_id WHERE kategori_kelas.jenis = '$jenis'");
    return json_encode($kelas);
}

$kelas = query("SELECT * FROM kelas JOIN kategori_kelas ON kelas.kategori_id = kategori_kelas.kategori_kelas_id");

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

    <script>        
        const kelasData = <?= json_encode($data_kelas); ?>;
        const allKelasData = <?= json_encode($kelas); ?>;
        console.log(kelasData);
    </script>
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
                <?php foreach ($data_kelas as $kategori): ?>
                    <div class="path-card" data-path="<?= generatePathId($kategori['jenis']) ?>" style="background-image: url('picture/<?= $kategori['foto']?>');">
                        <div class="card-title">
                            <h3><?= $kategori['jenis'] ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div id="path-details-container">

    </div>

    <div class="secondSection">

    </div>

    <script>                
        document.addEventListener("DOMContentLoaded", () => {               
            const pathDetailsContainer = document.getElementById("path-details-container");            
            renderPathDetails([allKelasData[2]]); // DEFAULT

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

            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('join-btn')) {
                    const kelasId = e.target.dataset.kelasId;
                    console.log("Kamu memilih kelas ID:", kelasId);

                    // Arahkan ke halaman detail/join, atau kirim data via fetch/ajax, dll
                    // Contoh redirect:
                    // window.location.href = `join.php?kelas_id=${kelasId}`;
                }
            });
            

            pathSlider.addEventListener('click', async (e) => {
                const clickedCard = e.target.closest('.path-card');                                                  
                const jenis = clickedCard.dataset.path;
                console.log(jenis);
                    
                


                if (jenis && allKelasData[jenis]) {
                    const kelasData = [allKelasData][0];
                    console.log(kelasData.length); // tampilkan semua kelas dari jenis yang dipilih

                    const allKelas = [];

                    for (let index = 0; index < kelasData.length; index++) {
                        if (kelasData[index].kategori_id == jenis) {                            
                            allKelas.push(kelasData[index]);
                            console.log(kelasData[index].title_kelas);                            
                        }                        
                    }

                    console.log(allKelas);                                
                    
                    renderPathDetails(allKelas); // tampilkan ke UI jika perlu
                } else {
                    console.warn("Data tidak ditemukan untuk jenis:", jenis);
                }


            });

            
            function renderPathDetails(kelasArray) {
                if (!kelasArray || !Array.isArray(kelasArray) || kelasArray.length === 0) {                    
                    const emptyHTML = `
                        <div class="path-details-content">
                            <div class="path-info">
                                <h2>Path Tidak Ditemukan</h2>
                                <div class="info-item"><span>0 kelas</span></div>
                                <p class="description">Belum ada kelas yang tersedia untuk path ini.</p>
                            </div>
                            <div class="path-courses">
                                <div class="course-slider">
                                    <div class="course-card empty">
                                        <div class="card-content">
                                            <h4>Oops!</h4>
                                            <p>Kelas untuk kategori ini belum tersedia.</p>
                                            <small>Silakan cek kembali nanti ya!</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    pathDetailsContainer.innerHTML = emptyHTML;
                    return;
                }

                const jenis = kelasArray[0].jenis;

                const coursesHTML = kelasArray.map((course, index) => `
                    <div class="course-card">
                        <img src="picture/${course.foto}" alt="${course.title_kelas}">
                        <div class="card-content">
                            <div class="card-step">Langkah ${index + 1}</div>
                            <h4>${course.title_kelas}</h4>
                            <p>${course.desk_kelas}</p>       
                            <button class="join-btn" data-kelas-id="${course.kelas_id}">Join Kelas</button>                     
                        </div>
                    </div>
                `).join('');

                const detailsHTML = `
                    <div class="path-details-content">
                        <div class="path-info">
                            <h2>${kelasArray[0].jenis}</h2>
                            <div class="info-item"><span>${kelasArray.length} kelas</span></div>
                            <p class="description"><strong>${kelasArray[0].deskripsi}</strong>.</p>
                        </div>
                        <div class="path-courses">
                            <div class="slider-controls-detail">
                                <button id="course-scroll-left" class="arrow-btn">←</button>
                                <button id="course-scroll-right" class="arrow-btn">→</button>
                            </div>
                            <div class="course-slider">
                                ${coursesHTML.length > 0 ? coursesHTML : '<p>Belum ada kelas untuk path ini.</p>'}
                            </div>
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
            const defaultKategori = kelasData.find(k => k.jenis.toLowerCase().includes('web'));
            if (defaultKategori) {
                renderPathDetails(defaultKategori);
            }
        });
    </script>
</body>

</html>
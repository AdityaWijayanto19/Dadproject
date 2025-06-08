<?php
    session_start();
    $currentPage = 'dashboard'; // Menandai halaman ini sebagai 'dashboard'
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student</title>
    <link rel="stylesheet" href="css/student.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'components/sidebarStudent.php'; ?>
        <div class="content-area">
            <?php include 'components/navbarStudent.php'; ?>
            <main>
                <h1 class="page-title">Selamat Datang, <?php echo isset($_SESSION['info']['name']) ? htmlspecialchars($_SESSION['info']['name']) : 'Student'; ?>!</h1>
                <div class="main-content">
                    <div class="search-bar-container">
                        <div class="search-input-group">
                            <input type="text" placeholder="Cari kelas, materi, atau mentor...">
                            <i class="fa fa-search"></i>
                        </div>
                        <div class="filter-dropdown">
                            <select name="kategori" id="kategori">
                                <option value="semua">Semua Kategori</option>
                                <option value="web">Web Development</option>
                                <option value="design">Design</option>
                                <option value="marketing">Marketing</option>
                            </select>
                        </div>
                    </div>
                    <h2>Kelas Rekomendasi</h2>
                    <br>
                    <div class="recommendation-grid">
                        <a href="detailKelasStudent.php" class="card class-card">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" alt="Class Image">
                            <div class="class-card-content">
                                <h3>Belajar JavaScript Dasar</h3>
                                <p>Pait Vied</p>
                            </div>
                        </a>
                        <a href="detailKelasStudent.php" class="card class-card">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978" alt="Class Image">
                            <div class="class-card-content">
                                <h3>UI/UX Design untuk Pemula</h3>
                                <p>Ein Gun</p>
                            </div>
                        </a>
                        <a href="detailKelasStudent.php" class="card class-card">
                            <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0" alt="Class Image">
                            <div class="class-card-content">
                                <h3>Digital Marketing 101</h3>
                                <p>Pait Xjiot</p>
                            </div>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
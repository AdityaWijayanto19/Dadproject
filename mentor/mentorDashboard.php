<?php

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mentor</title>
    <link rel="stylesheet" href="css/mentorDashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <?php include 'components/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
                <hr>
                <p>Selamat Datang, Mentor</p>
            </header>
            <div class="card-grid">
                <div class="card">
                    <div class="class-card-banner bg-web"></div>
                    <div class="class-card-content">
                        <h3>Web Dasar</h3>
                        <div class="class-card-stats"><span>50 Students</span> • <span>12 Modul</span></div>
                    </div>
                    <div class="class-card-footer">
                        <a class="btn btn-secondary" href="kelolaMateri.php">Kelola Materi</a>
                    </div>
                </div>
                <div class="card">
                    <div class="class-card-banner bg-mobile"></div>
                    <div class="class-card-content">
                        <h3>Mobile App Development</h3>
                        <div class="class-card-stats"><span>80 Students</span> • <span>15 Modul</span></div>
                    </div>
                    <div class="class-card-footer">
                        <a class="btn btn-secondary" href="kelolaMateri.php">Kelola Materi</a>
                    </div>
                </div>
                <div class="card">
                    <div class="class-card-banner bg-data"></div>
                    <div class="class-card-content">
                        <h3>Data Science Fundamentals</h3>
                        <div class="class-card-stats"><span>30 Students</span> • <span>10 Modul</span></div>
                    </div>
                    <div class="class-card-footer">
                        <a class="btn btn-secondary" href="kelolaMateri.php">Kelola Materi</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="js/navbar.js"></script>
</body>

</html>
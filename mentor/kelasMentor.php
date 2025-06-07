<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Saya - Dashboard Mentor</title>
    <link rel="stylesheet" href="css/mentorDashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <?php include 'components/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1>Kelas Saya</h1>
                <button class="btn btn-primary">Buat Kelas Baru</button>
            </div>
            <div class="card-grid">
                <div class="card">
                    <div class="class-card-banner bg-web"></div>
                    <div class="class-card-content">
                        <h3>Web Development</h3>
                        <div class="class-card-stats"><span>50 Students</span> • <span>12 Modul</span></div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 75%;"></div>
                        </div>
                        <p class="progress-label">75% Selesai</p>
                    </div>
                    <div class="class-card-footer"><button class="btn btn-secondary">Kelola Materi</button></div>
                </div>
                <div class="card">
                    <div class="class-card-banner bg-mobile"></div>
                    <div class="class-card-content">
                        <h3>Mobile App Development</h3>
                        <div class="class-card-stats"><span>80 Students</span> • <span>15 Modul</span></div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 40%;"></div>
                        </div>
                        <p class="progress-label">40% Selesai</p>
                    </div>
                    <div class="class-card-footer"><button class="btn btn-secondary">Kelola Materi</button></div>
                </div>
                <div class="card">
                    <div class="class-card-banner bg-data"></div>
                    <div class="class-card-content">
                        <h3>Data Science Fundamentals</h3>
                        <div class="class-card-stats"><span>30 Students</span> • <span>10 Modul</span></div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 100%;"></div>
                        </div>
                        <p class="progress-label">100% Selesai</p>
                    </div>
                    <div class="class-card-footer"><button class="btn btn-secondary">Kelola Materi</button></div>
                </div>
            </div>
        </main>
    </div>
    <script src="js/navbar.js"></script>
</body>

</html>
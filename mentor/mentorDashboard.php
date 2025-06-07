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
            <h1>Dashboard</h1>
            <section class="card-grid">
                <div class="card card-dashboard">
                    <div class="card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                        </svg></div>
                    <h3>Unggah Konten Kelas</h3>
                    <p>Materi kelas dapat diunggah di sini</p>
                </div>
                <div class="card card-dashboard">
                    <div class="card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z" />
                        </svg></div>
                    <h3>Traffic Student</h3>
                    <p class="data-point">125</p>
                    <p>Jumlah student yang mengakses materi</p>
                </div>
                <div class="card card-dashboard">
                    <div class="card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zM13.75 3.5l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11A1.5 1.5 0 0 0 15 13.5V8.5a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5V2.5a.5.5 0 0 1 .5-.5H8.5a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg></div>
                    <h3>Edit Konten Kelas</h3>
                    <p>Perbarui materi yang telah diunggah</p>
                </div>
            </section>

            <div class="table-container">
                <h2 style="margin-bottom: 20px; font-size: 1.5rem;">Daftar Kelas</h2>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Jumlah Student</th>
                            <th>Status</th>
                            <th class="action">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Nama Kelas">Web Development</td>
                            <td data-label="Jumlah Student">50</td>
                            <td data-label="Status"><span class="status-tag status-berjalan">Berjalan</span></td>
                            <td data-label="Aksi" class="action"><button class="btn btn-light">Kelola</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nama Kelas">Mobile App</td>
                            <td data-label="Jumlah Student">80</td>
                            <td data-label="Status"><span class="status-tag status-berjalan">Berjalan</span></td>
                            <td data-label="Aksi" class="action"><button class="btn btn-light">Kelola</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nama Kelas">Data Science</td>
                            <td data-label="Jumlah Student">30</td>
                            <td data-label="Status"><span class="status-tag status-selesai">Selesai</span></td>
                            <td data-label="Aksi" class="action"><button class="btn btn-light">Kelola</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="js/navbar.js"></script>
</body>

</html>
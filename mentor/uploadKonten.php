<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Konten</title>
    <link rel="stylesheet" href="css/mentorDashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard-container">
        <?php include 'components/sidebar.php'; ?>
    
        <div class="content-area">
            <header class="header-kelas">   
                <h1 class="page-title">Detail Kelas: Web Dasar</h1>
                <div class="tabs">
                    <a href="kelolaMateri.php" class="tab-item">Konten</a>
                    <a href="#" class="tab-item active">Upload Konten</a>
                </div>
            </header>
            
            <main>
                <div class="form-container">
                    <form action="/submit-content" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="course_id">

                        <div class="form-group">
                            <label for="content_title">Judul Konten</label>
                            <input type="text" id="content_title" name="content_title" placeholder="Contoh: Pengenalan HTML" required>
                        </div>

                        <div class="form-group">
                            <label for="content_type">Tipe Konten</label>
                            <select id="content_type" name="content_type" required>
                                <option value="" disabled selected>Pilih tipe konten</option>
                                <option value="video_url">Video (Link URL)</option>
                                <option value="video_file">Video (Upload File)</option>
                                <option value="document">Dokumen/Slide (PDF, PPT)</option>
                                <option value="text">Artikel Teks</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="url_or_file">URL Video atau Upload File</label>
                            <input type="text" id="url_or_file" name="url_or_file" placeholder="https://youtube.com/watch?v=... atau upload file di bawah">
                            <input type="file" id="file_upload" name="file_upload" style="margin-top: 10px;">
                            <small>Isi URL atau pilih file untuk diupload. Tergantung pada Tipe Konten.</small>
                        </div>

                        <div class="form-group">
                            <label for="urutan">Urutan Konten</label>
                            <input type="number" id="urutan" name="urutan" placeholder="Contoh: 1" required min="1">
                            <small>Urutan materi ini akan ditampilkan di dalam kelas.</small>
                        </div>

                        <div class="form-group">
                            <label for="content_deskripsi">Deskripsi Singkat</label>
                            <textarea id="content_deskripsi" name="content_deskripsi" rows="4" placeholder="Jelaskan secara singkat isi dari konten ini..."></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-submit">Simpan & Upload Konten</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
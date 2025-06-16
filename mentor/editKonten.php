<?php
session_start();
include '../koneksi/koneksi.php';

$mentor_id = $_SESSION['mentor_id'];
$kelas_id = $_GET['kelas_id'];

$queryKelas = mysqli_query($conn, "SELECT * FROM kelas WHERE kelas_id = '$kelas_id'");
$data_kelas = mysqli_fetch_assoc($queryKelas);

$queryMentor = mysqli_query($conn, "
    SELECT user.nama_lengkap 
    FROM mentors 
    JOIN user ON mentors.user_id = user.user_id 
    WHERE mentors.mentor_id = '$mentor_id'
");

$dataMentor = mysqli_fetch_assoc($queryMentor);
$nama_mentor = $dataMentor['nama_lengkap'] ?? 'Mentor';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Judul statis -->
    <title>Edit Konten - Pengenalan Dasar-Dasar CSS</title>
    <link rel="stylesheet" href="css/mentorDashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard-container">
        <?php include 'components/sidebar.php'; ?>

        <div class="content-area">
            <header class="header-kelas">
                <!-- Judul kelas statis -->
                <h1 class="page-title">Edit Konten di Kelas: Belajar Web Development dari Nol</h1>
                <!-- Link kembali dengan ID kelas statis -->
                <a href="kelolaMateri.php?kelas_id=<?= $kelas_id ?>" class="btn-action btn-back" title="Kembali ke Daftar Konten">
                    <i class="fa-solid fa-left-long"><span>kembali</span></i>
                </a>
            </header>

            <main>
                <div class="form-container">
                    <form action="proses_edit_konten.php" method="POST" enctype="multipart/form-data">

                        <!-- <input type="hidden" name="konten_id" value="101"> -->
                        <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">

                        <div class="form-group">
                            <label for="content_title">Judul Konten</label>
                            <!-- Judul konten statis -->
                            <input type="text" id="content_title" name="content_title"
                                placeholder="Contoh: Pengenalan HTML" required
                                value="Pengenalan Dasar-Dasar CSS">
                        </div>

                        <div class="form-group">
                            <label for="content_type">Tipe Konten</label>
                            <select id="content_type" name="content_type" required>
                                <option value="" disabled>Pilih tipe konten</option>
                                <!-- Tipe konten dipilih secara statis dengan atribut 'selected' -->
                                <option value="video_url">Video (Link URL)</option>
                                <option value="video_file" selected>Video (Upload File)</option>
                                <option value="document">Dokumen/Slide (PDF, PPT)</option>
                                <option value="text">Artikel Teks</option>
                            </select>
                        </div>

                        <div id="url-input-group" class="form-group" style="display: none;">
                            <label for="content_url">Link URL Video</label>
                            <input type="url" id="content_url" name="content_url"
                                placeholder="Contoh: https://www.youtube.com/watch?v=..." value="">
                            <small>Masukkan link lengkap dari platform seperti YouTube atau Vimeo.</small>
                        </div>

                        <div id="file-input-group" class="form-group" style="display: none;">
                            <label for="content_file">Upload File Baru</label>
                            <!-- Info file saat ini ditulis statis -->
                            <p style="font-size: 0.9em; color: #555;">File saat ini:
                                <strong>video_perkenalan_css.mp4</strong>
                            </p>
                            <input type="file" id="content_file" name="content_file">
                            <small>Kosongkan jika tidak ingin mengubah file.</small>
                        </div>

                        <div id="text-input-group" class="form-group" style="display: none;">
                            <label for="content_body">Isi Artikel</label>
                            <textarea id="content_body" name="content_body" rows="10"
                                placeholder="Tulis artikel atau materi teks di sini..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="urutan">Urutan Konten</label>
                            <!-- Urutan statis -->
                            <input type="number" id="urutan" name="urutan" placeholder="Contoh: 1" required min="1"
                                value="2">
                            <small>Urutan materi ini akan ditampilkan di dalam kelas.</small>
                        </div>

                        <div class="form-group">
                            <label for="content_deskripsi">Deskripsi Singkat (Opsional)</label>
                            <!-- Deskripsi statis -->
                            <textarea id="content_deskripsi" name="content_deskripsi" rows="4"
                                placeholder="Jelaskan secara singkat isi dari konten ini...">Ini adalah materi video yang menjelaskan tentang konsep dasar dan fundamental dari Cascading Style Sheets (CSS) untuk pemula.</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Skrip JavaScript tidak perlu diubah karena bekerja pada struktur HTML
        document.addEventListener('DOMContentLoaded', function () {
            const contentTypeSelect = document.getElementById('content_type');
            const urlGroup = document.getElementById('url-input-group');
            const fileGroup = document.getElementById('file-input-group');
            const textGroup = document.getElementById('text-input-group');
            const urlInput = document.getElementById('content_url');
            const fileInput = document.getElementById('content_file');
            const textInput = document.getElementById('content_body');

            function toggleContentInputs() {
                const selectedValue = contentTypeSelect.value;
                urlGroup.style.display = 'none';
                urlInput.required = false;
                fileGroup.style.display = 'none';
                fileInput.required = false;
                textGroup.style.display = 'none';
                textInput.required = false;

                if (selectedValue === 'video_url') {
                    urlGroup.style.display = 'block';
                    urlInput.required = true;
                } else if (selectedValue === 'video_file' || selectedValue === 'document') {
                    fileGroup.style.display = 'block';
                } else if (selectedValue === 'text') {
                    textGroup.style.display = 'block';
                    textInput.required = true;
                }
            }
            contentTypeSelect.addEventListener('change', toggleContentInputs);
            toggleContentInputs();
        });
    </script>

</body>
</html>
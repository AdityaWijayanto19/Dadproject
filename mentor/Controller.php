<?php
session_start();
require '../koneksi/koneksi.php';
function tambahKonten($data)
{
    global $conn;

    $kelas_id = (int) $data['kelas_id'];
    $content_title = mysqli_real_escape_string($conn, $data['content_title']);
    $content_type = mysqli_real_escape_string($conn, $data['content_type']);
    $urutan = (int) $data['urutan'];
    $content_deskripsi = mysqli_real_escape_string($conn, $data['content_deskripsi']);
    $content_value = '';

    switch ($content_type) {
        case 'video_url':
            $content_value = mysqli_real_escape_string($conn, $data['url_or_file']);
            break;

        case 'video_file':
        case 'document':
            if (isset($_FILES['content_file']) && $_FILES['content_file']['error'] === UPLOAD_ERR_OK) {

                $target_dir = "../content/";

                $file_extension = pathinfo($_FILES["content_file"]["name"], PATHINFO_EXTENSION);
                $unique_filename = uniqid('konten_', true) . '.' . $file_extension;
                $target_file = $target_dir . $unique_filename;
            
                if (move_uploaded_file($_FILES['content_file']['tmp_name'], $target_file)) {
                    $content_value = $unique_filename;
                } else {
                    $_SESSION['error_message'] = "Gagal mengupload file.";
                    return 0; 
                }
            } else {
                $_SESSION['error_message'] = "Tidak ada file yang diupload atau terjadi error.";
                return 0;
            }
            break;

        case 'text':
            $content_value = mysqli_real_escape_string($conn, $data['content_body']);
            break;

        default:
            $_SESSION['error_message'] = "Tipe konten tidak valid.";
            return 0;
    }

    $query = "INSERT INTO content (kelas_id, content_title, content_type, url_or_file, urutan, content_deskripsi) 
              VALUES ('$kelas_id', '$content_title', '$content_type', '$content_value', '$urutan', '$content_deskripsi')";

    mysqli_query($conn, $query);

    $affected_rows = mysqli_affected_rows($conn);

    if ($affected_rows > 0) {
        $_SESSION['success_message'] = "Konten berhasil ditambahkan!";
    } else {
        $_SESSION['error_message'] = "Gagal menyimpan data ke database. Error: " . mysqli_error($conn);
    }

    return $affected_rows;
}

function hapusKonten($data)
{
    global $conn;

    $content_id = (int) $data['content_id'];

    $query_get_content = mysqli_query($conn, "SELECT content_type, url_or_file FROM content WHERE content_id = '$content_id'");

    if (mysqli_num_rows($query_get_content) > 0) {
        $content = mysqli_fetch_assoc($query_get_content);
        $content_type = $content['content_type'];
        $file_name = $content['url_or_file'];

        $query_delete = mysqli_query($conn, "DELETE FROM content WHERE content_id = '$content_id'");

        if ($query_delete && mysqli_affected_rows($conn) > 0) {
            if (($content_type === 'video_file' || $content_type === 'document') && !empty($file_name)) {
                $file_path = '../content/' . $file_name;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $_SESSION['success_message'] = "Konten berhasil dihapus.";
        } else {
            $_SESSION['error_message'] = "Gagal menghapus konten dari database.";
        }
    } else {
        $_SESSION['error_message'] = "Konten tidak ditemukan.";
    }
}

$action = $_GET['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    tambahKonten($_POST);
    $kelas_id = (int) $_POST['kelas_id'];
    header("Location: kelolaMateri.php?kelas_id=" . $kelas_id);
    exit();

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'hapus') {
    if (!isset($_SESSION['mentor_id'])) {
        die("Akses ditolak.");
    }

    hapusKonten($_GET); 
    $kelas_id = (int) $_GET['kelas_id'];
    header("Location: kelolaMateri.php?kelas_id=" . $kelas_id);
    exit();

} else {
    die("Akses tidak diizinkan atau aksi tidak dikenal.");
}
?>
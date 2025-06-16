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

function editKonten($data)
{
    global $conn;

    $content_id = (int) $data['content_id'];
    $kelas_id = (int) $data['kelas_id'];
    $content_title = mysqli_real_escape_string($conn, $data['content_title']);
    $content_type = mysqli_real_escape_string($conn, $data['content_type']);
    $urutan = (int) $data['urutan'];
    $content_deskripsi = mysqli_real_escape_string($conn, $data['content_deskripsi']);
    $old_file_name = $data['old_file_name'];
    $content_value = '';

    switch ($content_type) {
        case 'video_url':
            $content_value = mysqli_real_escape_string($conn, $data['url_or_file']);
            if (!empty($old_file_name) && file_exists('../content/' . $old_file_name)) {
                unlink('../content/' . $old_file_name);
            }
            break;

        case 'video_file':
        case 'document':
            if (isset($_FILES['content_file']) && $_FILES['content_file']['error'] === UPLOAD_ERR_OK) {
                if (!empty($old_file_name) && file_exists('../content/' . $old_file_name)) {
                    unlink('../content/' . $old_file_name);
                }

                $target_dir = "../content/";
                $file_extension = pathinfo($_FILES["content_file"]["name"], PATHINFO_EXTENSION);
                $unique_filename = uniqid('konten_', true) . '.' . $file_extension;
                $target_file = $target_dir . $unique_filename;

                if (move_uploaded_file($_FILES['content_file']['tmp_name'], $target_file)) {
                    $content_value = $unique_filename;
                } else {
                    $_SESSION['error_message'] = "Gagal mengupload file baru.";
                    return;
                }
            } else {
                $content_value = $old_file_name;
            }
            break;

        case 'text':
            $content_value = mysqli_real_escape_string($conn, $data['content_body']);
            if (!empty($old_file_name) && file_exists('../content/' . $old_file_name)) {
                unlink('../content/' . $old_file_name);
            }
            break;
    }

    $query = "UPDATE content SET
                content_title = '$content_title',
                content_type = '$content_type',
                url_or_file = '$content_value',
                urutan = '$urutan',
                content_deskripsi = '$content_deskripsi'
              WHERE content_id = '$content_id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Konten berhasil diperbarui!";
    } else {
        $_SESSION['error_message'] = "Gagal memperbarui konten. Error: " . mysqli_error($conn);
    }
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

function updateProfilMentor($data)
{
    global $conn;

    $mentor_id = (int) $_SESSION['mentor_id'];
    $query_user = mysqli_query($conn, "SELECT user_id FROM mentors WHERE mentor_id = '$mentor_id'");
    $user_data = mysqli_fetch_assoc($query_user);
    $user_id = (int) $user_data['user_id'];

    $nama_lengkap = mysqli_real_escape_string($conn, $data['nama_lengkap']);
    $password_baru = $data['password_baru'];
    $konfirmasi_password = $data['konfirmasi_password'];

    $query_update_nama = "UPDATE user SET nama_lengkap = '$nama_lengkap' WHERE user_id = '$user_id'";
    mysqli_query($conn, $query_update_nama);

    if (!empty($password_baru)) {
        if ($password_baru !== $konfirmasi_password) {
            $_SESSION['error_message'] = "Password baru dan konfirmasi tidak cocok.";
            return;
        }

        $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);

        $query_update_pass = "UPDATE user SET password = '$hashed_password' WHERE user_id = '$user_id'";
        mysqli_query($conn, $query_update_pass);
    }

    $_SESSION['success_message'] = "Silahkan Relogin agar perubahan dapat terlihat";
}

function hapusAkunMentor()
{
    global $conn;

    $mentor_id = (int) $_SESSION['mentor_id'];

    $query_user = mysqli_query($conn, "SELECT user_id FROM mentors WHERE mentor_id = '$mentor_id'");
    if (mysqli_num_rows($query_user) === 0) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
    $user_data = mysqli_fetch_assoc($query_user);
    $user_id = (int) $user_data['user_id'];

    $query_konten = mysqli_query($conn, "SELECT c.url_or_file FROM content c JOIN kelas k ON c.kelas_id = k.kelas_id WHERE k.mentor_id = '$mentor_id' AND (c.content_type = 'video_file' OR c.content_type = 'document')");
    while ($konten = mysqli_fetch_assoc($query_konten)) {
        $file_path = '../content/' . $konten['url_or_file'];
        if (file_exists($file_path))
            unlink($file_path);
    }

    mysqli_query($conn, "DELETE FROM mentors WHERE mentor_id = '$mentor_id'");

    mysqli_query($conn, "DELETE FROM user WHERE user_id = '$user_id'");

    session_destroy();
    header("Location: ../index.php?pesan=akun_dihapus");
    exit();
}


// ==================================================================================
$action = $_REQUEST['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case 'edit':
            editKonten($_POST);
            $redirect_url = "kelolaMateri.php?kelas_id=" . (int) $_POST['kelas_id'];
            break;
        case 'update_profil':
            updateProfilMentor($_POST);
            $redirect_url = "mentorDashboard.php";
            break;
        default:
            tambahKonten($_POST);
            $redirect_url = "kelolaMateri.php?kelas_id=" . (int) $_POST['kelas_id'];
            break;
    }
    header("Location: " . $redirect_url);
    exit();

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_SESSION['mentor_id'])) {
        die("Akses ditolak.");
    }

    switch ($action) {
        case 'hapus':
            hapusKonten($_GET);
            $redirect_url = "kelolaMateri.php?kelas_id=" . (int) $_GET['kelas_id'];
            break;
        case 'hapus_akun':
            hapusAkunMentor();
            break;
        default:
            die("Aksi tidak dikenal untuk metode GET.");
    }
    header("Location: " . $redirect_url);
    exit();

} else {
    die("Metode request tidak diizinkan.");
}
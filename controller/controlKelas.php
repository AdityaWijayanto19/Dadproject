<?php
require '../koneksi/koneksi.php';

//query kelas
function tambah($data){
    global $conn;

    $title = htmlspecialchars($data['title']);
    $desc = htmlspecialchars($data['desc']);
    $mentor = htmlspecialchars($data['mentor']);
    $kategori = htmlspecialchars($data['kategori']);
    $enrollment = htmlspecialchars($data['enrollment']);

    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $size_file = $_FILES['foto']['size'];
    $direktori = '../picture/' . $nama_file;

    

    if(move_uploaded_file($lokasi_file,$direktori)){
        $query = "INSERT INTO kelas (`title_kelas`, `foto`,	`desk_kelas`,`mentor_id`,`kategori_id`) VALUES ('$title','$nama_file','$desc','$mentor','$kategori')";

        // GET ID KELAS ID
        $query_id = mysqli_query($conn,"SELECT kelas_id FROM kelas WHERE title_kelas = '$title' AND desk_kelas = '$desc' AND mentor_id = '$mentor' AND kategori_id = '$kategori'");
        $kelas_id = mysqli_fetch_assoc($query_id)['kelas_id'];

        if (mysqli_query($conn, $query)) {
            // 2. Ambil kelas_id terakhir
            $kelas_id = mysqli_insert_id($conn);

            // 3. Masukkan enrollment_key ke tabel enrollment_key
            $query_enrollment = "INSERT INTO enrollment_key (`kelas_id`, `enrollment_key`) 
                                VALUES ('$kelas_id', '$enrollment')";
            
            mysqli_query($conn, $query_enrollment);
        }
        mysqli_query($conn,$query);
    }

    return mysqli_affected_rows($conn);

}

function hapus($id){
    global $conn;

    $query = mysqli_query($conn,"SELECT `foto` FROM kelas WHERE kelas_id = $id" );
    $data = mysqli_fetch_assoc($query);
    $foto = $data["foto"];

    $sql_f = "SELECT `foto` FROM `kelas` WHERE `kelas_id` = $id";
    $query_f = mysqli_query($conn,$sql_f);
    while($db_f = mysqli_fetch_row($query_f)){
        $foto = $db_f[0];
    } 

   

    if(file_exists("../picture/" . $foto )){
        unlink("../picture/" . $foto);
    }

    mysqli_query($conn,"DELETE FROM `kelas` WHERE kelas_id = $id ");
    
    return mysqli_affected_rows($conn);
}

function edit($edit,$id){
    global $conn;

    $title = htmlspecialchars($edit['title']);
    $desc = htmlspecialchars($edit['desc']);
    $mentor = htmlspecialchars($edit['mentor']);
    $kategori = htmlspecialchars($edit['kategori']);

    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $size_file = $_FILES['foto']['size'];
    $direktori = '../picture/' . $nama_file;

    $query = "UPDATE kelas SET
                `title_kelas` = '$title',
                `foto` = '$nama_file',
                `desk_kelas` = '$desc',
                `mentor_id` = '$mentor',
                `kategori_id` = '$kategori'
                WHERE kelas_id = $id";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

?>
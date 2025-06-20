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

    if(move_uploaded_file($lokasi_file, $direktori)){
    $query = "INSERT INTO kelas (`title_kelas`, `foto_kelas`, `desk_kelas`,`mentor_id`,`kategori_id`) 
              VALUES ('$title','$nama_file','$desc','$mentor','$kategori')";

    if (mysqli_query($conn, $query)) {
        $kelas_id = mysqli_insert_id($conn);

        $query_enrollment = "INSERT INTO enrollment_key (`kelas_id`, `enrollment_key`) 
                             VALUES ('$kelas_id', '$enrollment')";
        mysqli_query($conn, $query_enrollment);
    }
}

    return mysqli_affected_rows($conn);

}

function hapus($id){
    global $conn;

    $query = mysqli_query($conn,"SELECT `foto_kelas` FROM kelas WHERE kelas_id = $id" );
    $data = mysqli_fetch_assoc($query);
    $foto = $data["foto_kelas"];

    $sql_f = "SELECT `foto_kelas` FROM `kelas` WHERE `kelas_id` = $id";
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
    $enrollment = htmlspecialchars($edit['enrollment']);

    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $size_file = $_FILES['foto']['size'];
    $direktori = '../picture/' . $nama_file;

    $query = "UPDATE kelas SET
                `title_kelas` = '$title',
                `foto_kelas` = '$nama_file',
                `desk_kelas` = '$desc',
                `mentor_id` = '$mentor',
                `kategori_id` = '$kategori'
                WHERE kelas_id = $id";        

    if (mysqli_query($conn, $query)) {                        
        $query_enrollment = "UPDATE enrollment_key SET `enrollment_key` = '$enrollment' 
                             WHERE kelas_id = '$id'";                             
        
        mysqli_query($conn, $query_enrollment);
    }    

    return mysqli_affected_rows($conn);
}

?>
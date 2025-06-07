<?php
require '../koneksi/koneksi.php';

//query kelas
function tambah($data){
    global $conn;

    $title = htmlspecialchars($data['title']);
    $desc = htmlspecialchars($data['desc']);
    $mentor = htmlspecialchars($data['mentor']);
    $kategori = htmlspecialchars($data['kategori']);

    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $size_file = $_FILES['foto']['size'];
    $direktori = '../picture/' . $nama_file;

    if(move_uploaded_file($lokasi_file,$direktori)){
        $query = "INSERT INTO kelas (`title_kelas`, `foto`,	`desk_kelas`,`mentor_id`,`kategori`) VALUES ('$title','$nama_file','$desc','$mentor','$kategori')";

        mysqli_query($conn,$query);
    }

    return mysqli_affected_rows($conn);

}

function hapus($id){
    global $conn;

    $query = mysqli_query($conn,"SELECT `foto` FROM kelas WHERE kelas_id = $id" );
    $data = mysqli_fetch_assoc($query);
    $foto = $data["foto"];

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
                `kategori` = '$kategori'
                WHERE kelas_id = $id";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

?>
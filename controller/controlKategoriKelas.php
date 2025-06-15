<?php
require '../koneksi/koneksi.php';

function tambah($data){
    global $conn;

    $jenis = htmlspecialchars($data['jenis']);
    $desc = htmlspecialchars($data['desc']);

    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $size_file = $_FILES['foto']['size'];
    $direktori = '../picture/' . $nama_file;

    if(move_uploaded_file($lokasi_file,$direktori)){
        $query = "INSERT INTO `kategori_kelas` (`jenis`,`deskripsi`,`foto`) VALUES ('$jenis','$desc','$nama_file')";

        mysqli_query($conn,$query);
    }

    return mysqli_affected_rows($conn);
}

function edit($edit,$id){
    global $conn;

    $jenis = htmlspecialchars($edit['jenis']);
    $desc = htmlspecialchars($edit['desc']);

    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $size_file = $_FILES['foto']['size'];
    $direktori = '../picture/' . $nama_file;

    $query = "UPDATE `kategori_kelas` SET
    `jenis`='$jenis',
    `deskripsi`='$desc',
    `foto`='$nama_file'
    WHERE `kategori_kelas_id` = '$id'";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}

function hapus($id){
    global $conn;

    $query=mysqli_query($conn,"SELECT `foto` FROM kategori_kelas WHERE kategori_kelas_id = '$id'");
    while($db_f = mysqli_fetch_row($query)){
        $foto = $db_f[0];
    }

    if(file_exists("../picture/" . $foto )){
        unlink("../picture/" . $foto);
    }

    mysqli_query($conn,"DELETE FROM `kategori_kelas` WHERE `kategori_kelas_id` = '$id'");

    return mysqli_affected_rows($conn);
}
?>

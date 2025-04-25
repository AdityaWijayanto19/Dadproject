<?php 

$db = mysqli_connect("localhost", "root", "", "");
if(!$db){
    die("error koneksi :" . mysqli_connect_errno());
}

?>
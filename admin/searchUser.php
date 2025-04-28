<?php

    include '../koneksi/koneksi.php';
    
    $keyword = $_GET["keyword"];
    $query = "SELECT * FROM user WHERE user_id LIKE '%$keyword%' 
        OR nama_depan LIKE '%$keyword%' 
        OR nama_belakang LIKE '%$keyword%' 
        OR nama_lengkap LIKE '%$keyword%' 
        OR username LIKE '%$keyword%' 
        OR email LIKE '%$keyword%' 
        OR `role` LIKE '%$keyword%'";

    $dataUser = query($query);

    // CEK DATA
    if (empty($dataUser)) {
        echo '<tr><td colspan="9">Data tidak ditemukan</td></tr>';
    } else {
        echo '<table class="custom-table">    
                <thead>
                    <tr>
                        <th>Id User</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($dataUser as $user) {
            echo '<tr>
                    <td>' . $user['user_id'] . '</td>
                    <td>' . $user['nama_depan'] . '</td>
                    <td>' . $user['nama_belakang'] . '</td>
                    <td>' . $user['nama_lengkap'] . '</td>
                    <td>' . $user['username'] . '</td>
                    <td>' . $user['email'] . '</td>
                    <td>' . $user['password'] . '</td>
                    <td>' . $user['role'] . '</td>
                    <td>
                        <a class="btnEdit" href="editUser.php?user_id=' . $user['user_id'] . '">Edit</a>
                        <a class="btnHapus" name="deleteUser" href="#" onclick="confirm(' . $user['user_id'] . ')">Hapus</a>
                    </td>
                </tr>';
        }
        echo '</tbody></table>';
    }

?>
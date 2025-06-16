<?php
require '../koneksi/koneksi.php';

$keyword = mysqli_real_escape_string($conn, $_GET["keywordUser"]);

$query = "SELECT * FROM user 
          WHERE 
              user_id LIKE '%$keyword%' 
              OR nama_depan LIKE '%$keyword%' 
              OR nama_belakang LIKE '%$keyword%'
              OR CONCAT(nama_depan, ' ', nama_belakang) LIKE '%$keyword%' 
              OR nama_lengkap LIKE '%$keyword%' 
              OR username LIKE '%$keyword%' 
              OR email LIKE '%$keyword%' 
              OR `role` LIKE '%$keyword%'
          ORDER BY user_id DESC";

$dataUser = query($query);
?>

<table class="custom-table" border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Aksi</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($dataUser)): ?>
            <tr>
                <td colspan="8" style="text-align: center;">User tidak ditemukan untuk keyword "<?= htmlspecialchars($keyword) ?>".</td>
            </tr>
        <?php else: ?>
            <?php foreach ($dataUser as $user): ?>
                <tr>
                    <td><?= $user['user_id'] ?></td>
                    <td class="actions">
                        <button class="hapus" onclick="confirmDelete(<?= $user['user_id'] ?>, '<?= htmlspecialchars(addslashes($user['username'])) ?>')">Hapus</button>
                        <button class="edit"><a href="editUser.php?user_id=<?= $user['user_id'] ?>">Edit</a></button>
                    </td>
                    <td><?= htmlspecialchars($user['nama_depan']) ?></td>
                    <td><?= htmlspecialchars($user['nama_belakang']) ?></td>
                    <td><?= htmlspecialchars($user['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
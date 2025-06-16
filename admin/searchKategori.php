<?php
require '../koneksi/koneksi.php';

$keyword = mysqli_real_escape_string($conn, $_GET["keywordKategori"]);

$query = "SELECT * FROM kategori_kelas 
          WHERE 
              jenis LIKE '%$keyword%' 
              OR deskripsi LIKE '%$keyword%'
          ORDER BY kategori_kelas_id DESC";

$dataKategori = query($query);

?>
<table class="custom-table" border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>NO.</th>
            <th>Aksi</th>
            <th>Jenis Kategori</th>
            <th>Deskripsi</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($dataKategori)): ?>
            <tr>
                <td colspan="5" style="text-align: center;">Kategori tidak ditemukan untuk keyword "<?= htmlspecialchars($keyword) ?>".</td>
            </tr>
        <?php else: ?>
            <?php $i = 1; ?>
            <?php foreach ($dataKategori as $dt): ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td class="actions">
                        <button class="hapus" onclick="confirmDelete(<?= $dt['kategori_kelas_id'] ?>)">Hapus</button>
                        <button class="edit"><a href="editKategoriKelas.php?id=<?= $dt['kategori_kelas_id']; ?>">Edit</a></button>
                    </td>
                    <td><?= htmlspecialchars($dt["jenis"]) ?></td>
                    <td><?= htmlspecialchars($dt["deskripsi"]) ?></td>
                    <td><img src="../picture/<?= htmlspecialchars($dt["foto"]) ?>" alt="Foto Kategori" width="100"></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
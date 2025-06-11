<?php
require "../controller/controlKelas.php";
$alert = "";

$id = $_GET['id'];
$data = query("SELECT * FROM kelas WHERE `kelas_id`= $id");

if (isset($_POST['submit'])) {
    if (edit($_POST, $id) > 0) {
        $alert = "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'data telah berhasil diubah.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                window.location.href = 'manageClasses.php'; //berpindah kehalaman lain
            });
            </script>";
    } else {
        $alert = "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'belum ada data yang diubah.',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi' 
                }).then(() => {
                window.location.href = 'manageClasses.php';
            });
            </script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<style>
    hr {
        border-color: #9333EA;

    }
</style>

<body class="bg-[#0F172A] text-white">
    <?= $alert ?>

    <div class="mx-10 mt-5">
        <h1 class="text-3xl font-semibold">Tambah kelas</h1>
        <br>
        <hr>
    </div>

    <div class="flex p-10 gap-10">
        <div class="flex justify-center items-center w-[30%] h-150 bg-[#1C2435] border-2 border-[#9333EA] rounded-xl">
            <img class="h-30" src="../picture/logo1.png" alt="">
        </div>

        <form class="flex flex-col p-10 w-[70%] h-150 bg-[#1C2435] border-2 border-[#9333EA] rounded-xl" action=""
            method="POST" enctype="multipart/form-data">
            <div class="flex flex-col text-xl">
                <?php foreach ($data as $dt): ?>
                    <ul>
                        <li class="flex flex-col text-xl">
                            <label for="title">Title kelas</label>
                            <input
                                class="bg-[#323A4C] p-2 text-white border border-[#323A4C] focus:border-[#9333EA] focus:ring-[#9333EA] focus:outline-none rounded-md"
                                type="text" name="title" id="title" required value="<?= $dt['title_kelas'] ?>">
                        </li>

                        <li class="flex flex-col text-xl">
                            <label for="foto">foto</label>
                            <input
                                class="bg-[#323A4C] p-2 text-white border border-[#323A4C] focus:border-[#9333EA] focus:ring-[#9333EA] focus:outline-none rounded-md cursor-pointer hover:bg-[#0F172A] hover:scale-101 duration-200"
                                type="file" name="foto" id="foto" value="<?= $dt['foto'] ?>">
                        </li>

                        <li class="flex flex-col text-xl">
                            <label for="desc">Deskripsi kelas</label>
                            <textarea
                                class="h-40 bg-[#323A4C] p-2 text-white border border-[#323A4C] focus:border-[#9333EA] focus:ring-[#9333EA] focus:outline-none rounded-md"
                                type="text" name="desc" id="desc" required><?= $dt['desk_kelas'] ?></textarea>
                        </li>

                        <li class="flex flex-col text-xl">
                            <label for="mentor">ID mentor</label>
                            <input
                                class="bg-[#323A4C] p-2 text-white border border-[#323A4C] focus:border-[#9333EA] focus:ring-[#9333EA] focus:outline-none rounded-md"
                                type="text" name="mentor" id="mentor" required value="<?= $dt['mentor_id'] ?>">
                        </li>

                        <li class="flex flex-col text-xl">
                            <label for="kategori">Kategori</label>
                            <input
                                class="bg-[#323A4C] p-2 text-white border border-[#323A4C] focus:border-[#9333EA] focus:ring-[#9333EA] focus:outline-none rounded-md"
                                type="text" name="kategori" id="kategori" required value="<?= $dt['kategori'] ?>">
                        </li>
                    </ul>
                    <div class="flex justify-between mt-5">
                        <a class="bg-[#C084FC] p-2 rounded-md hover:bg-[#9333EA] hover:scale-102 duration-200"
                            href="manageClasses.php">Kembali</a>
                        <button class="bg-[#C084FC] p-2 rounded-md hover:bg-[#9333EA] hover:scale-102 duration-200"
                            type="submit" name="submit">Edit Kelas</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
</body>

</html>
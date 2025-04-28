<?php 
    session_start();
    include '../koneksi/koneksi.php';

    $dataUser = query('SELECT * FROM user');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../picture/logo.png" type="image/x-icon">
    <title>Kelola Pengguna-DadProject</title>
    <link rel="stylesheet" href="../css/manageUser.css">
    <!-- Sweetalert CDN -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Toastify CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>DadProject</h2>
            </div>
            <ul>
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="manageUser.php">Pengguna</a></li>
                <li><a href="manageClasses.php">Kelas</a></li>
                <li><a href="manageCategoryClass">Kategori Kelas</a></li>
                <li><a href="#">Notifikasi</a></li>
                <li><a href="#">Statistik dan Data Pengguna</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Manajemen Pengguna</h1>
                <hr>
                <br>
                <p>Selamat Datang, Admin</p>
            </div>
            <div class="stats-container">
                
                <!-- Tombol untuk membuka modal -->
                <button id="openModalBtn">Tambah Pengguna</button> 
                <input type="text" name="keyword" id="keyword" class="inputSearch" autocomplete="off"  placeholder="Cari Pengguna" required>

            <!-- Modal -->
            <div id="addUserModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Form Tambah Pengguna</h2>
                    <form action="../controller/controlUser.php" method="POST" class="form-container">
                       
                        <label for="firstName">Nama Depan:</label>
                        <input type="text" id="firstName" name="namaDepan" required>

                        <label for="lastName">Nama Belakang:</label>
                        <input type="text" id="lastName" name="namaBelakang" required>

                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="kataSandi" required>

                        <label for="role">Role:</label>
                        <select id="role" name="role" required onchange="updateFormByRole()">
                            <option value="admin">Admin</option>
                            <option value="mentor">Mentor</option>
                            <option value="student">Student</option>
                        </select>

                        <!-- Admin Specific Fields -->
                        <div class="admin-fields" id="adminFields">
                            <!-- Kosong tidak ada data tambahan -->
                        </div>

                        <!-- Mentor Specific Fields -->
                        <div class="mentor-fields" id="mentorFields">
                            <label for="mentorSubject">Expertise:</label>
                            <select id="expertise" name="expertise">
                                <option value="Web Development">Web Development</option>
                                <option value="Backend Developer">Backend Developer</option>
                                <option value="UI/UX Design">UI/UX Design</option>
                                <option value="Data Analyst">Data Analyst</option>
                            </select>
                        </div>

                        <!-- Student Specific Fields -->
                        <div class="student-fields" id="studentFields">
                            <label for="status">Status:</label>
                            <select id="status" name="status">
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Siswa">Siswa</option>
                            </select>
                        </div>

                        <button type="submit" name = "tambahUser">Tambah Pengguna</button>
                    </form>
                </div>
            </div>

            <div id="searchResult">
                     <!-- Tabel Pengguna -->
                    <table class="custom-table">
                    <thead>
                    <tr>
                        <th>Id User</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataUser as $user) : ?>         
                            <tr>
                                <td><?= $user['user_id']; ?></td>
                                <td><?= $user['nama_depan']; ?></td>
                                <td><?= $user['nama_belakang']; ?></td>
                                <td><?= $user['nama_lengkap']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td><?= $user['password']; ?></td>
                                <td><?= $user['role']; ?></td>
                                <td>
                                    <a class="btnEdit" href="editUser.php?user_id=<?= $user['user_id']; ?>">Edit</a>
                                    <a class="btnHapus" name="deleteUser" href="#" onclick="confirm(<?= $user['user_id'];?>)">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>      
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>

            //Ambil elemen yang dibutuhkan
            var keyword = document.getElementById('keyword');
            var searchResult = document.getElementById('searchResult');

            keyword.addEventListener('keyup', function(){

                //OBJEK AJAX
                var xhr = new XMLHttpRequest();

               
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {

                        searchResult.innerHTML = xhr.responseText;
                    }
                };
                
                xhr.open('GET', 'searchUser.php?keyword=' + keyword.value, true)
                xhr.send();
            });

            function confirm(id) {
                Swal.fire({
                    title: "yakin ?",
                    text: "data akan dihapus permanent!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'deleteUser.php?user_id=' + id;
                    }
                });
            }

            // Mendapatkan elemen modal dan tombol untuk membuka modal
            var modal = document.getElementById("addUserModal");
            var openModalBtn = document.getElementById("openModalBtn");
            var closeModalBtn = document.getElementsByClassName("close")[0];

            // Ketika tombol "Tambah Pengguna" diklik, buka modal
            openModalBtn.onclick = function() {
                modal.style.display = "block";
            }

            // Ketika tombol tutup diklik, tutup modal
            closeModalBtn.onclick = function() {
                modal.style.display = "none";
            }

            // Menutup modal jika pengguna mengklik di luar modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Fungsi untuk memperbarui form berdasarkan role yang dipilih
            function updateFormByRole() {
                var role = document.getElementById("role").value;
                if (role === "admin") {
                    document.getElementById("adminFields").style.display = "block";
                    document.getElementById("mentorFields").style.display = "none";
                    document.getElementById("studentFields").style.display = "none";
                } else if (role === "mentor") {
                    document.getElementById("adminFields").style.display = "none";
                    document.getElementById("mentorFields").style.display = "block";
                    document.getElementById("studentFields").style.display = "none";
                } else {
                    document.getElementById("adminFields").style.display = "none";
                    document.getElementById("mentorFields").style.display = "none";
                    document.getElementById("studentFields").style.display = "block";
                }
            }

            // Memanggil fungsi updateFormByRole saat halaman pertama kali dimuat
            window.onload = updateFormByRole;
    </script>                               

</body>
</html>

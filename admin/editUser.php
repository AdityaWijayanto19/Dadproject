<?php
session_start();
include '../koneksi/koneksi.php';

//memanggil id_user dari url
$user_id = (int) $_GET['user_id'];

// Query untuk mengambil data dari tabel user, mentor, dan student
$query = "
         SELECT user.*, mentors.expertise, students.status
         FROM user
         LEFT JOIN mentors ON user.user_id = mentors.user_id
         LEFT JOIN students ON user.user_id = students.user_id
         WHERE user.user_id = $user_id
     ";

// Mengambil data
$dataUser = query($query)[0];  // Ambil data pertama
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../picture/logo.png" type="image/x-icon">
    <title>Form Edit Pengguna-DadProject</title>
    <link rel="stylesheet" href="../css/manageUser/manageUser.css">
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="wrapper">
        <div class="main-content">
            <header>
                <h2>Form Edit Pengguna</h2>
                <br>
                <hr>
                <br>
            </header>
            <div class="stats-container">
                <form id="editUserForm" action="../controller/controlUser.php" method="POST" class="form-container">

                    <input type="hidden" name="userId" value="<?= $dataUser['user_id']; ?>">

                    <label for="firstName">Nama Depan:</label>
                    <input type="text" id="firstName" name="namaDepan" value="<?= $dataUser['nama_depan']; ?>" required>

                    <label for="lastName">Nama Belakang:</label>
                    <input type="text" id="lastName" name="namaBelakang" value="<?= $dataUser['nama_belakang']; ?>"
                        required>

                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?= $dataUser['username']; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $dataUser['email']; ?>" required>

                    <label for="role">Role:</label>
                    <select id="role" name="role" required onchange="updateFormByRole()">
                        <option value="admin" <?= ($dataUser['role'] == 'admin' ? 'selected' : '') ?>>Admin</option>
                        <option value="mentor" <?= ($dataUser['role'] == 'mentor' ? 'selected' : '') ?>>Mentor</option>
                        <option value="student" <?= ($dataUser['role'] == 'student' ? 'selected' : '') ?>>Student</option>
                    </select>

                    <!-- Admin Specific Fields -->
                    <div class="admin-fields" id="adminFields"></div>

                    <!-- Mentor Specific Fields -->
                    <div class="mentor-fields" id="mentorFields">
                        <label for="expertise">Expertise:</label>
                        <select id="expertise" name="expertise">
                            <option value="Web Development" <?= ($dataUser['expertise'] == 'Web Development' ? 'selected' : '') ?>>Web Development</option>
                            <option value="Backend Developer" <?= ($dataUser['expertise'] == 'Backend Developer' ? 'selected' : '') ?>>Backend Developer</option>
                            <option value="UI/UX Design" <?= ($dataUser['expertise'] == 'UI/UX Design' ? 'selected' : '') ?>>UI/UX Design</option>
                            <option value="Data Analyst" <?= ($dataUser['expertise'] == 'Data Analyst' ? 'selected' : '') ?>>Data Analyst</option>
                        </select>
                    </div>

                    <!-- Student Specific Fields -->
                    <div class="student-fields" id="studentFields">
                        <label for="status">Status:</label>
                        <select id="status" name="status">
                            <option value="Mahasiswa" <?= ($dataUser['status'] == 'Mahasiswa' ? 'selected' : '') ?>>
                                Mahasiswa</option>
                            <option value="Siswa" <?= ($dataUser['status'] == 'Siswa' ? 'selected' : '') ?>>Siswa</option>
                        </select>
                    </div>

                    <!-- Tombol untuk memicu SweetAlert konfirmasi -->
                    <button type="submit" name="editUser" class="btnEditPengguna" onclick="confirmEdit()">Edit
                        Pengguna</button>
                </form>
                <button class="btnEditPengguna"><a href="manageUser.php">Kembali</a></button>
            </div>
        </div>

        <script>
            // FUNGSI UNTUK MENAMPILKAN INPUT DARI ROLE SELECT YANG DIPILIH
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
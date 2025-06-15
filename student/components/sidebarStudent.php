<?php
$user_name = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Pengguna';
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'student';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Username Student';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Email Student';
?>


<div class="content">
    <div class="greeting">
        <h1>Hallo <?= $user_name ?> <span>!</span></h1>
        <p>Bagaimana dengan proses belajarmu?</p>
    </div>
    <div class="student-detail">
        <h1>Your Detail</h1>
        <div class="container-detail">
            <div class="detail-item">
                <h2>Nama <span>: <?= $user_name ?></span></h2>
            </div>
            <div class="detail-item">
                <h2>Role <span>: <?= $user_role ?></span>
                </h2>
            </div>
            <div class="detail-item">
                <h2>Username <span>: <?= $username ?></span>
                </h2>
            </div>
            <div class="detail-item">
                <h2>Email <span>: <?= $email ?></span>
                </h2>
            </div>
            <div class="detail-item">
                <h2>Kelas yang diikuti <span>: x</span>
                </h2>
            </div>
        </div>
    </div>
</div>
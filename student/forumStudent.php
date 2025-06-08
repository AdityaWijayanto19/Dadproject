<?php
    session_start();
    // Tidak ada menu sidebar khusus, tapi kita bisa set agar tidak ada yg aktif
    $currentPage = ''; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi - Student</title>
    <link rel="stylesheet" href="css/student.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'components/sidebarStudent.php'; ?>
        <div class="content-area">
            <?php include 'components/navbarStudent.php'; ?>
            <main>
                <div class="forum-header">
                    <h1 class="page-title">Forum Diskusi</h1>
                    <button class="btn btn-primary">Buat Topik Baru</button>
                </div>
                <div class="main-content">
                    <div class="thread-post">
                        <h2 class="thread-title">Bagaimana cara memahami closure di JS?</h2>
                        <p class="thread-meta">Be Ovensnsika <span>2 jam lalu</span></p>
                    </div>
                    <div class="replies-section">
                        <div class="reply-item">
                            <img src="https://i.pravatar.cc/50?img=1" alt="Avatar">
                            <div class="reply-content">
                                <p class="reply-author">Senviit mailenackeal atuckaaus</p>
                                <p class="reply-meta">Stamrstel pink@pastahakear?</p>
                            </div>
                        </div>
                    </div>
                    <hr style="border: 1px solid #f3f4f6; margin: 30px 0;">
                    <div class="reply-form">
                        <form action="#">
                            <textarea placeholder="Tulis balasan..."></textarea>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
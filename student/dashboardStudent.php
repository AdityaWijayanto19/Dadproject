<?php
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body and background */
        body {
            font-family: Arial, sans-serif;
            background-color: #F9F7F7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #112D4E;
        }

        /* Main container for the dashboard */
        .dashboard-container {
            display: flex;
            width: 80%;
            height: 80%;
            border-radius: 10px;
            overflow: hidden;
            background-color: #DBE2EF;
        }

        /* Sidebar */
        .sidebar {
            width: 25%;
            background-color: #3F72AF;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
            z-index: 1;
        }

        .username {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navigation a {
            display: block;
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navigation a:hover {
            background-color: #112D4E;
        }

        /* Main content area */
        .main-content {
            width: 75%;
            padding: 40px;
            text-align: center;
        }

        .main-content h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .main-content p {
            font-size: 1.2rem;
            color: #3F72AF;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="profile-section">
                <img src="<?= htmlspecialchars($_SESSION['info']['picture']) ?>" class="profile-img" referrerpolicy="no-referrer">
                <h2 class="username"><?= $_SESSION['info']['name'] ?></h2>
            </div>
            <div class="navigation">
                <a href="#">Dashboard</a>
                <a href="#">Settings</a>
                <a href="#">Logout</a>
            </div>
        </div>
        <div class="main-content">
            <h1>Selamat Datang <?= $_SESSION['info']['name'] ?></h1>
            <p>Here you can manage your profile and settings.</p>
        </div>
    </div>
</body>

</html>
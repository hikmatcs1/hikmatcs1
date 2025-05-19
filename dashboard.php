<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/style_dashboard.css">
</head>
<body>
    <div class="sidebar">
        <h2 style="text-align:center; color:#ecf0f1;">Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="#">Pengguna</a>
        <a href="#">Laporan</a>
        <a href="#">Setelan</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="main-content">
        <div class="header">
            <span>Selamat datang, <?php echo $username; ?>!</span>
        </div>
        <h1>Dashboard Admin</h1>
           <div class="card">
                <h3>Daftar Calon Mahasiswa</h3>
                <p></p>
            </div>
            <div class="card">
                <h3>---</h3>
                <p>--- </p>
            </div>
        </div>
        <footer>
            <p>&copy; 2025 Sistem Admin - All Rights Reserved</p>
        </footer>
    </div>
</body>
</html>

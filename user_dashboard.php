<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
    <link rel="stylesheet" href="css/style_dashboard.css">
</head>
<body>
    <div class="sidebar">
        <h2 style="text-align:center; color:#ecf0f1;">User Panel</h2>
        <a href="user_dashboard.php">Beranda</a>
        <a href="#">Profil</a>
        <a href="#">Formulir</a>
        <a href="#">Status</a>
        <a href="logout.php">Logout</a>
    </div>
    
    <div class="main-content">
        <div class="header">
            <span>Selamat datang, <?php echo htmlspecialchars($email); ?>!</span>
        </div>
        <h1>Dashboard Pengguna</h1>
        <div class="card">
            <h3>Status Pendaftaran</h3>
            <p>Belum diverifikasi</p>
        </div>
        <div class="card">
            <h3>Pengumuman</h3>
            <p>Tidak ada pengumuman terbaru</p>
        </div>
        <footer>
            <p>&copy; 2025 Sistem Pendaftaran - All Rights Reserved</p>
        </footer>
    </div>
</body>
</html>

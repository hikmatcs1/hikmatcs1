<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login PMB</title>
  <link rel="stylesheet" href="css/style_login.css">
</head>
<body>

<div class="login-container">
  <h2>Halaman Login</h2>

 <?php if ($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>

  <form method="post" action="proses_login.php">
    <input type="text" name="username" placeholder="Username (Admin) / Email (User)">
    <input type="password" name="password" placeholder="Password (Admin) / NISN (User)">
    <button type="submit">Login</button><br><br>
    <a href="index.php"><button type="button">Kembali ke Halaman Utama</button></a>
  </form>
</div>

</body>
</html>

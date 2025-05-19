<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pmb";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_user = mysqli_real_escape_string($conn, $_POST['username']);
    $input_pass = mysqli_real_escape_string($conn, $_POST['password']);

    $sql_admin = "SELECT * FROM users WHERE username = '$input_user' AND password = md5('$input_pass')";
    $result_admin = mysqli_query($conn, $sql_admin);

    if (mysqli_num_rows($result_admin) === 1) {
        $admin = mysqli_fetch_assoc($result_admin);
        $_SESSION['username'] = $admin['username'];
        $_SESSION['role'] = 'admin';
        header("Location: dashboard.php");
        exit;
    }

    $sql_user = "SELECT * FROM pendaftar WHERE email = '$input_user' AND nisn = '$input_pass'";
    $result_user = mysqli_query($conn, $sql_user);

    if (mysqli_num_rows($result_user) === 1) {
        $user = mysqli_fetch_assoc($result_user);
        $_SESSION['username'] = $user['nisn'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = 'user';
        $_SESSION['id_pendaftar'] = $user['id'];

        header("Location: user_dashboard.php");
        exit;
    }

    $_SESSION['error'] = "Username/email atau password/NISN salah!";
    header("Location: login.php");
    exit;
}
?>

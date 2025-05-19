<?php
$host = 'localhost';    
$user = 'root';         
$pass = '';             
$db   = 'pmb';  

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nik = trim($_POST['nik'] ?? '');
$nisn = trim($_POST['nisn'] ?? '');
$fullname = trim($_POST['fullname'] ?? '');
$sekolah = trim($_POST['sekolah'] ?? '');
$email = trim($_POST['email'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$kabupaten_kota = trim($_POST['kabupaten_kota'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$program = trim($_POST['program'] ?? '');

if (!$nik || !$nisn || !$fullname || !$sekolah || !$email || !$alamat || !$kabupaten_kota || !$phone || !$program) {
    header("Location: index.php?error=1");
    exit;
}

$sqlCheck = "SELECT id FROM pendaftar WHERE nik = ?";
$stmt = $conn->prepare($sqlCheck);
$stmt->bind_param("s", $nik);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $conn->close();
    header("Location: index.php?error=2");
    exit;
}
$stmt->close();

$sqlInsert = "INSERT INTO pendaftar (nik, nisn, fullname, sekolah, email, alamat, kabupaten_kota, phone, program) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sqlInsert);
$stmt->bind_param("sssssssss", $nik, $nisn, $fullname, $sekolah, $email, $alamat, $kabupaten_kota, $phone, $program);
$success = $stmt->execute();
$stmt->close();
$conn->close();

if ($success) {
    header("Location: index.php?success=1");
} else {
    header("Location: index.php?error=1");
}
exit;

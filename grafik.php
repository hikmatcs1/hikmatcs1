<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pmb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT kabupaten_kota, COUNT(*) AS jumlah FROM pendaftar GROUP BY kabupaten_kota";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[$row['kabupaten_kota']] = (int)$row['jumlah'];
}

header('Content-Type: application/json');
echo json_encode($data);
?>

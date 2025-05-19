<?php
header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'pmb';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  echo json_encode([]);
  exit;
}

$query = "SELECT program, COUNT(*) as jumlah FROM pendaftar GROUP BY program";

$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[$row['program']] = (int)$row['jumlah'];
}

echo json_encode($data);
$conn->close();
?>

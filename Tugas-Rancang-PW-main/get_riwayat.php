<?php
include('connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT p.id, k.name AS concert_name, p.ticket_type, p.created_at, p.payment_status
          FROM pembayaran p
          JOIN konser k ON p.concert_id = k.id
          WHERE p.name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Kirimkan data sebagai JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

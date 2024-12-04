<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('connection.php');
$username = $_SESSION['username']; 


echo "<script>console.log('Email Session: " . $_SESSION['email'] . "');</script>";


$query = "SELECT p.id, k.nama_artis, p.ticket_type, p.created_at, p.payment_status, p.ticket_code 
          FROM pembayaran p 
          JOIN konser k ON p.concert_id = k.id 
          WHERE p.email = ?";  

$stmt = $conn->prepare($query);  
$stmt->bind_param("s", $_SESSION['email']);  
$stmt->execute();  

$result = $stmt->get_result();
$riwayat = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<script>console.log('Row: " . json_encode($row) . "');</script>";
        $riwayat[] = $row;  
    }
}
$stmt->close();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembelian</title>
    <link rel="stylesheet" href="Riwayat.css">
</head>
<body>
    <nav class="navbar">
        <div class="merk">EncS</div>
        <ul class="nav-links">
            <li><a href="home.php">HOME</a></li>
            <li><a href="about.php">ABOUT US</a></li>
            <li><a href="contact.php">CONTACT US</a></li>
            <li><a href="Riwayat.php" class="active">Riwayat</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>History Pembelian</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Pembelian</th>
                    <th>Nama Artis/Konser</th> <!-- Ganti "Concert" menjadi "Nama Artis" -->
                    <th>Ticket Type</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>kode tiket</th>
                </tr>
            </thead>
            <tbody id="riwayat-table">
                <?php if (count($riwayat) > 0): ?>
                    <?php foreach ($riwayat as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['nama_artis'] ?></td> 
                            <td><?= $item['ticket_type'] ?></td>
                            <td><?= $item['created_at'] ?></td>
                            <td><?= $item['payment_status'] ?></td>
                            <td><?= $item['ticket_code'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Tidak ada riwayat pembelian.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

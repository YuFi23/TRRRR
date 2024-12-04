<?php
include('connection.php'); 

$concert_id = isset($_GET['concert']) ? $_GET['concert'] : null;
$concert = null;
$stock_available = false;

if ($concert_id) {
    $stmt = $conn->prepare("SELECT * FROM konser WHERE id = ?");
    $stmt->bind_param("i", $concert_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $concert = $result->fetch_assoc();
    
    if ($concert) {

        $stock_available = $concert['stock'] > 0;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Ticket</title>
    <link rel="stylesheet" href="pesen.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="buy.php">
                <button class="back-button">Back</button>
            </a>
            <img src="img/logo.png" alt="Logo" class="logo">
        </div>
        <div class="content">
            <?php if ($concert): ?>
            <div class="image-section">
                <img src="img/<?php echo $concert['gambar']; ?>" alt="Concert Image" class="event-image">
                <div class="event-info">
                    <h1><?php echo $concert['nama_artis']; ?> - <?php echo date('d F Y', strtotime($concert['tanggal'])); ?></h1>
                    <h1><?php echo $concert['tempat']; ?></h1>
                </div>
            </div>
            <div class="form-section">
                <form action="validasiPembayaran.php" method="POST">
                    <input type="hidden" name="concert_id" value="<?php echo $concert['id']; ?>">

                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">No Telp:</label>
                    <input type="tel" id="phone" name="phone" required>

                    <label for="ticket_type">Pilih Tiket:</label>
                    <select id="ticket_type" name="ticket_type" required>
                        <option value="VIP">VIP (<?php echo number_format($concert['harga'] * 2, 0, ',', '.'); ?>,-)</option>
                        <option value="Regular">Regular (<?php echo number_format($concert['harga'], 0, ',', '.'); ?>,-)</option>
                    </select>

                    <label for="payment">Metode Pembayaran:</label>
                    <select id="payment" name="payment_method" required>
                        <option value="qris">QRIS</option>
                    </select>

                    <button type="submit" class="validate-button" href="validasiPembayaran.php">Lanjutkan ke Validasi</button>
                </form>
            </div>
            <?php else: ?>
            <p>Konser tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
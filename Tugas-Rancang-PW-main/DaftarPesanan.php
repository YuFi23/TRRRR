<?php
include('connection.php');
include('functions.php');

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}


$search = isset($_GET['search']) ? $_GET['search'] : '';


$query = "
    SELECT 
        pembayaran.name AS nama_pelanggan, 
        pembayaran.email, 
        pembayaran.phone, 
        pembayaran.ticket_type, 
        konser.nama_artis AS nama_konser,
        pembayaran.ticket_code
    FROM pembayaran
    LEFT JOIN konser ON pembayaran.concert_id = konser.id
    WHERE pembayaran.payment_status = 'Validated'
";


if ($search) {
    $query .= " AND pembayaran.email LIKE ?";
}

$stmt = $conn->prepare($query);


if ($search) {
    $searchTerm = "%" . $search . "%"; 
    $stmt->bind_param("s", $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="DaftarPesanan.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>ADMIN</h2>
            <ul>
                <li><a href="DataPelanggan.php">Data Akun</a></li>
                <li><a href="DaftarPesanan.php" class="active">Daftar Pesanan</a></li>
                <li><a href="DaftarKonser.php">Daftar Konser</a></li>
            </ul>
            <a href="?logout=true" class="logout-btn">Logout</a>
        </div>
        <div class="main-content">
            <h1>Daftar Pesanan</h1>

            <!-- Search Form -->
            <div class="search-box">
                <form method="GET" action="DaftarPesanan.php">
                    <input type="text" name="search" placeholder="Cari email" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button type="submit">Cari</button>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>No. Telpon</th>
                        <th>Tipe Tiket</th>
                        <th>Nama Konser</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Menampilkan data jika ada
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['nama_pelanggan']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['ticket_type']}</td>
                                <td>{$row['nama_konser']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Belum ada pesanan yang divalidasi.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

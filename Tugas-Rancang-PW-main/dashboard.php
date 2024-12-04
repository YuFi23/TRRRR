<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

echo "Selamat datang, " . $_SESSION['username'] . "!<br>";

if ($_SESSION['role'] == 'admin') {
    echo "<h2>Admin Dashboard</h2>";
    echo "<p>Selamat datang di halaman admin. Anda dapat mengelola tiket dan melihat statistik.</p>";
    echo "<a href='DataPelanggan.php.php'>Go to Ticket Management</a><br>";
} elseif ($_SESSION['role'] == 'user') {
    echo "<h2>User Dashboard</h2>";
    echo "<p>Selamat datang di halaman pengguna. Anda dapat melihat tiket yang tersedia untuk dibeli.</p>";
    echo "<a href='view_tickets.php'>View Available Tickets</a><br>";
} else {
    echo "<p>Akun tidak dikenali jenis role!</p>";
}

?>

<a href="logout.php">Logout</a>
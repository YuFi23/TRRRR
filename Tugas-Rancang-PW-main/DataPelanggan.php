<?php
include('connection.php');
session_start();

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the query to fetch accounts
$query = "SELECT * FROM akun";

// Add search condition if search term is provided
if ($search) {
    $query .= " WHERE username LIKE ?";
}

$stmt = $conn->prepare($query);

// If search term exists, bind the parameter for the LIKE clause
if ($search) {
    $searchTerm = "%" . $search . "%";  // Adding '%' for partial match
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
    <title>Data Akun</title>
    <link rel="stylesheet" href="DataPelanggan.css">
</head>
<body>
<div class="container">
    <div class="sidebar">
        <h2>ADMIN</h2>
        <ul>
            <li><a href="DataPelanggan.php" class="active">Data Akun</a></li>
            <li><a href="DaftarPesanan.php">Daftar Pesanan</a></li>
            <li><a href="DaftarKonser.php">Daftar Konser</a></li>
        </ul>
        <a href="DataPelanggan.php?logout=true" class="logout-btn">Logout</a>
    </div>

    <div class="main-content">
        <h1>Data Akun</h1>

        <!-- Search Form -->
        <div class="search-box">
            <form method="GET" action="DataPelanggan.php">
                <input type="text" name="search" placeholder="Cari Username" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit">Cari</button>
            </form>
        </div>

        <!-- Edit Form if data exists -->
        <?php if (isset($_GET['edit'])): ?>
        <form method="POST" class="edit-form">
            <h2>Edit Akun</h2>
            <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $editData['username']; ?>" required>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $editData['email']; ?>" required>
            <label>Role:</label>
            <select name="role" required>
                <option value="admin" <?php echo ($editData['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?php echo ($editData['role'] === 'user') ? 'selected' : ''; ?>>User</option>
            </select>
            <button type="submit" name="update">Update</button>
        </form>
        <?php endif; ?>

        <!-- Display Account Data -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                            <td>
                                <a href='DataPelanggan.php?edit={$row['id']}'>Edit</a> |
                                <a href='DataPelanggan.php?delete={$row['id']}' onclick='return confirm(\"Yakin ingin menghapus akun ini?\");'>Hapus</a>
                            </td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

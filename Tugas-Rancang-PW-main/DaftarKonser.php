<?php
include('connection.php');
include('functions.php');

if (isset($_GET['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $nama_artis = $_POST['nama_artis'];
    $tempat = $_POST['tempat'];
    $tanggal = $_POST['tanggal'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    if ($harga < 0) {
        $error_message = "Harga tiket tidak boleh negatif.";
    } elseif ($stock < 0) {
        $error_message = "Jumlah stok tidak boleh negatif.";
    } else {
        $gambar = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];

        $gambar_new_name = time() . '_' . $gambar;

        move_uploaded_file($gambar_tmp, "img/" . $gambar_new_name);

        $stmt = $conn->prepare("INSERT INTO konser (nama_artis, tempat, tanggal, harga, gambar, stock) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $nama_artis, $tempat, $tanggal, $harga, $gambar_new_name, $stock); // Bind stock
        $stmt->execute();

        header("Location: daftarKonser.php?added=success");
        exit();
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_artis = $_POST['nama_artis'];
    $tempat = $_POST['tempat'];
    $tanggal = $_POST['tanggal'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock']; 

    if ($harga < 0) {
        $error_message = "Harga tiket tidak boleh negatif.";
    } elseif ($stock < 0) {
        $error_message = "Jumlah stok tidak boleh negatif.";
    } else {
        if ($_FILES['gambar']['name'] != "") {
            $gambar = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];

            $gambar_new_name = time() . '_' . $gambar;

            move_uploaded_file($gambar_tmp, "img/" . $gambar_new_name);

            $stmt = $conn->prepare("UPDATE konser SET nama_artis = ?, tempat = ?, tanggal = ?, harga = ?, gambar = ?, stock = ? WHERE id = ?");
            $stmt->bind_param("ssssssi", $nama_artis, $tempat, $tanggal, $harga, $gambar_new_name, $stock, $id); 
        } else {
            $stmt = $conn->prepare("UPDATE konser SET nama_artis = ?, tempat = ?, tanggal = ?, harga = ?, stock = ? WHERE id = ?");
            $stmt->bind_param("sssssi", $nama_artis, $tempat, $tanggal, $harga, $stock, $id);
        }

        if ($stmt->execute()) {
            header("Location: daftarKonser.php?updated=success");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the query to fetch concerts
$query = "SELECT * FROM konser";

// Add the search condition if a search term is present
if ($search) {
    $query .= " WHERE nama_artis LIKE ?";
}

// Prepare the statement
$stmt = $conn->prepare($query);

// If a search term is provided, bind the parameter for the LIKE clause
if ($search) {
    $searchTerm = "%" . $search . "%";  // Adding '%' for partial match
    $stmt->bind_param("s", $searchTerm);
}

// Execute the query and get the result
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Konser</title>
    <link rel="stylesheet" href="DaftarKonser.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>ADMIN</h2>
            <ul>
                <li><a href="DataPelanggan.php">Data Akun</a></li>
                <li><a href="DaftarPesanan.php">Daftar Pesanan</a></li>
                <li><a href="daftarKonser.php" class="active">Daftar Konser</a></li>
            </ul>
            <a href="DataPelanggan.php?logout=true" class="logout-btn">Logout</a>
        </div>
        <div class="main-content">
    <h1>Daftar Konser</h1>

    <?php
    if (isset($error_message)) {
        echo "<div class='error-message'>$error_message</div>";
    }
    ?>

    <!-- Search Form -->
    <div class="search-box">
        <form method="GET" action="daftarKonser.php">
            <input type="text" name="search" placeholder="Cari Nama Artis" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <form method="POST" action="daftarKonser.php" enctype="multipart/form-data" class="form-crud">
        <input type="text" name="nama_artis" placeholder="Nama Artis" required>
        <input type="text" name="tempat" placeholder="Tempat" required>
        <input type="date" name="tanggal" required>
        <input type="number" step="0.01" name="harga" placeholder="Harga Tiket" required>
        <input type="number" name="stock" placeholder="Jumlah Stock" required> <!-- New stock field -->
        <input type="file" name="gambar" accept="image/*" required>
        <button type="submit" name="add">Tambah Konser</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Artis</th>
                <th>Tempat</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_artis']}</td>
                        <td>{$row['tempat']}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['harga']}</td>
                        <td>{$row['stock']}</td>
                        <td><img src='img/{$row['gambar']}' width='100'></td>
                        <td>
                            <a href='daftarKonser.php?edit={$row['id']}'>Edit</a> |
                            <a href='process.php?delete={$row['id']}'>Hapus</a>
                        </td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>

    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $stmt = $conn->prepare("SELECT * FROM konser WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $concert = $result->fetch_assoc();

        if ($concert) {
            ?>
            <form method="POST" action="daftarKonser.php" enctype="multipart/form-data" class="form-crud">
                <input type="hidden" name="id" value="<?php echo $concert['id']; ?>">
                <input type="text" name="nama_artis" placeholder="Nama Artis" value="<?php echo $concert['nama_artis']; ?>" required>
                <input type="text" name="tempat" placeholder="Tempat" value="<?php echo $concert['tempat']; ?>" required>
                <input type="date" name="tanggal" value="<?php echo $concert['tanggal']; ?>" required>
                <input type="number" step="0.01" name="harga" placeholder="Harga Tiket" value="<?php echo $concert['harga']; ?>" required>
                <input type="number" name="stock" placeholder="Jumlah Stock" value="<?php echo $concert['stock']; ?>" required> <!-- Edit stock -->
                <input type="file" name="gambar" accept="image/*">
                <button type="submit" name="update">Update Konser</button>
            </form>
            <?php
        }
    }
    ?>
</div>
    </div>
     <script>
        window.onload = function() {
            var errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000); 
            }
        };
    </script>
</body>
</html>
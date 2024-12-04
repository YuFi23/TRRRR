<?php
include('connection.php'); 
include('functions.php');

if (isset($_POST['add'])) {
    $nama_artis = $_POST['nama_artis'];
    $tempat = $_POST['tempat'];
    $tanggal = $_POST['tanggal'];
    $harga = $_POST['harga'];
    

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $gambar = $_FILES['gambar'];
        createConcert($conn, $nama_artis, $tempat, $tanggal, $harga, $gambar);
    } else {
        echo "<script>alert('Error: Tidak ada gambar yang di-upload.');</script>";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_artis = $_POST['nama_artis'];
    $tempat = $_POST['tempat'];
    $tanggal = $_POST['tanggal'];
    $harga = $_POST['harga'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        updateConcert($conn, $id, $nama_artis, $tempat, $tanggal, $harga, $_FILES['gambar']);
    } else {
        updateConcert($conn, $id, $nama_artis, $tempat, $tanggal, $harga);
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $conn->query("DELETE FROM pembayaran WHERE concert_id = $id");

    // Cek keberadaan gambar sebelum menghapus
    $query = $conn->query("SELECT gambar FROM konser WHERE id = $id");
    $row = $query->fetch_assoc();
    $gambar = $row['gambar'];

    if (file_exists('img/' . $gambar)) {
        unlink('img/' . $gambar);
    } else {
        echo "<script>console.warn('File gambar tidak ditemukan.');</script>";
    }


    deleteConcert($conn, $id);
}
?>

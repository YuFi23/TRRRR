<?php
include('database.php');
include('functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $concert_id = $_POST['concert_id']; // Ambil concert_id dari form
    $payment_id = $_POST['payment_id']; 
    $status = 'Validated'; 

    // Persiapkan query untuk update status pembayaran
    $stmt = $conn->prepare("UPDATE pembayaran SET payment_status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $payment_id);

    // Eksekusi query dan cek hasilnya
        // Mengurangi stok tiket untuk konser terkait
        $stmt_check_stock = $conn->prepare("SELECT stock FROM konser WHERE id = ?");
        $stmt_check_stock->bind_param("i", $concert_id);
        $stmt_check_stock->execute();
        $result_stock = $stmt_check_stock->get_result();
        $stock_data = $result_stock->fetch_assoc();

        // Mengurangi stok tiket jika stok masih tersedia
        if ($stock_data['stock'] > 0) {
            $stmt_update_stock = $conn->prepare("UPDATE konser SET stock = stock - 1 WHERE id = ?");
            $stmt_update_stock->bind_param("i", $concert_id);
            $stmt_update_stock->execute();

            // Cek apakah stok berhasil dikurangi
            if ($stmt_update_stock->affected_rows > 0) {
                echo "<script>alert('Pembayaran berhasil divalidasi dan stok tiket berkurang!');</script>";
            } else {
                echo "<script>alert('Gagal mengurangi stok tiket.');</script>";
            }
        } else {
            echo "<script>alert('Stok tiket tidak tersedia.');</script>";
        }

        // Redirect ke halaman success
        header("Location: success.php");
        exit();  // Pastikan tidak ada kode lain yang dijalankan setelah header()
    } else {
        // Jika gagal, tampilkan alert gagal
        echo "<script>alert('Gagal memvalidasi pembayaran.');</script>";
    }

    // Menutup statement setelah digunakan
    $stmt->close();

?>

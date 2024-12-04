<?php
include 'functions.php';
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            color: #2ecc71; 
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #333;
            margin-bottom: 30px;
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pembayaran Berhasil!</h1>
        <p>Terima kasih telah membeli tiket Anda!</p>
        <p>Berikut adalah kode tiket Anda:</p>
        <h2><?php echo $ticket_code; ?></h2> 
        <p>Silakan kembali ke halaman utama dengan menekan tombol di bawah ini.</p>
        <a href="home.php" class="btn">Kembali ke Home</a>
    </div>
</body>
</html>

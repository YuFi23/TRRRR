<?php
session_start();

// Menghapus semua data sesi
session_unset();
session_destroy();

// Mengarahkan pengguna kembali ke halaman login
header('Location: home.php');
exit();

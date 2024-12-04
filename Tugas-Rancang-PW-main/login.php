<?php
session_start();
include 'connection.php'; // Menghubungkan ke database

// Inisialisasi variabel error
$login_error = '';
$signup_error = '';

// Cek jika form login dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Mengambil data dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan email
    $sql = "SELECT * FROM akun WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Mengambil data user
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];  // Store role if needed
            $_SESSION['username'] = $user['username'];  // Add username to session
            $_SESSION['avatar'] = $user['avatar']; // Menyimpan avatar pengguna

            // Arahkan berdasarkan role
            if ($user['role'] == 'admin') {
                header("Location: DataPelanggan.php"); // Arahkan ke halaman admin
            } elseif ($user['role'] == 'user') {
                header("Location: home.php"); // Arahkan ke halaman user
            } else {
                header("Location: home3.php"); // Arahkan ke halaman lainnya (misalnya 'manager')
            }
            exit();
        } else {
            $login_error = "Password salah!";
        }
    } else {
        $login_error = "Email tidak ditemukan!";
    }
}

// Cek jika form signup dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    // Mengambil data dari form signup
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verifikasi apakah password dan konfirmasi password cocok
    if ($password != $confirm_password) {
        $signup_error = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Tentukan peran default (misalnya 'user')
        $role = 'user'; // Anda bisa mengubahnya menjadi 'admin' atau 'manager' jika diperlukan

        // Query untuk menyimpan data pengguna baru
        $sql = "INSERT INTO akun (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            header("Location: login.php?status=registered"); // Arahkan ke login setelah registrasi
            exit();
        } else {
            $signup_error = "Terjadi kesalahan saat mendaftar: " . $conn->error;
        }
    }
}

// Fungsi Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php"); // Arahkan ke halaman login setelah logout
    exit();
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("img/background home.png");
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .form-container h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-container button {
            width: 100%;
            background-color: #04AA6D;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-top: 15px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #038d57;
        }

        .form-container .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .form-container hr {
            margin: 20px 0;
            border: 0.5px solid #ddd;
        }

        .toggle-link {
            display: inline-block;
            margin-top: 10px;
            color: #04AA6D;
            text-decoration: none;
            font-size: 14px;
        }

        .toggle-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php if (isset($_SESSION['username'])): ?>
    <!-- Dashboard for logged-in users -->
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <img src="<?php echo $_SESSION['avatar']; ?>" alt="Avatar" width="100" height="100">
        <p>You are logged in as <?php echo $_SESSION['role']; ?>.</p>
        <a href="logout.php?logout=true" class="btn btn-danger">Logout</a>
    </div>
<?php else: ?>
    <!-- Form Login -->
    <div class="form-container">
        <div id="login-form">
            <h2>Login</h2>
            <?php if (!empty($login_error)): ?>
                <div class="error-message"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
            <a href="#" class="toggle-link" onclick="toggleForms('signup')">Don't have an account? Sign Up</a>
        </div>

        <!-- Form Sign Up -->
        <div id="signup-form" style="display: none;">
            <h2>Sign Up</h2>
            <?php if (!empty($signup_error)): ?>
                <div class="error-message"><?php echo $signup_error; ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" name="signup">Sign Up</button>
            </form>
            <a href="#" class="toggle-link" onclick="toggleForms('login')">Already have an account? Login</a>
        </div>
    </div>
<?php endif; ?>

<script>
    function toggleForms(form) {
        const loginForm = document.getElementById('login-form');
        const signupForm = document.getElementById('signup-form');

        if (form === 'signup') {
            loginForm.style.display = 'none';
            signupForm.style.display = 'block';
        } else if (form === 'login') {
            loginForm.style.display = 'block';
            signupForm.style.display = 'none';
        }
    }
</script>

</body>
</html>

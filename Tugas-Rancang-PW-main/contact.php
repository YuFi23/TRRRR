<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <nav class="navbar">
        <div class="merk">EncS</div>
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-icon">&#9776;</label> 
        <ul class="nav-links">
            <li><a href="home.php">HOME</a></li>
            <li><a href="about.php">ABOUT US</a></li>
            <li><a href="contact.php">CONTACT US</a></li>
            <li><a href="Riwayat.php" class="active">RIWAYAT</a></li>
            <?php if (isset($_SESSION['email'])): ?>
    <li class="user-avatarr">
        <!-- Avatar yang dapat diklik -->
        <img src="img/<?php echo isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'avatar.png'; ?>" alt="Avatar" class="avatarr" id="avatar">
        

        <!-- Dropdown Menu -->
        <div class="dropdown-menu" id="dropdown-menu">
            <p class="user-name"><?php echo $_SESSION['username']; ?></p>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </li>
<?php else: ?>
    <li><a href="login.php">LOGIN</a></li>
<?php endif; ?>
        </ul>
    </nav> 
    <div class="container card-container section">
        <div class="card">
            
            <div class="avatar"><img src="img/yerky.jpg" alt="Avatar"></div>
            <a href="https://www.instagram.com/yerkyyy__/?hl=id" >
                <h2>Yerky</h2>
            </a>
            <p>672023186</p>
            
        </div>
        <div class="card">
            <a href="https://www.instagram.com/pradityaayf/?hl=id" class="ig">
            <div class="avatar"><img src="img/praditya.jpg" alt="Avatar"></div>
            <h2>Praditya</h2>
            <p>672023088</p>
            </a>
        </div>
        <div class="card">
            <a href="https://www.instagram.com/hanaprks/?hl=id" >
            <div class="avatar"><img src="img/hana.jpg" alt="Avatar"></div>
            <h2>Hana</h2>
            <p>672023004</p>
            </a>
        </div>
        <div class="card">
            <a href="https://www.instagram.com/mattia.frederika/?hl=id" class="ig">
            <div class="avatar"><img src="img/mattia.jpg" alt="Avatar"></div>
            <h2>Mattia</h2>
            <p>672023005</p>
            </a>
        </div>
    </div>
</body>
<script src="about.js"></script>
</html>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="about.css">
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
    <div class="container">
        <section class="about-section">
          <p>
            Encore Shield (EncS) is a website platform that allows users to buy concert tickets online
            easily, quickly and safely. Through Encore Shield, music fans can discover a variety of
            concerts from local to international artists, get complete information about events,
            including schedules, locations and ticket prices, and make reservations directly from the
            comfort of their home. With various attractive promotions and easy access, Encore Shield
            aims to be the main solution for music lovers who want to get concert tickets quickly and
            without hassle.
          </p>
          <p>
            Additionally, Encore Shield (Encs) provides responsive customer support services to
            assist users in the purchasing process. With the integration of the latest technology, this
            platform ensures optimal access speed, so users don't have to worry about running out of
            tickets for big events. Encore Shield also works with various promoters and venues to
            provide real-time information on ticket availability and reliable event details.
          </p>
        </section>
      </div>
</body>
<script src="about.js"></script>
</html>
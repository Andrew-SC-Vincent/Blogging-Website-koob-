<?php
    require_once('../../models/profile.php');
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koob</title>
    <link rel= "stylesheet" href="../../css/header.css">
    <link rel= "stylesheet" href="../../css/main.css">
    <!-- Search logo -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="../../js\main.js"></script>
    <!-- Raleway font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <a href="../home/home.php" id = "logo"><img src="../../img\white-logo.png" alt="koob logo" id="logo"></a>
        <nav>
            <ul>
                <li><a href="../home/home.php" class="navLink">Home</a></li>
            </ul>

                <form action="../../controllers/CommonController.php" class="search-bar" method="GET">
                    <span class="search-icon material-symbols-outlined">search</span>
                    <input type="search" name="search" id="search">
                    <input type="hidden" name="action" value="search">
                </form>
            
            <!-- This is where the ERROR occurs. -->
            <img src="../../img/profile/<?php echo(profileImageName($_SESSION['userID']))?>" alt="" class="user" id="nav-user" onclick="toggleSubMenu('submenu')">


            <!-- Drop down menu for user pro pic. -->
            <div class="submenu-container" id="submenu">
                <div class="submenu">
                    <div class="userinfo">
                        <a href="../profile/profile.php?userID=<?php echo($_SESSION['userID'])?>" id="sub-img-link"><img src="../../img/profile/<?php echo(profileImageName($_SESSION['userID']))?>" alt="" class="user" id="sub-user"></a>
                        <h1 id = "sub-username"><?php echo($_SESSION['username'])?></h1>
                    </div>
                    <hr>
                    <!-- Log out button -->
                    
                    <form action="../../controllers/CommonController.php" method="GET">
                        <input type="submit" value = "Log out" id="logout" class="sub-item">
                        <input type="hidden" value="logout" name="action">
                    </form>
                </div>
            </div>
        </nav>
    </header>


</body>
</html>
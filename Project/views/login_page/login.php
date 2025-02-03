<?php
    require('../../util/secure_conn.php');
    include 'create_account.php';
    require '../../util/helpers.php';

    //Redirects to home if log in was already made.
    if(isset($_SESSION['username'])){
        header("Location: ../home/home.php");
    }

    //Unsuccessful log in flag
    $login = getURLValue('login');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koob</title>
    <link rel="stylesheet" href="../../css/login.css">
    <script src="..\..\js\main.js"></script>
</head>

<body>
<?php if($error) echo("<script>displayPopup();</script>")?>
    <!-- LOG IN PAGE -->
    <div class = "container" id = "blur">
        <h1 id="welc">Dive into the world of books</h1>
        <form action="../../controllers/loginController.php" id ='lForm' method="POST">
        <img src="../../img\white-logo.png" alt="koob logo">
            <input type="text" name="username" placeholder="Username"  class="credentials">
            <input type="password" name="password" placeholder="Password"  class="credentials">
            <?php
            if(isset($login))
                echo("<p id='login-message' style='color:red'>Invalid username or password</p>")
            ?>
            <input type="submit" value="Log In" id="login" class="credentials">
            <input type="hidden" name="action" value="login">
            
            <button type = "button" class="credentials" id='create' onclick="displayPopup()">Create new account</button>
        </form>    
    </div>
</body>
</html>

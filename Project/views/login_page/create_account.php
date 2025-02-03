<?php 
    session_start();

    $error = false;
    //Displays pop up if errors exist
    if(isset($_SESSION['errors'])){
        $errors = $_SESSION['errors'];
        $values = $_SESSION['values'];
        $error = true;
        unset($_SESSION['errors']); // Clear session errors after displaying them
        unset($_SESSION['values']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koob</title>
    <link rel="stylesheet" href="../../css/create_form.css">
</head>
<body>
    
        <div class="popup" id="popup">

        <div id="hCtr">
            <div id="hdr">
                <h1 id="sih1">Sign up</h1>
                <p style = 'color:grey'>It couldn't be easier.</p>
            </div>
            <button id="cancel" onclick="removePopup()">X</button>
        </div>
            
            
    
    <form action="../../controllers/loginController.php" id="cForm" method="POST">
    <div class="cpl">
        <div class="input-error">
            <input type="text" name="fName" placeholder="First Name" class="cInput" value="<?php if(isset($values))echo $values['fName']?>">
            <?php if(isset($errors['fName'])): ?>
                <p class="error"><?php echo $errors['fName']; ?></p>
            <?php endif; ?>
        </div>
        <div class="input-error">
            <input type="text" name="lName" placeholder="Last Name" class="cInput" value="<?php if(isset($values))echo $values['lName']?>">
            <?php if(isset($errors['lName'])): ?>
                <div class="error"><?php echo $errors['lName']; ?></div>
            <?php endif; ?>
        </div>
    </div>
    
    <input type="email" name="email" placeholder="Email" class="cInput" value="<?php if(isset($values))echo $values['email']?>">
    <?php if(isset($errors['email'])): ?>
        <div class="error"><?php echo $errors['email']; ?></div>
    <?php endif; ?>
    
    <input type="text" name="username" placeholder="Username" class="cInput" value="<?php if(isset($values))echo $values['username']?>">
    <?php if(isset($errors['username'])): ?>
        <div class="error"><?php echo $errors['username']; ?></div>
    <?php endif; ?>
    
    <div class="cpl">
        <div class="input-error">
            <input type="password" name="password" placeholder="Password" class="cInput">
            <?php if(isset($errors['password'])): ?>
                <div class="error"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
        </div>
        <div class="input-error">
            <input type="password" name="cPassword" placeholder="Confirm Password" class="cInput">
            <?php if(isset($errors['cPassword'])): ?>
                <div class="error"><?php echo $errors['cPassword']; ?></div>
            <?php endif; ?>
        </div>
    </div>
    
    <input type="submit" value="Sign Up" name="signup" class="cInput" id="cSubmit">
    <input type="hidden" name="action" value="create_account">
</form>
</div>
</body>
</html>
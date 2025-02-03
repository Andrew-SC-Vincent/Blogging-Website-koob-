<?php 
    require('helpers.php');
    require('secure_conn.php');
    $errorMessage = getURLValue('errorMessage');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koob</title>
</head>
<body>
    <h1>DATABASE ERROR</h1> <br>
    <?php echo($errorMessage)?>
</body>
</html>


<style>
    body{
        background-color: rgb(236, 236, 236);
    }
</style>
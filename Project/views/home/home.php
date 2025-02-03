<?php 
    require('../../util/secure_conn.php');
    require('../../util/helpers.php');
    require("../../models/post.php");
    require("../common/header.php");

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    //Contains rows of posts in database
    $posts = selectPosts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koob</title>
    <link href="../../css\home.css" rel="stylesheet">
    <link href="../../css\posts.css" rel="stylesheet">
</head>
<body>
    <div id="container">
        <br>
        <div class="post-container">
            <form action="../../controllers/HomeController.php" method="GET">
                <textarea name="content" cols="30" rows="4" placeholder = "Share your ideas..." id="post-text"></textarea>
                <input type="submit" value="Post" name="post" id="submit-post">
                <input type="hidden" value="post" name="action">
            </form>
        </div>
        
        <!-- Displays posts -->
        <?php displayPosts($posts)?>
    </div>

    
</body>
</html>
<?php require("../common/footer.php")?>
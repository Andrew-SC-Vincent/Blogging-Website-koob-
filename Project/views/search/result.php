<?php 
    require('../../util/secure_conn.php');
    require("../../util/helpers.php");
    require("../common/header.php");
    require('../../models/post.php');
    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    //Gets value from search bar
    $search = getURLValue('search');

    //Gets profiles that match search
    $profiles = searchProfiles($search);

    //Gets posts that match search
    $posts = searchPosts($search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koob</title>
    <link href="../../css\posts.css" rel="stylesheet">
    <link href="../../css\search_result.css" rel="stylesheet">
</head>
<body>
    <div id="container">
        <h1 class="search-header">PROFILES</h1>
        <?php if(!$profiles):?>
            <p id="no-profile-p">No profiles found</p>
        <?php endif?>
        <?php foreach($profiles as $profile):?>
            
            <a href="../profile/profile.php?userID=<?php echo $profile['userID']; ?>" class="profile-bubble">
                
                    <img src="../../img/profile/<?php echo profileImageName($profile['userID']); ?>" alt="user profile" class='user' id="search-user-pro">
                    <div class="profile-info">
                        <h3 id="profile-username"><?php echo $profile['username']; ?></h3>
                        <p>(<?php echo $profile['fullName']; ?>)</p>
                    </div>
            </a>
        <?php endforeach?>

        <h1 class="search-header">POSTS</h1>
        <?php if(!$posts):?>
            <p id="no-profile-p">No posts found</p>
        <?php endif?>
        <?php displayPosts($posts)?>
    </div>
</body>
</html>
<?php require("../common/footer.php")?>
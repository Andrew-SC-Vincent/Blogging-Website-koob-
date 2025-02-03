<?php
    require('../../util/secure_conn.php');
    require("../../util/helpers.php");
    require_once('../../models/profile.php');
    require_once('../../models/post.php');
    require("../common/header.php");

    //Gets userID of user profile from URL
    $userID = getURLValue('userID');

    //Initializes error messaage
    $error = array();

    //Displays error message whenever error occurs
    if(isset($_SESSION['error'])){

        $error['cover'] = $_SESSION['error'];
        // Clear session errors after displaying them
        unset($_SESSION['error']); 
    }

    //Displays error message whenever error occurs
    if(isset($_SESSION['error'])){

        $error['profile'] = $_SESSION['error'];
        // Clear session errors after displaying them
        unset($_SESSION['error']); 
    }

    //Gets info for user profile
    $profile = getProfileInfo($userID);

    $posts = selectUserPosts($userID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koob</title>
    <link href="../../css/profile.css" rel="stylesheet">
    <link href="../../css\posts.css" rel="stylesheet">
    <script src = "../../js/main.js"></script>
</head>
<body>
    <img src="../../img/cover/<?php echo(coverImageName($userID))?>" alt="" id="cover-photo">
    <div class="cover-info">
        <div id="profile-info-container">
            <img src="../../img/profile/<?php echo(profileImageName($userID))?>" alt="user profile" class='user' id="profile-img">
            
            <h1> <?php echo($profile['username']) ?></h1>
            <h3 id="fullname">(<?php echo($profile['fullName'])?>)</h3>
        </div>
        
        <div id="btn-container">
            <div id="cover-btn-container">
                <!-- Display option only if userID is the same as logged in user -->
                <?php if($userID == $_SESSION['userID']  || $_SESSION['type'] == 'admin') :?>
                    <button onclick="toggleSubMenu('cover-img-container');changeCover()" class="button">Change Cover Photo</button>
                <?php endif?>
                <?php if(isset($error['cover'])) echo("<p style = 'color: red'>$error[cover]</p>");?>
                    <!-- Drop down for file upload form -->
                <div class="option-container" id="cover-img-container">
                    <form action="../../controllers/ProfileController.php" method="POST" class="menu-form" enctype="multipart/form-data">
                        <label for="cover" class="sub-item pro-sub-item">Choose Image</label>
                        <input type="file" id="cover" name="cover">
                        <p id="cover-name"></p>
                        <input type="submit" value="Change Cover" class="sub-item pro-sub-item" id="cover-item-submit">
                        <input type="hidden" value="changeCover" name="action">
                        <input type="hidden" value="<?php echo($userID)?>" name="userID">
                    </form>
            </div>
                <!-- End of drop menu -->
            </div>
            
            
        <div id="pro-btn-container">
            <?php if(isset($error['profile'])) echo("<p style = 'color: red'>$error[profile]</p>");?>
            <!-- Display option only if userID is the same as logged in user -->
            <?php if($userID == $_SESSION['userID']  || $_SESSION['type'] == 'admin') :?>
                <button onclick="toggleSubMenu('profile-img-container');changeProfile()" class="button">Change Profile Photo</button>
            <?php endif?>
            <!-- Drop down for file upload form -->
            <div class="option-container" id="profile-img-container">
                <div class="dropdown">
                    <form action="../../controllers/ProfileController.php" method="POST" class="menu-form" enctype="multipart/form-data">
                        <label for="profile" class="sub-item pro-sub-item">Choose Image</label>
                        <input type="file" id="profile" name="profile">
                        <p id="profile-name"></p>
                        <input type="submit" value="Change Profile" class="sub-item pro-sub-item" id="pro-item-submit">
                        <input type="hidden" value="changeProfile" name="action">
                        <input type="hidden" value="<?php echo($userID)?>" name="userID">
                    </form>
                </div>
            </div>
            <!-- End of drop menu -->
        </div>
            

        </div>
        
    </div>
    <div id="profile-body">
        <div id="profile-container">
            <div class="profile-info">
                <p class="info-heading">Contact</p>
                <p class = "info"><?php echo($profile['email'])?></p>
                <p class="info-heading">About</p>
                <div id = "bio-container">
                
                    <form id="bio-editor" method="POST" onsubmit="updateBio(event)">
                        <textarea name="bio" id="bio" cols="30" rows="8" placeholder="Tell us about yourself."><?php echo($profile['bio'])?></textarea>
                        <div id="bio-btn-container">
                            <button type="button" onclick="toggleBio()" class="button">Cancel</button> 
                            <input type="submit" value="Update Bio" class="button">
                            <input type="hidden" value = "<?php echo $userID?>" id="userID">
                        </div>
                    </form>
                
                </div>
                <p class="info" id="bio-display"><?php echo($profile['bio'])?></p>
                <!-- Displays button to edit bio -->
                <?php if($userID == $_SESSION['userID']  || $_SESSION['type'] == 'admin') :?>
                    <button onclick="toggleBio()" class="button" id="bio-btn">Update Bio</button>
                <?php endif?>
            </div>
            
            <?php if(!$posts):?>
                <p id="no-post-p">No posts found</p>
            <?php else:?>

            <!-- Posts made by the user -->
            <div id="profile-posts">
                <?php displayPosts($posts)?>
            </div>
            <?php endif?>
            

        </div>

    </div>
    
    
</body>
</html>

<?php require("../common/footer.php")?>
<?php

    require_once __DIR__ . "/../util/database.php";

    //Inserts post information into database 
    //whenever post is created.
    function insertPost($userID, $content){
        global $db;

        try{
            //Current date and time
            $currentTime = date("Y-m-d H:i:s");

            $query = $db->prepare("INSERT INTO post (userID, content, date) VALUES (:userID, :content, :date)");

            $query->bindParam(":userID", $userID);
            $query->bindParam(":content", $content);
            $query->bindParam(":date", $currentTime);

            $query->execute();
        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
        
    }

    //Selects the 10 most recent posts to display on home page.
    function selectPosts(){
        global $db;

        $query = $db->prepare("SELECT * from post INNER JOIN user ON post.userID = user.userID ORDER BY date desc LIMIT 30");

        $query->execute();

        $result = $query->fetchAll();

        return $result;
    }

//Selects specified post
    function selectPost($postID){

        try{
            global $db;

            $query = $db->prepare("SELECT * from post INNER JOIN user ON post.userID = user.userID WHERE postID = :postID");

            $query->bindParam(":postID", $postID);

            $query->execute();

            $result = $query->fetchAll();

            return $result;
        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    //Select all posts from a specific user
    function selectUserPosts($userID){

        try{
            global $db;

            $query = $db->prepare("SELECT * from post INNER JOIN user ON post.userID = user.userID WHERE user.userID = :userID");
    
            $query->bindParam(":userID", $userID);
    
            $query->execute();
    
            $result = $query->fetchAll();
    
            return $result;
        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
        
    }
    

    //Returns the number of comments for an specified post
    function countPostComments($postID){

        global $db;

        $query=$db->prepare("SELECT COUNT(*) FROM comment WHERE postID = :postID");
           
        $query->bindParam( ":postID", $postID);

        // Execute the query
        $query->execute();

        // Fetch the result
        $count = $query->fetchColumn();

        return $count;
    }


    //Calculates how long the post has been up
    function timeDifference($date){

        // Get the current time
        $currentTime = time();

        // Calculate the difference in seconds
        $difference = $currentTime - strtotime($date);

        // Convert the difference into seconds, minutes, hours, and days
        $days = floor($difference / (60 * 60 * 24));
        $hours = floor(($difference % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($difference % (60 * 60)) / 60);
        $seconds = $difference % 60;
        
       // Return the time passed
        if ($days > 0) {
            return $days . "d";
        } elseif ($hours > 0) {
            return $hours . "h";
        } elseif ($minutes > 0) {
            return $minutes . " m";
        } else {
            return $seconds . "s";
        }
    }

    //Removes specified post
    function removePost($postID){

        try{
            global $db;

            $query = $db->prepare("DELETE from post where postID = :postID");

            $query->bindParam(":postID", $postID);

            $query->execute();

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    // Insert content into post table
    function updatePost($content, $postID){
        global $db;

        try{
            $query = $db->prepare("UPDATE post SET content = :content WHERE postID = :postID");

            $query->bindParam(":postID", $postID);
            $query->bindParam(":content", $content);

            $query->execute();

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            return header("location: ../../util/error_page?errorMessage=$error_message");
        }
    }

    //Select all posts from a specific user
    function searchPosts($string){

        try{
            global $db;

            $query = $db->prepare("SELECT * from post INNER JOIN user ON post.userID = user.userID WHERE post.content LIKE :string OR user.username LIKE :string OR user.fName LIKE :string OR user.lName LIKE :string");
    
            $query->bindValue(":string", "%$string%");
    
            $query->execute();
    
            $result = $query->fetchAll();
    
            return $result;
        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }


     // Displays posts
    function displayPosts($posts) {
        foreach($posts as $post) {
            ?>
            <div class="post-container" id="post_<?php echo htmlspecialchars($post['postID'])?>"> <!-- Highlighted -->
                <div class="post-info">
                    <div class="post-user-info">
                        <a href="../../views/profile/profile.php?userID=<?php echo htmlspecialchars($post['userID'])?>" class="img-pro-link"><img src="../../img/profile/<?php echo htmlspecialchars(profileImageName($post['userID']))?>" alt="user profile" class='user' id="post-user-pro"></a>
                        <h3 class="post-name"><?php echo htmlspecialchars($post['username'])?></h3> <!-- Highlighted -->
                    </div>

                    <div class="post-controls">
                    <?php if($post['userID'] == $_SESSION['userID'] || $_SESSION['type'] == 'admin') : ?>
                        <!-- Edit button -->
                        <button onclick="toggleEditor('post',<?php echo htmlspecialchars($post['postID'])?>)" class="edit-btn">Edit</button> <!-- Highlighted -->

                        <!-- Delete button -->
                        <form action="../../controllers/PostController.php" method="GET">
                            <input type="submit" id="cancel" value="X" name="action"></input>
                            <input type="hidden" value="<?php echo htmlspecialchars($post['postID'])?>" name="postID"> <!-- Highlighted -->
                            <input type="hidden" value="<?php echo htmlspecialchars($post['userID'])?>" name="userID"> <!-- Highlighted -->
                            <input type="hidden" value="delete" name="action">
                        </form>
                    <?php endif?>
                    </div>
                </div>
                
                <p class="post-content" id="content_<?php echo htmlspecialchars($post['postID'])?>"><?php echo htmlspecialchars($post['content'])?></p> <!-- Highlighted -->

                <!-- Post editor -->
                <form class="post-form" id="post-editor-<?php echo htmlspecialchars($post['postID'])?>" method="POST" onsubmit="updateContent('post',<?php echo htmlspecialchars($post['postID'])?>, event)" >
                    <textarea name="edit-post-content" id="edit-post-content" cols="30" rows="4"><?php echo htmlspecialchars($post['content'])?></textarea> <!-- Highlighted -->
                        <div id="edit-btn-container">
                            <button type="button" onclick="toggleEditor('post',<?php echo htmlspecialchars($post['postID'])?>)" class="home-button" id="edit-button">Cancel</button> 
                            <input type="submit" value="Update Post" class="home-button" id="edit-button">
                        </div>
                </form>
                <!-- end of post editor -->

                <div class="post-extra">
                    <a href="../../views/posts/post.php?postID=<?php echo htmlspecialchars($post['postID'])?>" class="post-comments">View comments (<?php echo countPostComments($post['postID'])?>)</a> <!-- Highlighted -->
                    <p class="post-time"><?php echo timeDifference($post['date'])?></p>
                </div>
            </div>
            <?php
        }
    }
?>
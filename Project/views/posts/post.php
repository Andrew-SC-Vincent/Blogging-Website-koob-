<?php 
    require('../../util/secure_conn.php');
    require("../../util/helpers.php");
    require("../common/header.php");
    require("../../controllers/PostController.php");

    //Gets post ID from url
    $postID = getURLValue('postID');

    //Selects specified post based on ID.
    $post = selectPost($postID);

    //Gets comments based on postID.
    $comments = getComments($postID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koob</title>
    <link href="../../css\comment.css" rel="stylesheet">
    <link href="../../css\posts.css" rel="stylesheet">
    <!-- Submit comment button image -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="../../js\adjust-size.js" defer></script>
</head>
<body>
    <div id="container">
        <br>
        <?php displayPosts($post)?>
        

        <div class="comment-section">
            <form action="../../controllers/PostController.php" id="comment-form" method="GET">
                <textarea name="content" id = "commentText" cols="40" rows="3" class='comment-text' placeholder="Create a comment"></textarea>
                <label for="submit-button"><span class="material-symbols-outlined submit">send</span></label>
                <input type="submit" id="submit-button" name="submit">
                <input type="hidden" name="action" value="post-comment">
                <input type="hidden" value="<?php echo($postID)?>" name="postID">
            </form>

            <?php foreach($comments as $comment): ?>       
            <div class="comment-container" id="comment_<?php echo($comment['commentID'])?>">
                <div class="comment-info">
                    <a  href="../profile/profile.php?userID=<?php echo($comment['userID'])?>" class="img-pro-link"><img src="../../img/profile/<?php echo(profileImageName($comment['userID']))?>" alt="user profile" class='user'></a>
                    <p class="comment-name"><?php echo($comment['username'])?></p>
                </div>
                    
                <!-- Comment editor -->
                <form class="comment-form" id="comment-editor-<?php echo($comment['commentID'])?>" method="POST" onsubmit="updateContent('comment',<?php echo($comment['commentID'])?>, event)" >
                    <textarea name="edit-post-content" id="edit-post-content" cols="30" rows="10"><?php echo($comment['content'])?></textarea>
                        <div id="edit-btn-container">
                            <button type="button" onclick="toggleEditor('comment',<?php echo($comment['commentID'])?>)" class="home-button" id="comment-cancel">Cancel</button> 
                            <input type="submit" value="Update" class="home-button" id="comment-submit">
                        </div>
                </form>
                <!-- end of comment editor -->

                <p class="comment-content" id="content_<?php echo($comment['commentID'])?>"><?php echo($comment['content'])?></p>
                <div class="comment-extra">
                    <?php if($comment['userID'] == $_SESSION['userID']  || $_SESSION['type'] == 'admin'):?>
                        <div id="btn-container">
                            <button onclick="toggleEditor('comment', <?php echo($comment['commentID'])?>)" class="edit-btn">Edit</button>
                                <!-- Delete button -->
                        <form action="../../controllers/PostController.php" method="GET" id="cancel-form">
                            <input type="submit" id="cancel" value="X" name="action"></input>
                            <input type="hidden" value="<?php echo($comment['commentID'])?>" name="commentID">
                            <input type="hidden" value="<?php echo($postID)?>" name="postID">
                            <input type="hidden" value="deleteComment" name="action">
                        </form>
                        </div>
                    <?php endif?>
                    <p class="post-time"><?php echo(timeDifference($comment['date']))?></p>
                </div>      
            </div>
            <?php endforeach?>
        </div>
    </div>
   

</body>
</html>
<?php require("../common/footer.php")?>
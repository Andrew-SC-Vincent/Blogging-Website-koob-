<!-- 
PostController.php

Controller for the post.php view. This allows users
to generate comments, delete them, and delete the entire post.

CommonController.php currently still handles the updating of 
posts and comments.
-->

<?php 
    require(__DIR__ . "/../models/post.php");
    require(__DIR__ . "/../models/comment.php");

    //Starts session
    session_start(); 

     //Gets action specified from form.
    $action = filter_input(INPUT_GET, "action");

    switch($action){
        //Takes input from user and
        //insert a comment in the appropriate 
        //post within the database.
        case "post-comment":
            //Takes input from user.
            $content = filter_input(INPUT_GET, "content");
            //Gets id of the post.
            $postID = filter_input(INPUT_GET, "postID");
            //Inserts comment into the database.
            insertComment($_SESSION['userID'],  $postID, $content);
            //Refreshes the page.
            header("location: ../views/posts/post.php?postID=$postID");
            break;
        //Deletes comment when delete button is clicked.
        case "deleteComment":
            //Gets comment ID.
            $commentID = filter_input(INPUT_GET, 'commentID');
            //Gets post ID.
            $postID = filter_input(INPUT_GET, "postID");
            //Removes comment from the database.
            removeComment($commentID);
            //Refreshes the page.
            header("location: ../views/posts/post.php?postID=$postID");
            break;
        //Deletes entire post along with comments.
        case "delete":
            //Gets post id.
            $postID = filter_input(INPUT_GET, 'postID');
            //Removes post.
            removePost($postID);
            //Redirects to home page.
            header("location: ../views/home/home.php");
            break;
    }

?>
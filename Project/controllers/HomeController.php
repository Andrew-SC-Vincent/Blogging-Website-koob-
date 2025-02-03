<!-- 
HomeController.php

Controller for home.php view that controls
the users ability to post, delete, and edit posts.
-->

<?php 
    require("../models/post.php");
    
    //Starts session.
    session_start(); 

    //Gets action specified from form.
    $action = filter_input(INPUT_GET, "action");

    switch($action){

        //If post button is clicked in post form
        //inserts a new post labeled with the current
        //logged in user.
        case "post":
            //Gets post content form form.
            $content = filter_input(INPUT_GET, "content");
            //Inserts post into database.
            insertPost($_SESSION['userID'],  $content);
            //Redireects to home page.
            header("location: ../views/home/home.php");
            break;
        //Deletes post if delete button is clicked
        //on post.
        case "delete":
            //Gets id of post to be deleted.
            $postID = filter_input(INPUT_GET, 'postID');
            //Removes post from the database.
            removePost($postID);
            
            //Refreshes the page.
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;

            break;
        //Sends user to post.php
        //which allows them to edit the post.
        case "edit":
            //Gets post ID
            $postID = filter_input(INPUT_GET, 'postID');
            header("location: ../views/posts/post.php?postID=$postID");
            break;
    }

?>
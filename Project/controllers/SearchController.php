<!-- 
SearchController.php

Simple controller that currently only allows user
to remove posts from the result.php view.
-->

<?php 
    require("../models/post.php");

    //Starts session.
    session_start();

     //Gets action specified from form.
    $action = filter_input(INPUT_GET, "action");

    switch($action){

        //Allows user to delete post.
        case "delete":
            //Gets post ID
            $postID = filter_input(INPUT_GET, 'postID');
            //Removes post from database.
            removePost($postID);
            //Refreshes page.
            header("location: ../views/search/result.php");
            break;
    }

?>
<!-- 
CommonController.php

Controller that has functionality that is common to multiple
views in the site. This mainly includes the search feature,
logging out, and updating posts/comments.
-->

<?php 
    require("../models/post.php");
    require("../models/comment.php");
    
    //Starts session
    session_start(); 

    //Takes action from specified form.
    if(isset($_POST['action'])){
        $action = filter_input(INPUT_POST, "action");
    } else{
        $action = filter_input(INPUT_GET, "action");
    }

    switch($action){
        //If user uses search bar,
        //takes content and brings them to result page
        //with users that match their search.
        case "search":
            $content = filter_input(INPUT_GET, "search");
            header("location: ../views/search/result.php?search=$content");
            break;
        case "logout":
            //Delete session and cookie for the client and server
            $_SESSION = array();
            $params = session_get_cookie_params();
            setCookie(session_name(), '', strtotime('-100 year'), $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            session_destroy();
        
            //Redirect to log in page
            header("Location: ../views/login_page/login.php");
            break;
        //If edits have been made to a post,
        //updates the database.
        case "updatepost":
            $content = filter_input(INPUT_POST, "content");
            $postID = filter_input(INPUT_POST, "ID");
            updatePost($content, $postID);
            break;
        //If edits have been made to a comment,
        //updates the database.
        case "updatecomment":
            $content = filter_input(INPUT_POST, "content");
            $commentID = filter_input(INPUT_POST, "ID");
            updateComment($content, $commentID);
            break;
    }   
?>
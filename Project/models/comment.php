<?php
    require_once __DIR__ . "/../util/database.php";

    //Insert comment into a post
    function insertComment($userID, $postID, $content){

        try{
            global $db;

            //Current date and time
            $currentTime = date("Y-m-d H:i:s");

            $query = $db->prepare("INSERT INTO comment (userID, postID, content, date) VALUES (:userID, :postID, :content, :date)");

            $query->bindParam(":userID", $userID);
            $query->bindParam(":content", $content);
            $query->bindParam(":postID", $postID);
            $query->bindParam(":date", $currentTime);

            $query->execute();
        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    //Gets comments for a specific post
    function getComments($postID){

        global $db;
        
        //May need to add more to select
        $query = $db->prepare("SELECT comment.commentID, comment.content, user.username, user.userID, comment.date from comment INNER JOIN post ON post.postID = comment.postID INNER JOIN user ON user.userID = comment.userID WHERE comment.postID = :postID ORDER BY comment.date DESC");

        $query->bindParam(":postID", $postID);

        $query->execute();

        $result = $query->fetchAll();

        return $result;
    }



    // Insert content into post table
    function updateComment($content, $commentID){

        global $db;
        try{
            $query = $db->prepare("UPDATE comment SET content = :content WHERE commentID = :commentID");

            $query->bindParam(":commentID", $commentID);
            $query->bindParam(":content", $content);

            $query->execute();

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    // Remove comment
    function removeComment($commentID){

        global $db;
        try{
            $query = $db->prepare("DELETE FROM comment WHERE commentID = :commentID");

            $query->bindParam(":commentID", $commentID);

            $query->execute();

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }
?>
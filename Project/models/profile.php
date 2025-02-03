<?php

    require_once __DIR__ . "/../util/database.php";


    // Insert bio into user table
    function insertBio($bio, $userID){
        global $db;

        try{
            $bio = htmlspecialchars($bio, ENT_QUOTES, 'UTF-8'); // Prevent XSS before storingv
            $query = $db->prepare("UPDATE user SET bio = :bio WHERE userID = :userID");

            $query->bindParam(":userID", $userID);
            $query->bindParam(":bio", $bio);

            $query->execute();

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    //Retrieves information that is important for the users profile
    function getProfileInfo($userID){

        global $db;

        $query = $db->prepare("Select CONCAT(fName, ' ', lName) AS fullName, username, email, bio FROM user WHERE :userID = userID");

        $query->bindParam(":userID", $userID);

        $query->execute();

        $result = $query->fetch();
        
        return $result;
    } 

    //Searches for profiles.
    //Used in the result.php view
    //so users can search for profiles
    //and posts.
    function searchProfiles($string){

        try{
            global $db;

            $query = $db->prepare("SELECT CONCAT(fName, ' ', lName) as fullName, userID, username FROM USER WHERE username LIKE :string OR fName LIKE :string OR lName LIKE :string");

            $query->bindValue(":string", "%$string%");

            $query->execute();

            $result = $query->fetchAll();
            
            return $result;

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    //----FUNCTIONS TO ACCESS IMG NAME FROM DATABASE----

    //get current profile image name
    function profileImageName($userID){
        try{
            global $db;

            $query = $db->prepare("SELECT profile_img from user WHERE userID = :userID");
    
            $query->bindValue(":userID", $userID);
    
            $query->execute();
    
            $result = $query->fetchColumn();
    
            return htmlspecialchars($result, ENT_QUOTES, 'UTF-8'); // Prevent XSS on output

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    //Insert new img name into user
    function changeProfileImage($imgName, $userID){
        try{
            global $db;

            $imgName = htmlspecialchars($imgName, ENT_QUOTES, 'UTF-8'); // Prevent XSS before storing
            $query = $db->prepare("UPDATE user SET profile_img = :imgName WHERE userID = :userID");
    
            $query->bindValue(":userID", $userID);

            $query->bindValue(":imgName", $imgName);
    
            $query->execute();

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    //get current profile image name
    function coverImageName($userID){
        try{
            global $db;

            $query = $db->prepare("SELECT cover_img from user WHERE userID = :userID");
    
            $query->bindValue(":userID", $userID);
    
            $query->execute();
    
            $result = $query->fetchColumn();
    
            return htmlspecialchars($result, ENT_QUOTES, 'UTF-8'); // Prevent XSS on output

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }

    //Insert new img name into user
    function changeCoverImage($imgName, $userID){
        try{
            global $db;

            $imgName = htmlspecialchars($imgName, ENT_QUOTES, 'UTF-8'); // Prevent XSS before storing
            $query = $db->prepare("UPDATE user SET cover_img = :imgName WHERE userID = :userID");
    
            $query->bindValue(":userID", $userID);

            $query->bindValue(":imgName", $imgName);
    
            $query->execute();

        }catch(PDOException $e){
            $error_message = $e->getMessage();
            displayDatabaseErrorPage($error_message);
        }
    }



?>
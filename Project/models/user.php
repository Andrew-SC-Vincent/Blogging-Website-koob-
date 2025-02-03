<?php
    require_once __DIR__ . "/../util/database.php";

    function checkUserCredentials($username, $password) {
        try {
            global $db;
            
            // Fetch the hashed password for the given username
            $query = $db->prepare("SELECT password FROM user WHERE username = :username");
            $query->bindParam(":username", $username);
            $query->execute();
    
            //Gets hashed password.
            $hashedPassword = $query->fetchColumn();
    
            // Verify the entered password against the hashed password
            return $hashedPassword && password_verify($password, $hashedPassword);
    
        } catch (PDOException $e) {
            displayDatabaseErrorPage($e->getMessage());
        }
    }

    function checkAdminCredentials($username, $password) {
        try {
            global $db;
            
            // Fetch the hashed password for the given username and check if the user is an admin
            $query = $db->prepare("SELECT password FROM user WHERE username = :username AND type = 'admin'");
            $query->bindParam(":username", $username);
            $query->execute();
    
            // Fetch the hashed password
            $hashedPassword = $query->fetchColumn();
    
            // If no password was found, return false
            if ($hashedPassword === false) {
                return false;
            }
    
            // Verify the entered password against the hashed password
            return password_verify($password, $hashedPassword);
    
        } catch (PDOException $e) {
            displayDatabaseErrorPage($e->getMessage());
        }
    }

    //Check if username exists
    function checkUsername($username){
        global $db;

        try{
            $query = $db->prepare("SELECT username from USER WHERE username = :username");

            $query->bindParam(":username", $username);

            $query->execute();

            $count = $query->fetchColumn();

            //Check if any columns exist with the credentials provides.
            if($count > 0){
                return true;   
            } else{
                return false;
            }
        }catch(PDOException $e){
            $e->getMessage();
        }

    }

    //Check if email exists
    function checkEmail($email){
        global $db;

        try{
            $query = $db->prepare("SELECT email from USER WHERE email = :email");

            $query->bindParam(":email", $email);

            $query->execute();

            $count = $query->fetchColumn();

            //Check if any columns exist with the credentials provides.
            if($count > 0){
                return true;   
            } else{
                return false;
            }
        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    // Creates user account
    function createAccount($fName, $lName, $username, $password, $email){
        global $db;

        //Hashes password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepares statement to add user to user table
        $query = $db->prepare("INSERT INTO user (fName, lName, username, password, email) VALUES (:fName, :lName, :username, :password, :email)");

        // Binds parameters
        $query->bindParam(':fName', $fName);
        $query->bindParam(':lName', $lName);
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $hashedPassword);
        $query->bindParam(':email', $email);

        // Executes and adds user to database
        $query->execute();
    }

     //Displays error message (PROBABLY ADJUST)
     function displayDatabaseErrorPage($errorMessage) {
        header("location: ../../util/error_page.php?errorMessage=$errorMessage");
        exit();
    }

    //Gets user information based on the username submitted.
    //--Used in log in form--
    function getUserInfo($username){
        global $db;

        $query = $db->prepare("Select userID, fName, lName, username, type FROM user WHERE username = :username");

        $query->bindParam(":username", $username);

        $query->execute();

        $result = $query->fetch();
        
        return $result;
    }

?>
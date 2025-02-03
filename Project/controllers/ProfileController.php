<!-- 
ProfileController.php

Controller for the profile.php view.

Allows user to change their profile and cover photo, update their bio,
and delete posts.
-->

<?php 
    require("../models/post.php");
    require("../models/profile.php");

    //Starts session
    session_start(); 

    //Takes action from specified form.
    if(isset($_POST['action'])){
        $action = filter_input(INPUT_POST, "action");
    } else{
        $action = filter_input(INPUT_GET, "action");
    }

    switch($action){

        //Changes cover photo
        case 'changeCover':
            //Gets user ID
            $userID = filter_input(INPUT_POST, "userID");
            //Gets current cover image name from database.
            $currentFile = coverImageName($_SESSION['userID']);

            //Information on file being uploaded
            $file = $_FILES['cover'];

            $fileName = $_FILES['cover']['name'];
            $fileTmpName = $_FILES['cover']['tmp_name'];
            $fileSize = $_FILES['cover']['size'];
            $fileError = $_FILES['cover']['error'];
            $fileType = $_FILES['cover']['type'];

            $fileExt = explode('.', $fileName);

            $fileActualExt = strtolower(end($fileExt));
            
            //File extensions allowed
            $allowed = array('jpg', 'jpeg', 'png');
    
            //Checks if the file extension is valid
            if(in_array($fileActualExt, $allowed)){
                //Checks for error
                if($fileError === 0){
                    //Creates unique ID and appends proper extension
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                    //Delete current cover photo IF it is not the default
                    if($currentFile != "default.jpg"){
                        unlink("../img/cover/" . $currentFile);
                    }
                        
                    //Update database to include file name + extension
                    changeCoverImage($fileNameNew, $userID);

                    //Final destination of the image
                    $fileDestination = "../img/cover/$fileNameNew";

                    //Upload the file
                    move_uploaded_file($fileTmpName, $fileDestination);
    
                    header("location: ../views/profile/profile.php?userID=$userID");
                }else{
                    $_SESSION['error'] = "Error uploading file.";
                    header("location: ../views/profile/profile.php?userID=$userID");
                }
            }else{
                $_SESSION['error'] = "Invalid file type.";
                header("location: ../views/profile/profile.php?userID=$userID");
            }
            break;
        //Changes profile photo
        case 'changeProfile':

            //Gets user ID of currently logged in user.
            $userID = filter_input(INPUT_POST, "userID");
            //Gets profile image name.
            $currentFile = profileImageName($userID);

            //Information on file being uploaded
            $file = $_FILES['profile'];

            $fileName = $_FILES['profile']['name'];
            $fileTmpName = $_FILES['profile']['tmp_name'];
            $fileSize = $_FILES['profile']['size'];
            $fileError = $_FILES['profile']['error'];
            $fileType = $_FILES['profile']['type'];

            $fileExt = explode('.', $fileName);

            $fileActualExt = strtolower(end($fileExt));
            
            //File extensions allowed
            $allowed = array('jpg', 'jpeg', 'png');

            //Checks if the file extension is valid
            if(in_array($fileActualExt, $allowed)){
                //Checks for error
                if($fileError === 0){
                    //Creates unique ID and appends proper extension
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                    //Delete current profile photo IF it is not the default
                    if($currentFile != "default.png"){
                        unlink("../img/profile/" . $currentFile);
                    }
                   
                        
                    //Update database to include file name + extension
                    changeProfileImage($fileNameNew, $userID);

                    //Final destination of the image
                    $fileDestination = "../img/profile/$fileNameNew";

                    //Upload the file
                    move_uploaded_file($fileTmpName, $fileDestination);

                    header("location: ../views/profile/profile.php?userID=$userID");
                }else{
                    $_SESSION['error'] = "Error uploading file.";
                    header("location: ../views/profile/profile.php?userID=$userID");
                }
            }else{
                $_SESSION['error'] = "Invalid file type.";
                header("location: ../views/profile/profile.php?userID=$userID");
            }
            break;
            //Updates user BIO
            case "updateBio":
                //Gets content from user.
                $bio = filter_input(INPUT_POST, "bio");
                //Gets userID.
                $userID = filter_input(INPUT_POST, "userID");
                
                //Inserts bio into the database.
                insertBio($bio, $userID);
                //Refreshes page with updated bio.
                header("location: ../views/profile/profile.php?userID=$userID");
                break;
            //Deletes post in profile
            case "delete":
                //Gets post id.
                $postID = filter_input(INPUT_GET, 'postID');
                //Gets user id.
                $userID = filter_input(INPUT_GET, "userID");
                //Removes post.
                removePost($postID);
                //refreshes page.
                header("location: ../views/profile/profile.php?userID=$userID");
                break;
        }

?>
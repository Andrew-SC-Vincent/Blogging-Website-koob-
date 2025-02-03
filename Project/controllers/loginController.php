<!-- 
LoginController.php

Controller for the login_page that handles logging in
as well as creating accounts.
-->

<?php
    require("../models/user.php");
    require("../util/helpers.php");

    //Create session
    $lifetime = strtotime('+10 years');

    session_set_cookie_params($lifetime);

    session_start();

    //Gets action specified from form.
    $action = filter_input(INPUT_POST, 'action');

    switch($action){

        //If log in attempt is made
        case 'login':
            //Gets username and password from login form.
            $username = filter_input(INPUT_POST, "username");
            $password = filter_input(INPUT_POST, "password");

            //Checks for match in database.
            if(checkUserCredentials($username, $password)){

                //Gets information from user
                $user = getUserInfo($username);

                //Stores user information in the global variable $_SESSION
                $_SESSION['username'] = $username;
                $_SESSION['fName'] = $user['fName'];
                $_SESSION['lName'] = $user['lName'];
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['type'] = $user['type'];
                
                //Redirect to home page.
                header("Location: ../views/home/home.php");

            //Checks for match in database for admin
            } else if(checkAdminCredentials($username, $password)){
                //Gets information from user
                $user = getUserInfo($username);

                //Stores user information in the global variable $_SESSION
                $_SESSION['username'] = $username;
                $_SESSION['fName'] = $user['fName'];
                $_SESSION['lName'] = $user['lName'];
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['type'] = $user['type'];
                

                //success: redirect to admin home page.
                header("Location: ../views/home/home.php");
            } else{
                header("Location: ../views/login_page/login.php?login=false");
            }
            break;
        //Creates account
        // - Accessed from create account form
        // - in create_account.php
        case 'create_account':
            //Gets input from create account form
            $username = caseFormat(filter_input(INPUT_POST, "username"));
            $fName = caseFormat(filter_input(INPUT_POST, "fName"));
            $lName = caseFormat(filter_input(INPUT_POST, "lName"));
            $password = filter_input(INPUT_POST, "password");
            $cPassword = filter_input(INPUT_POST, "cPassword");
            $email = caseFormat(filter_input(INPUT_POST, "email"));

            // Initialize an array to store validation errors
            $errors = array();
            // Initialize an array to store input values
            $values = array();

            //Populates input value array
            $values['username'] = $username;
            $values['fName'] = $fName;
            $values['lName'] = $lName;
            $values['email'] = $email;
    


            // Validate username
            if (empty($username)) {
                $errors['username'] = "Username is required";
            } else if (!preg_match("/^[a-zA-Z0-9_]{4,20}$/", $username)) {
                $errors['username'] = "Username must be alphanumeric and between 4 to 20 characters";
            } else if(checkUsername($username)){
                $errors['username'] = "Username is already taken";
            }


            // Validate first name
            if (empty($fName)) {
                $errors['fName'] = "First name is required";
            } elseif (!preg_match("/^[a-zA-Z]+$/", $fName)) {
                $errors['fName'] = "First name must contain only alphabetic characters";
            }

            // Validate last name
            if (empty($fName)) {
                $errors['lName'] = "Last name is required";
            } elseif (!preg_match("/^[a-zA-Z]+$/", $lName)) {
                $errors['lName'] = "Last name must contain only alphabetic characters";
            }

            // Validate password
            if (empty($password)) {
                $errors['password'] = "Password is required";
            } elseif (strlen($password) < 8) {
                $errors['password'] = "Password must be at least 8 characters long";
            } elseif($password != $cPassword){
                $errors['password'] = "Passwords do not match";
            }

            // Validate email
            if (empty($email)) {
                $errors['email'] = "Email is required";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format";
            } elseif(checkEmail($email)){
                $errors['email'] = "Email already in use";
            }

            // Check if there are any errors
            if (count($errors) > 0) {
                // Handle validation errors, such as displaying error messages or redirecting back to the form with error messages
                $_SESSION['errors'] = $errors;

                $_SESSION['values'] = $values;

                header("location: ../views/login_page/login.php");
            } else { // If no errors exist, create the account.

                //Takes user information and inputs it into database as a
                //new user.
                createAccount($fName, $lName, $username, $password, $email);

                //Gets information from user
                $user = getUserInfo($username);

                //Stores user information in the global variable $_SESSION
                $_SESSION['username'] = $username;
                $_SESSION['fName'] = $user['fName'];
                $_SESSION['lName'] = $user['lName'];
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['type'] = $user['type'];

                //Redirects to home page
                //logged in as the new user.
                header("Location: ../views/home/home.php");
            } 
            break;
    }
?>
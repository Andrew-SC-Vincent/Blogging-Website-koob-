<?php
    require("database.php");

    //Gets value passed through the url.
    function getURLValue($parameterName) {
        // Check if the parameter exists in the URL
        if (isset($_GET[$parameterName])) {
            // Return the value of the parameter
            return $_GET[$parameterName];
        } else {
            return null;
        }
    }

    //Formats string to capitalize first letter and undercase for the remainder
    function caseFormat($str) {
        // Convert the first character to uppercase and the rest to lowercase
        $str = ucfirst(strtolower($str));
        return $str;
    }


    //Helper function for PHP to display on console.
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
    
?>
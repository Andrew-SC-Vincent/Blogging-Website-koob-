<?php
    // make sure the page uses a secure connection
    $https = filter_input(INPUT_SERVER, 'HTTPS');
    if (!$https) {
        $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
        $uri = $_SERVER['REQUEST_URI'];
        $url = 'https://' . $host . $uri;

        echo($host . " " . $uri);
        header("Location: " . $url);
        exit();
    }
?>
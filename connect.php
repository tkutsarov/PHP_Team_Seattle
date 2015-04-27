<?php
    $server = 'localhost';
    $dbUsername = 'codestor';
    $dbPassword = 'wIKb+)6n8RbD';
    $database = 'codestor_forum_test';
    $conn = new mysqli($server, $dbUsername, $dbPassword, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
?>
<?php

    $server = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $database = 'softuni_forum';

    $conn = new mysqli($server, $dbUsername, $dbPassword, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

?>


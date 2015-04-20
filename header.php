<?php   
    session_start();   
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PHP-MySQL forum</title>
    <link rel="stylesheet" href="style/main.css" type="text/css">
</head>
<body>
<h1>My forum</h1>
    <div id="wrapper">
        <div id="menu">
            <a class="item" href="index.php">Home</a> -
            <a class="item" href="/forum/create_topic.php">Create a topic</a> -
            <a class="item" href="/forum/create_cat.php">Create a category</a> 
            <div id="userbar">    
                
                <?php
                if(!isset($_SESSION['logged_in'])){
                     echo '<a href="login.php" class="item">Log in</a>    '
                . '<a href="register.php" class="item">Register</a>';
                } else {
                     echo 'user: ' . $_SESSION['user_name'] . '. '
                             . ' <a href="logout.php">Log out</a>';
                }
                   
                ?>
            </div>
         </div>
    <div id="content">
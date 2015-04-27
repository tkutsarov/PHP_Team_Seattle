<?php
    session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PHP-MySQL forum</title>
    <link rel="stylesheet" href="./style/main.css" type="text/css">
    <link rel="stylesheet" href="./style/create_topic.css" type="text/css">
    <link rel="stylesheet" href="./style/search.css" type="text/css"/>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
</head>
<body>
    <div id="wrapper">
        <header id="logo"></header>

        <nav id="menu">
            <ul>
            <li><a class="item" href="index.php">Home</a></li>
            <li><a class="item" id="create-topic" href="create_topic.php">Create a topic</a></li>
            <li><a class="item" href="create_category.php">Create a category</a></li>
                <?php
                if(!isset($_SESSION['logged_in'])){
                     echo '<li><a href="login.php" class="item">Log in</a></li> ' . ' <li><a href="register.php" class="item">Register</a></li>';
                } else {
                    echo '<li><span id="username-login">User: ' . $_SESSION['user_name'] . '</span> ' . '<a href="logout.php" class="item">Log out</a></li>';
                }
                   
                ?>
            </ul>
        </nav>
        <main id="content">
<?php include 'search_form.php' ?>
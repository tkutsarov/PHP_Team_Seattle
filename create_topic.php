<?php

include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo '<form method="post">
        <h3>Create a new topic</h3><br />
        Category name: <input type="text" name="cat_name" /><br />
        Topic: <br />
         <textarea name="cat_description" /></textarea><br />
        <input type="submit" value="Create topic" />
        </form>';
}


include 'footer.php';
?>
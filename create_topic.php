<?php

include 'connect.php';
include 'header.php';

echo "Create new forum topic.";

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo '<form method="post">
        Category name: <input type="text" name="cat_name" /><br />
        Category description:<br />
         <textarea name="cat_description" /></textarea>
        <input type="submit" value="Add category" />
        </form>';
}


include 'footer.php';
?>
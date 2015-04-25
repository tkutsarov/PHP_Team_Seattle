<?php

include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST') : ?>
    <?php //var_dump($_SERVER); ?>
    <?php //var_dump($_SESSION); ?>
    <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) : ?>
        <form method="post">
            <label for="name">Category name: </label><input type="text" name="cat_name" id="name"/>
            <label for="name">Category description: </label><input name="cat_description" />
            <input type="submit" value="Create category" class="sub-btn"/>
        </form>
    <?php else : ?>
        <?php if(!isset($_SESSION['is_admin'])) : ?>
            <div id="result">
                <p>You are not logged in.Please log in and try again.</p>
                <p>You cannot create a new forum category.</p>
            </div>
        <?php else : ?>
            <div id="result">
                <p>You are not an Administrator.</p>
                <p>You cannot create a new forum category.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php else : ?>
    <?php $cat_name = addslashes(htmlentities(trim($_POST['cat_name'])));
    $cat_desc = addslashes(htmlentities(trim($_POST['cat_description'])));
    $conn->query("SET NAMES utf8");
    $conn->query("SET COLLATION_CONNECTION=utf8_bin");
    $sql = "INSERT INTO categories(cat_name, cat_description) VALUES ('$cat_name', '$cat_desc')";
    //var_dump($sql);
    ?>
    <?php if($conn->query($sql) === TRUE): ?>
        <div id="result">
            <p>Category has been successfully created.</p>
        </div>
    <?php else : ?>
        <div id="result">
            <p>Error: <?php echo $conn->error;?></p>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php
include 'categories_view.php';
include 'footer.php';

?>
<?php
include 'header.php';
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') : ?>
    <?php //var_dump($_SERVER); ?>
    <?php //var_dump($_SESSION); ?>
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) : ?>
        <form method="post">
            <label for="name">Category name: <span class="red"><sup>*</sup></span></label><input type="text"
                                                                                                 name="cat_name"
                                                                                                 id="name"/>
            <label for="cat_desc">Category description: <span class="red"><sup>*</sup></span></label><input
                name="cat_description" id="cat_desc"/>
            <input type="submit" value="Create category" class="sub-btn"/>
        </form>
    <?php else : ?>
        <?php if (!isset($_SESSION['is_admin'])) : ?>
            <div id="result">
                <p>You cannot create a new forum category.</p>

                <p>You are not logged in. Please <a href="login.php">login</a> and try again.</p>
            </div>
        <?php else : ?>
            <div id="result">
                <p>You are not an Administrator.</p>

                <p>You cannot create a new forum category.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php else : ?>
    <?php $cat_name = mysqli_real_escape_string($conn, (trim($_POST['cat_name'])));
    $cat_desc = mysqli_real_escape_string($conn, (trim($_POST['cat_description'])));
    if (strlen($cat_name) == 0) : ?>
        <div id="result">
            <p>Category name cannot be empty. Please try again - <a href="create_category.php">Create a category</a>.</p>
        </div>
    <?php elseif (strlen($cat_desc) == 0) : ?>
        <div id="result">
            <p>Category description cannot be empty. Please try again - <a href="create_category.php">Create a category</a>.</p>
        </div>
    <?php else : ?>
        <?php $conn->query("SET NAMES utf8");
        $conn->query("SET COLLATION_CONNECTION=utf8_bin");
        $sql = "INSERT INTO categories(cat_name, cat_description) VALUES ('$cat_name', '$cat_desc')";
        //var_dump($sql);
        if ($conn->query($sql) === TRUE): ?>
            <div id="result">
                <p>Category has been successfully created.</p>
            </div>
        <?php else : ?>
            <div id="result">
                <p>Error: <?php echo $conn->error; ?></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php
include 'categories_view.php';
include 'footer.php';

?>
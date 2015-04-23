<?php

include 'connect.php';
include 'header.php';

if (!isset($_SESSION['signed_in'])) {

    //TODO A guest user must be able to write too.
    echo '<p>You must <a href="login.php">login</a> to create topic</p>';
} else {
    echo "<h2>Create new topic<h2>";
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {

        $sql = "SELECT id, cat_name, cat_description FROM categories";
        $result = $conn->query($sql);

        if (!$result) {
            echo "<p>A database problem occurred. Please try again!</p>";
        } else {
            if ($result->num_rows > 0) {
                echo '<form method="post" action="" xmlns="http://www.w3.org/1999/html">
                <div>
                    <label for="topic_subject">Subject: </label><input type="text" name="topic_subject" id="topic_subject" maxlength="100"/>
                </div>
                <div>
                    <label for="cat_selector">Select category: </label>
                    <select name="cat_selector" id="cat_selector" />';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                }

                echo '</select></div>
                <div>
                    <label for="topic_content">Theme: </label><textarea type="text" name="topic_content" id="topic_content" maxlength="2048"></textarea>
                </div>
                <div class="tags">
                    <label for="topic_tags">Tags: </label><input type="text" name="topic_tags" id="topic_tags" maxlength="50"/>
                </div>
                <input type="submit" value="Create topic" class="sub-btn">
            </form>';

            } else {
                echo "<p>Category not found.</p>";
            }
        }
    } else {
        //TODO
    }


}


include 'footer.php';
?>
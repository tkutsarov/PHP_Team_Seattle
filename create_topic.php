<?php

include 'connect.php';
include 'header.php';


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {


    //TODO A guest user must be able to write too.
    echo '<p>You must <a href="login.php">login</a> to create topic</p>';
    
} else {

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {

            $sql = "SELECT id, cat_name, cat_description FROM categories";
            $result = $conn->query($sql);

            if (!$result) {
                echo "<p>A database problem occurred. Please try again!</p>";
            } else {
                if ($result->num_rows > 0) {
                    echo "<h2>Create new topic<h2>";
                    echo '<form method="post"  >
                <div>
                    <label for="topic_subject">Subject: </label><input type="text" name="topic_subject" id="topic_subject" maxlength="100"/>
                </div>
                <div>
                    <label for="cat_selector">Select category: </label>
                    <select name="cat_selector" id="cat_selector" />';

                    while ($row = $result->fetch_assoc()) {

                        echo '<option value="' . $row['id'] . '">' . $row['cat_name'] . '</option>';

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

            $subject = addslashes(htmlentities(trim($_POST['topic_subject'])));
            $content = addslashes(htmlentities(trim($_POST['topic_content'])));
            $userId = $_SESSION['user_id'];
            $cat = $_POST['cat_selector'];
            $tags = htmlentities(trim($_POST['topic_tags']));
            $sql = "INSERT INTO topics (
                    topic_subject,
                    topic_description,
                    topic_cat,
                    topic_by,
                    topic_tags) VALUES('$subject', '$content', '$cat', '$userId', '$tags')";
        //var_dump($sql);
        $result = $conn->query($sql);

        if(!$result)
        {
            echo 'Could not create topic. Please try again.' . $conn->error;
        }
        else
        {

           echo 'You have successfully created topic.';
        }
    }

}

include 'footer.php';
?>
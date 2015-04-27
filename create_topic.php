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
                    <label for="topic_subject">Subject: <span class="red"><sup>*</sup></span></label><input type="text" name="topic_subject" id="topic_subject" maxlength="100" required="required"/>
                </div>
                <div>
                    <label for="cat_selector">Select category: <span class="red"><sup>*</sup></span></label>
                    <select name="cat_selector" id="cat_selector" required="required"/>';

                    while ($row = $result->fetch_assoc()) {

                        echo '<option value="' . $row['id'] . '">' . htmlspecialchars(stripcslashes($row['cat_name'])) . '</option>';

                    }

                    echo '</select></div>
                <div>
                    <label for="topic_content">Theme: <span class="red"><sup>*</sup></span></label><textarea type="text" name="topic_content" id="topic_content" maxlength="2048" required="required"></textarea>
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

        $subject = mysqli_real_escape_string($conn, (trim($_POST['topic_subject'])));
        $content = mysqli_real_escape_string($conn, (trim($_POST['topic_content'])));
        if (strlen($subject) == 0) {
            echo 'Topic subject cannot be empty! Please try again - <a href="create_topic.php">Create a topic</a>.';
        } elseif (strlen($content) == 0) {
            echo 'Topic description cannot be empty! Please try again - <a href="create_topic.php">Create a topic</a>.';
        } else {
            $userId = $_SESSION['user_id'];
            $cat = $_POST['cat_selector'];
            $tags = mysqli_real_escape_string($conn, (trim($_POST['topic_tags'])));
            $conn->query("SET NAMES utf8");
            $conn->query("SET COLLATION_CONNECTION=utf8_bin");
            if (!isset($_SESSION['topic_subject'])) {
                $_SESSION['topic_subject'] = '';
            }
            if ($_SESSION['topic_subject'] != $subject) {

                $sql = "INSERT INTO topics (
                    topic_subject,
                    topic_description,
                    topic_cat,
                    topic_by,
                    topic_tags) VALUES('$subject', '$content', '$cat', '$userId', '$tags')";
                $result = $conn->query($sql);
                $_SESSION['topic_subject'] = $subject;

                if (!$result) {
                    echo 'Could not create topic. Please try again.' . $conn->error;
                } else {

                    echo 'You have successfully created topic.';
                }
            } else {
                echo 'Topic already created!';
            }
        }
    }

}
include 'categories_view.php';
include 'footer.php';
?>
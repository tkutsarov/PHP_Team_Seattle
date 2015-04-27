<?php
define('GUESTID', 21);
?>
<!-- display the form for entering a new post for the given topic -->
<form method="post" action="posts_view.php">
    <?php
    // If the user is logged in, get the username and email and fill them in automaticly
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
        echo '<input type="text" name="username" value="' . $_SESSION['user_name'] . '" readonly required />';
        echo '<input type="text" name="email" value="' . $_SESSION['user_email'] . '" readonly />';
    } else{
        // If the user is a guest, get the username and email from the filled in fields
        echo '<input type="text" name="username" placeholder="username" required="required" />';
        echo '<input type="email" name="email" placeholder="email (optional)" />';
    }
    ?>

    <textarea name="post-content" placeholder="comment" required></textarea>
    <input type="submit" name="submit" placeholder="Post comment"/>
    <a href="index.php">View all topics</a>
</form>

<?php
// If the user is logged in, insert the post in posts table with his/hers data
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    $userID = $_SESSION['user_id'];

    if(isset($_POST['submit'])){
        if($_POST['post-content'] != ""){
            $postContent = $_POST['post-content'];

            $sqlPostInsert = "INSERT INTO posts (post_content, post_topic, post_by)"
                . "VALUES ('$postContent', '$topicID', '$userID')";

            $resultPostInsert = $conn->query($sqlPostInsert);
            if(!$resultPostInsert)
            {
                echo 'Could not create post. Please try again.' . $conn->error;
            }
            else
            {
                header('Location: posts_view.php');
            }
        }
    }
} else{
    // If the user is a guest, get the data from the form fields and insert them in the posts table
    if(isset($_POST['submit'])){
        if($_POST['post-content'] != ""){
            $postContent = $_POST['post-content'];
            $username = $_POST['username'];
            $guestEmail = $_POST['email'];

            $sqlPostInsert = "INSERT INTO posts (post_content, post_topic, post_by, guest, guest_email)"
                . "VALUES ('$postContent', '$topicID', '21', '$username', '$guestEmail')";

            $resultPostInsert = $conn->query($sqlPostInsert);
            if(!$resultPostInsert)
            {
                echo 'Could not create post. Please try again.' . $conn->error;
            }
            else
            {
                header('Location: posts_view.php');
            }
        }
    }
}
<?php
include 'connect.php';
include 'header.php';
define('GUESTID', 21);

//get the ID only if the user has clicked on a topic.
if (isset($_GET['id'])) {
    $_SESSION['topic_id'] = $_GET['id'];
    $topicID = $_SESSION['topic_id'];
    
    //update the visits for the chosen topic   
    $sqlUpdateVisits = "UPDATE 
                                topics 
                            SET 
                                visits = visits + 1 
                            WHERE id = $topicID";
     $conn->query($sqlUpdateVisits);   
}

$topicID = $_SESSION['topic_id'];

// get the topic that has been chosen and print it on the top as a heading.
$conn->query("SET NAMES utf8");
$conn->query("SET COLLATION_CONNECTION=utf8_bin");
$sql = "SELECT
                id,
                topic_subject,
                topic_description,
                topic_by
            FROM
                topics
            WHERE
                id=" . $topicID;

$result = $conn->query($sql);

if (!$result) {
    echo 'The topic could not be displayed.';
} else {
    if ($result->num_rows == 0) {
        echo 'No topic.';
    } else {
        echo '<div id="topic">';
        $row = $result->fetch_assoc();

        echo '<div class="category-heading">' . $row['topic_subject'] . '</div>';
        echo '<div class="category-description">' . $row['topic_description'] . '</div>';

        // get the post for that topic
        $conn->query("SET NAMES utf8");
        $conn->query("SET COLLATION_CONNECTION=utf8_bin");
        $sqlPosts = "SELECT
                                id,
                                post_content,
                                post_date,
                                post_topic,
                                post_by,
                                guest,
                                guest_email
                            FROM
                                posts                           
                            WHERE 
                                post_topic =" . $row['id'];

        $resultPosts = $conn->query($sqlPosts);

        while ($rowPost = $resultPosts->fetch_assoc()) {
            // If the user is a guest /not logged in registered user/ display the given
            // username and password.
            if ($rowPost['post_by'] == GUESTID) {
                $postedByGuest = $rowPost['guest'];
                echo '<div class="post-content">' .
                    $rowPost['post_content'] . '<div class="post-footer">'
                        . '<div class="post-notation">created:' .
                    $rowPost['post_date'] . '</div><div class="post-notation">posted by:' .
                    $postedByGuest . '</div></div></div>';
            } else {
                // If the user is logged in get the data from the users table
                $conn->query("SET NAMES utf8");
                $conn->query("SET COLLATION_CONNECTION=utf8_bin");
                $sqlPostedBy = "SELECT
                                        name
                                    FROM
                                        users                          
                                    WHERE 
                                        id =" . $rowPost['post_by'];
                $resultPostedBy = $conn->query($sqlPostedBy);
                $rowPostedBy = $resultPostedBy->fetch_assoc();

                echo '<div class="post-content">' .
                    $rowPost['post_content'] . '<div class="post-footer">'
                        . '<div class="post-notation">created:' .
                    $rowPost['post_date'] . '</div><div class="post-notation">posted by:' .
                    $rowPostedBy['name'] . '</div></div></div>';
            }
        }
        echo '</div>';
    }
}
?>
    <!-- display the form for entering a new post for the given topic -->
    <form method="post" action="posts_view.php">
        <?php
            // If the user is logged in, get the username and email and fill them in automaticly
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                echo '<input type="text" name="username" value="' . $_SESSION['user_name'] . '" readonly/>';
                echo '<input type="text" name="email" value="' . $_SESSION['user_email'] . '" readonly/>';
            } else {
                // If the user is a guest, get the username and email from the filled in fields
                echo '<input type="text" name="username" placeholder="username" required="required"/>';
                echo '<input type="email" name="email" placeholder="email(optional)" />';
            }
        ?>

        <textarea name="post-content" placeholder="comment" required></textarea>
        <input type="submit" name="submit" value="Post comment" class="post-button"/>
        <a href="index.php" class="post-button">View all topics</a>
    </form>

<?php   
    // If the user is logged in, insert the post in posts table with his/hers data  
    if(isset($_POST['submit'])){
        $post = str_replace(" ", "", $_POST['post-content']);
        if($post != ""){
            $postContent = $_POST['post-content'];
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                $userID = $_SESSION['user_id'];
            } else{
                $username = $_POST['username'];
                $guestEmail = $_POST['email'];
            }
            
            $conn->query("SET NAMES utf8");
            $conn->query("SET COLLATION_CONNECTION=utf8_bin");
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                $sqlPostInsert = "INSERT INTO posts (post_content, post_topic, post_by)"
                    . "VALUES ('$postContent', '$topicID', '$userID')";
            } else{
                $sqlPostInsert = "INSERT INTO posts (post_content, post_topic, post_by, guest, guest_email)"
                    . "VALUES ('$postContent', '$topicID', ". GUESTID .", '$username', '$guestEmail')";
            }
            
            $resultPostInsert = $conn->query($sqlPostInsert);
            
            if(!$resultPostInsert){
                echo 'Could not create post. Please try again.' . $conn->error;
            }else{
                header('Location: posts_view.php');
            }
        }
    }
    
    include 'footer.php';
?>


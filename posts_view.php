<?php
    include 'connect.php';
    include 'header.php';
    
    if(isset($_GET['id'])){
        $_SESSION['topic_id'] = $_GET['id'];
    }
         
    $topicID = $_SESSION['topic_id'];
    
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
    
    if(!$result)
    {
        echo 'The topic could not be displayed.';
    }
    else
    {
        if($result->num_rows == 0)
        {
            echo 'No topic.';
        }
        else
        {           
            echo '<div id="topic">'; 
            $row = $result->fetch_assoc();   
                          
            echo '<div class="topic-heading">' . $row['topic_subject'] . '</div>';
            echo '<div class="category-description">' . $row['topic_description'] . '</div>';
              
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
            
            while($rowPost = $resultPosts->fetch_assoc()){  
                if($rowPost['post_by'] == 21){                                        
                    $postedByGuest = $rowPost['guest'];
                    echo '<div>' . 
                        $rowPost['post_content'] . '<div class="topic-creation">;  created:' . 
                        $rowPost['post_date'] . '</div><div class="topic-creation">post by:' .
                            $postedByGuest . '</div></div>';
                } else{
                    $sqlPostedBy = "SELECT
                                            name
                                        FROM
                                            users                          
                                        WHERE 
                                            id =" . $rowPost['post_by'];
                    $resultPostedBy = $conn->query($sqlPostedBy);
                    $rowPostedBy = $resultPostedBy->fetch_assoc();
                    
                    echo '<div>' . 
                        $rowPost['post_content'] . '<div class="topic-creation">;  created:' . 
                        $rowPost['post_date'] . '</div><div class="topic-creation">post by:' .
                            $rowPostedBy['name'] . '</div></div>';
                }
                

            }
            echo '</div>';                                                      
        }
    }     
?>

<form method="post" action="posts_view.php">
    <?php 
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
            echo '<input type="text" name="username" value="' . $_SESSION['user_name'] . '"/>';
            echo '<input type="text" name="email" value="' . $_SESSION['user_email'] . '"/>';
        } else{
            echo '<input type="text" name="username" placeholder="username" required="required"/>';
            echo '<input type="email" name="email" placeholder="email" />';
        }      
    ?>
    
    <textarea name="post-content" placeholder="comment"></textarea>
    <input type="submit" name="submit" placeholder="Post comment"/>
    <a href="index.php">View all topics</a>
</form>

<?php
    
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
    
    include 'footer.php';
?>

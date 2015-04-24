<?php
    include 'connect.php';
    include 'header.php';
    
    $sql = "SELECT
                id,
                topic_subject,
                topic_description,
                topic_by
            FROM
                topics
            WHERE
                id=" . $_GET['id'];
   
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
            echo '<div class="topic-description">' . $row['topic_description'] . '</div>';

            $sqlPosts = "SELECT
                                id,
                                post_content,
                                post_date,
                                post_topic,
                                post_by
                            FROM
                                posts
                            WHERE 
                                post_topic =" . $row['id'];

            $resultPosts = $conn->query($sqlPosts);

            while($rowPost = $resultPosts->fetch_assoc()){                    
                echo '<div>' . 
                        $rowPost['post_content'] . '<div class="topic-creation">created:' . 
                        $rowPost['post_date'] . '</div></div>';

            }
            echo '</div>';                                                      
        }
    }
    
    include 'footer.php';
?>


<?php
    include 'connect.php';
$conn->query("SET NAMES utf8");
$conn->query("SET COLLATION_CONNECTION=utf8_bin");
    $sql = "SELECT
                id,
                cat_name,
                cat_description
            FROM
                categories";
   
    $result = $conn->query($sql);
    
    if(!$result)
    {
        echo 'The categories could not be displayed.';
    }
    else
    {
        if($result->num_rows == 0)
        {
            echo 'No categories defined yet.';
        }
        else
        {           
            echo '<div id="categories">';

            while($row = $result->fetch_assoc())
            {               
                
                echo '<div class="left-side">';
                echo '<div class="category-heading">' . $row['cat_name'] . '</div>';
                echo '<div class="category-description">' . $row['cat_description'] . '</div>';
                $conn->query("SET NAMES utf8");
                $conn->query("SET COLLATION_CONNECTION=utf8_bin");
                $sqlTopics = "SELECT
                                    id,
                                    topic_subject,
                                    topic_description,
                                    topic_date,
                                    topic_cat,
                                    topic_by,
                                    visits
                                FROM
                                    topics
                                WHERE 
                                    topic_cat =" . $row['id'];
                
                $resultTopics = $conn->query($sqlTopics);
                      
                while($rowTopic = $resultTopics->fetch_assoc()){    
                    //var_dump($rowTopic);
                    echo '<div class="topic-heading"><a href="posts_view.php?id=' . $rowTopic['id'] . '">' . 
                            $rowTopic['topic_subject'] . '</a><div class="topic-creation">created:' . 
                            $rowTopic['topic_date'] . '</div></div>';

                }
                echo '</div>';                               
            }
            echo '</div>';
        }
    }
?>


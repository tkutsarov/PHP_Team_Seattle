<?php
    include 'connect.php';
    include 'DateFormatter.php';
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
                
                echo '<section class="left-side">';
                echo '<div class="category-heading">' . htmlspecialchars(stripcslashes($row['cat_name'])) . '</div>';
                echo '<div class="category-description">' . htmlspecialchars(stripcslashes($row['cat_description'])) . '</div>';
                $conn->query("SET NAMES utf8");
                $conn->query("SET COLLATION_CONNECTION=utf8_bin");
                $sqlTopics = "SELECT
                                    t.id,
                                    t.topic_subject,
                                    t.topic_description,
                                    t.topic_date,
                                    t.topic_cat,
                                    t.topic_by,
                                    t.visits,
                                    u.name
                                FROM
                                    topics AS t
                                INNER JOIN users AS u
                                ON t.topic_by = u.id
                                WHERE 
                                    topic_cat =" . $row['id'] . " ORDER BY t.topic_date DESC";
                
                $resultTopics = $conn->query($sqlTopics);
                      
                while($rowTopic = $resultTopics->fetch_assoc()){    
                    $date = DateFormatter::getDateFromTimeStamp($rowTopic['topic_date']);
                    echo '<article class="topic-heading"><a href="posts_view.php?id=' . $rowTopic['id'] . '">' .
                            htmlspecialchars(stripcslashes($rowTopic['topic_subject'])) . '</a><div class="topic-date">'. $date . '</div>' .
                        '<div class="topic-author">created by: ' .htmlspecialchars(stripcslashes($rowTopic['name'])) . '</div></article>';

                }
                echo '</section>';
            }
            echo '</div>';
        }
    }
?>


<?php
include 'connect.php';
include 'header.php';
include 'DateFormatter.php';
?>
<?php

if (isset($_POST['search'])) {
    if (isset($_GET['go'])) {


        /* we need to ensure that visitors are only allowed to enter a capital or lower case
        letter as the first character in our search field.
        Prevent from SQL injection
        */

        if (preg_match("/^[a-zA-Z\\p{Cyrillic}0-9\\s\\-]+$/u", $_POST['keywords'])) {
            $keywords = addslashes(htmlspecialchars(trim($_POST['keywords'])));
            $conn->query("SET NAMES utf8");
            $conn->query("SET COLLATION_CONNECTION=utf8_bin");
            $sql = "SELECT " .
                "c.cat_name, " .
                "c.cat_description, " .
                "t.topic_subject, " .
                "t.topic_description, " .
                "t.topic_cat, " .
                "t.id, " .
                "t.topic_by, " .
                "t.topic_tags, " .
                "t.topic_date, " .
                "u.name " .
                "FROM topics AS t " .
                "INNER JOIN categories AS c " .
                "ON t.topic_cat = c.id " .
                "INNER JOIN users AS u " .
                "ON u.id = t.topic_by " .
                "WHERE t.topic_subject LIKE '%$keywords%' " .
                "OR t.topic_description LIKE '%$keywords%' ORDER BY t.topic_date DESC";


            $result = $conn->query($sql);

            if (!$result) {
                echo 'A problem occurred. Please try again.' . $conn->error;
            } else
                if (!$result->num_rows > 0) {
                    echo "<span>Nothing was found</span>";
                } else {
                    $categories = array();

                    echo '<div id="searched_categories">';
                    while ($row = $result->fetch_assoc()) {
                        //create category array with arrays of topics
                        $topic = array();
                        foreach ($row as $key => $value) {
                            if ($key !== 'cat_name' && $key !== 'cat_description') {
                                $topic[$key] = $value;
                            }
                        }
                        $categories[$row['cat_name']][] = $topic;
                        $categories[$row['cat_name']]['cat_description'] = $row['cat_description'];
                    }

                    foreach ($categories as $key => $topicData) {
                        echo '<section class="left-side">';
                        echo '<div class="category-heading">' . $key . '</div>';
                        echo '<div class="category-description">' . htmlspecialchars(stripcslashes($topicData['cat_description'])) . '</div>';
                        for ($i = 0; $i < count($topicData) - 1; $i += 1) {
            //  All selected database columns are available for every topic
                            $date = DateFormatter::getDateFromTimeStamp($topicData[$i]['topic_date']);
                            echo '<article class="topic-heading"><a href="posts_view.php?id=' . $topicData[$i]['id'] . '">' .
                                htmlspecialchars(stripcslashes($topicData[$i]['topic_subject'])) . '</a><div class="topic-date">' . $date . '</div>' .
                            '<div class="topic-author">created by: ' .htmlspecialchars(stripcslashes($topicData[$i]['name'])) . '</div></article>';
                        }
                        echo '</section>';
                    }

                    echo '</div>';

                }

        }
    }

}
?>
<?php include 'footer.php'; ?>


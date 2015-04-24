<?php include 'connect.php'; ?>
<div id="search-wrapper">
    <form method="POST" action="index.php?go" id="search-form">
        <input type="search" id="search-box" placeholder="search.." name="keywords"/>
        <button type="submit" name="search" id="search-btn"></button>
    </form>
</div>
<div style="clear:both;"></div>

<?php

if (isset($_POST['search'])) {
    if (isset($_GET['go'])) {

/* we need to ensure that visitors are only allowed to enter a capital or lower case
letter as the first character in our search field.
Prevent from SQL injection
*/
        if(preg_match("/^[A-Za-z]+/", $_POST['keywords'])) {
            $keywords = addslashes(htmlspecialchars(trim($_POST['keywords'])));
            $sql = "SELECT ".
                    "topic_subject, ".
                    "topic_description, ".
                    "topic_cat, ".
                    "topic_by, ".
                    "topic_tags ".
                    "FROM topics ".
                    "WHERE topic_subject LIKE '%$keywords%' ".
                    "OR topic_description LIKE '%$keywords%'";
            $result = $conn->query($sql);
            $foundTopics = [];

            if(!$result)
            {
                echo 'A problem occurred. Please try again.' . $conn->error;
            }
            else
                if (!$result->num_rows > 0) {
                    echo "<span>Nothing was found</span>";
                } else {

                    while($row = $result->fetch_assoc()){
                        $topic = [];
                        foreach ($row as $key => $value) {
                            $topic[$key] = $value;
                        }
                        array_push($foundTopics, $topic);
                        echo "<ul>\n";
                        echo "<li>" . "<a  href=\"#\">"   .$topic['topic_subject']."</a></li>\n";
                        echo "</ul>";
                    };


                }
        }
    }

}
?>

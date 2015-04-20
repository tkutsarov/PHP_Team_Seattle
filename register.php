<?php

include 'connect.php';
include 'header.php';
 
echo '<h3>Sign up</h3>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST'){   
    echo '<form method="post" action="">
        Username: <input type="text" name="user_name" /><br>
        Password: <input type="password" name="user_pass"><br>
        Password again: <input type="password" name="user_pass_check"><br>
        E-mail: <input type="email" name="user_email"><br>
        <input type="submit" value="Add category" />
     </form>';
} else {
    
    $errors = []; 
        
    if(isset($_POST['user_name'])) {
        
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 50)
        {
            $errors[] = 'The username cannot be longer than 50 characters.';
        }
    } else {
        $errors[] = 'The username field must not be empty.';
    }
         
    if(!isset($_POST['user_pass'])) {
        $errors[] = 'The password field cannot be empty.';
    } 
    
    if(!empty($errors)) {
        echo 'You have entered incorrect data.';
        echo '<ul>';
        foreach($errors as $key => $value) 
        {
            echo '<li>' . $value . '</li>'; 
        }
        echo '</ul>';
    } else {       
        $username = mysql_real_escape_string($_POST['user_name']);
        $password = md5($_POST['user_pass']);
        $email = mysql_real_escape_string($_POST['user_email']);
                
        $sql = "INSERT INTO user (name, password, email) "
                . "VALUES ('$username', '$password', '$email')";
                                                     
        if ($conn->query($sql) === TRUE) {
            echo "Your registration is successful";
            echo 'You can <a href="login.php">log in</a> now.';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
 
include 'footer.php';
?>


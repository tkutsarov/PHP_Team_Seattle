<?php

include 'connect.php';
include 'header.php';
 
echo '<h3>Sign up</h3>';

if($_SERVER['REQUEST_METHOD'] != 'POST'){   
    echo '<form method="post" action="">
        Username: <input type="text" name="user_name" /><br>
        Password: <input type="password" id="password" name="user_pass"><br>
        Password again: <input type="password" id="confirm-pass" name="user_pass_check"><br>
        E-mail: <input type="email" id="email" name="user_email"><br>
        <input type="submit" id="registerButton" value="Register" />
     </form>';
} else {
    
    $errors = array();
        
    if(isset($_POST['user_name'])) {
        
        if(!ctype_alnum($_POST['user_name']))
        {
            array_push($errors, 'The username can only contain letters and digits.');
        }
        if(strlen($_POST['user_name']) > 50)
        {
            array_push($errors, 'The username cannot be longer than 50 characters.');
        }
    } else {
        array_push($errors, 'The username field must not be empty.');
    }

    if($_POST['user_pass']) {

        if($_POST['user_pass'] != $_POST['user_pass_check']) {
            array_push($errors, 'The two passwords do not match.');
        }
    } else {
        array_push($errors, 'The password field cannot be empty.');
    }
//    var_dump($_POST);
//    var_dump($errors);

    if(!empty($errors)) {
        echo 'You have entered incorrect data.';
        echo '<ul>';
        foreach($errors as $key => $value) 
        {
            echo '<li>' . $value . '</li>'; 
        }
        echo '</ul>';
    } else {       
        $username = htmlentities(trim($_POST['user_name']));
        $password = htmlentities(trim($_POST['user_pass']));
        $email = htmlentities(trim($_POST['user_email']));

        $password = hash('sha256', $password);
                
        $sql = "INSERT INTO users (name, password, email) "
                . "VALUES ('$username', '$password', '$email')";
                                                     
        if ($conn->query($sql) === TRUE) {
            echo "Your registration is successful. ";
            echo 'You can <a href="login.php">log in</a> now.';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
 
include 'footer.php';
?>


<?php
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    if(!isset($_SESSION['logged_in'])) {
        echo '<h2>Sign up</h2>';
        echo '<form method="post" action="">
               <label for="user_name">Username: <span class="red"><sup>*</sup></span></label><input type="text" name="user_name"  required="required"/>
               <label for="user-pass">Password: <span class="red"><sup>*</sup></span></label><input type="password" id="password" name="user_pass" required="required"/>
               <label for="confirm-pass">Password again: <span class="red"><sup>*</sup></span></label><input type="password" id="confirm-pass" name="user_pass_check" required="required"/>
               <label for="email">E-mail: <span class="red"><sup>*</sup></span></label><input type="email" id="email" name="user_email" required="required"/>
                <input type="submit" id="registerButton" value="Register" class="sub-btn"/>
                </form>';
    } else {
        echo 'You already logged in. You must first <a href="logout.php">Log out</a> and then try to <a href="register.php">register</a>!!!';
    }
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
    if($_POST['user_email']){
        $email_regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
        //var_dump(preg_match($email_regex, $_POST['user_email']));
        if(preg_match($email_regex, $_POST['user_email']) == 0) {
            array_push($errors, 'You have entered an invalid email.');
        }

    } else {
        array_push($errors, 'The email field cannot be empty.');
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
        $username = mysqli_real_escape_string($conn, trim($_POST['user_name']));
        $password = mysqli_real_escape_string($conn, trim($_POST['user_pass']));
        $email = mysqli_real_escape_string($conn, trim($_POST['user_email']));

        $password = hash('sha256', $password);
                
        $sql = "INSERT INTO users (name, password, email) "
                . "VALUES ('$username', '$password', '$email')";
                                                     
        if ($conn->query($sql) === TRUE) {
            echo "Your registration is successful. ";
            echo 'You can <a href="login.php">log in</a> now.';
        } else if ($conn->errno == 1062) {
            echo 'This username is already taken. Please choose another username and try to <a href="register.php">register</a>.';
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            echo 'You could not be registered at the moment. Please try to <a href="register.php">register</a> again.';
        }
    }
}
 
include 'categories_view.php';
include 'footer.php';
?>


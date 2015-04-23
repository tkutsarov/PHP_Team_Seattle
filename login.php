<?php

include 'connect.php';
include 'header.php';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in, you can <a href="logout.php">log out</a> if you want.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        echo '<h3>Sign in</h3>';
        echo '<form method="post" action="">
            Username: <input type="text" name="user_name" />
            Password: <input type="password" name="user_pass">
            <input type="submit" value="Sign in" />
         </form>';
    }
    else
    {       
        $errors = []; 
         
        if(!$_POST['user_name'])
        {
            array_push($errors, 'The username field must not be empty.');
        }
         
        if(!$_POST['user_pass'])
        {
            array_push($errors, 'The password field must not be empty.');
        }
         
        if(!empty($errors)) 
        {
            echo 'You have errors in the following fields:';
            echo '<ul>';
            foreach($errors as $key => $value) 
            {
                echo '<li>' . $value . '</li>'; 
            }
            echo '</ul>';
        }
        else
        {
            $username = htmlentities(trim($_POST['user_name']));
            $password = htmlentities(trim($_POST['user_pass']));

            $password = hash('sha256', $password);
                    
            $sql = "SELECT id, name, password, is_admin FROM users WHERE "
                    . "name='$username' AND password='$password'";
                                              
            $result = $conn->query($sql);
            //var_dump($_POST);

            if(!$result)
            {
                echo 'Unsuccessful signing in.';
            }
            else
            {              
                if($result->num_rows > 0)
                {                   
                    $_SESSION['logged_in'] = true;
                                         
                    while($row = $result->fetch_assoc())
                    {
                        $_SESSION['user_id']    = $row['id'];
                        $_SESSION['user_name']  = $row['name'];
                        $_SESSION['is_admin']  = $row['is_admin'];
                    }
                     
                    echo 'Welcome, ' . $_SESSION['user_name'] . 
                            '. <a href="index.php">Proceed to the main page</a>.';

                    //var_dump($_SESSION);
                }
                else
                {
                    echo 'The username or/and password are incorrect!';                   
                }
            }
        }
    }
}
 
include 'footer.php';
?>

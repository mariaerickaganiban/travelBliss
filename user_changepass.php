<?php

require 'header.php';
require 'connection.php';
$conn = getDB();
session_start();

?>

<html><html><link href="/travelB/design.css" rel="stylesheet" />
    
    <header>
        <title>User Change Password</title>
        
    </header>

    <body>
    <div class="container1">
    <p><a href="user_login.php"><button class="button button1">Back to previous page</button></a> <p>
        
    <h2><p class="p3">Password Change </p></h2>
    <form method="post" class="box">
    <div class="row">
        <div class="col-25">
            <label for="user_username">Username</label>
            </div>
        <div class="col-75">
            <input type="text" name="user_username" id="user_username" placeholder="Enter your username" required>
        </div></div>

        <div class="row">
        <div class="col-25">
            <label for="first_name">First Name</label>
            </div>
        <div class="col-75">
            <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" required>
        </div> </div>

        <div class="row">
        <div class="col-25">
            <label for="last_name">Last Name</label>
            </div>
        <div class="col-75">
            <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" required>
        </div></div>

        <div class="row">
        <div class="col-25">
            <label for="middle_name">Middle Name</label>
            </div>
        <div class="col-75">
            <input type="text" name="middle_name" id="last_name" placeholder="Enter your middle name" required>
        </div></div>

        <div class="row">
        <div class="col-25">
            <label for="email">Email</label>
            </div>
        <div class="col-75">
            <input type="text" name="email" id="email" placeholder="Enter your email" required>
        </div></div>

        <div class="row">
        <div class="col-25">
            <label for="new_user_password">New Password</label>
            </div>
        <div class="col-75">
            <input type="text" style="-webkit-text-security: square" name="new_user_password" id="new_user_password" placeholder="Enter your new password" required>
        </div></div>
        <div class="row">
    <input type="submit">
    </div>
        </form>
    </body>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['user_username'])) {
            
            $u_username=htmlentities($_POST['user_username']);
            $f_name=htmlentities($_POST['first_name']);
            $l_name=htmlentities($_POST['last_name']);
            $m_name=htmlentities($_POST['middle_name']);
            $email=htmlentities($_POST['email']);
            $password = htmlentities($_POST['new_user_password']);

            $sql = "SELECT * FROM users WHERE user_username='".$u_username."' AND first_name='".$f_name."' 
            AND last_name='".$l_name."' AND middle_name='".$m_name."' AND email='".$email."' LIMIT 1;";

        $results = mysqli_query($conn, $sql);

        if (mysqli_num_rows($results)==1) {
            $sql_2 = "UPDATE users SET user_password='$password' WHERE user_username='".$u_username."' AND first_name='".$f_name."' 
            AND last_name='".$l_name."' AND middle_name='".$m_name."' AND email='".$email."'";
            mysqli_query($conn, $sql_2);
            echo "Your password has been changed. Redirecting to Login page";
            header("Refresh:2; url=user_login.php");  
            exit();
        } else {
            echo "Incorrect details, can't change password. Redirecting to Login page";
            header("Refresh:2; url=user_login.php");  
            exit();
        } 
        }
        }

    ?>
</html>
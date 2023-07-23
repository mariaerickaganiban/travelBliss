<?php

require 'header.php';
require 'connection.php';
$conn = getDB();
session_start();

?>

<html><link href="/travelB/design.css" rel="stylesheet" />
<header>
        <title>Admin Change Password</title>
        
</header>

<body>
    
<div class="container1">
<p><a href="admin_login.php"><button class="button button1">Back to previous page</button></a> <p>

<h2><p class="p3">Password Change</p></h2>
<form method="post" class="box">
    <div class="row">
        <div class="col-25">
        <label for="a_username">Username</label>
        </div>
        <div class="col-75">
        <input type="text" name="a_username" id="a_username" placeholder="Enter your username" required>
    </div></div>

    <div class="row">
        <div class="col-25">
        <label for="f_name">First Name</label>
        </div>
        <div class="col-75">
        <input type="text" name="f_name" id="f_name" placeholder="Enter your first name" required>
    </div></div>

    <div class="row">
        <div class="col-25">
        <label for="l_name">Last Name</label>
        </div>
        <div class="col-75">
        <input type="text" name="l_name" id="l_name" placeholder="Enter your last name" required>
    </div></div>

    <div class="row">
        <div class="col-25">
        <label for="new_admin_password">New Password</label>
        </div>
        <div class="col-75">
        <input type="text" style="-webkit-text-security: square" name="new_admin_password" id="new_admin_password" placeholder="Enter your new password" required>
    </div>  </div>
    <div class="row">
    <input type="submit">
    </div>
</form>
</body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['a_username'])) {
        
        $a_username=htmlentities($_POST['a_username']);
        $f_name=htmlentities($_POST['f_name']);
        $l_name=htmlentities($_POST['l_name']);
        $password = htmlentities($_POST['new_admin_password']);

        $sql = "SELECT * FROM admins WHERE a_username='".$a_username."' AND f_name='".$f_name."' 
        AND l_name='".$l_name."' LIMIT 1;";

    $results = mysqli_query($conn, $sql);

        if (mysqli_num_rows($results)==1) {
            $sql_2 = "UPDATE admins SET a_password='$password' WHERE a_username='".$a_username."' AND f_name='".$f_name."' 
            AND l_name='".$l_name."'";

            mysqli_query($conn, $sql_2);

            echo "Your password has been changed. Redirecting to Login page";
            header("Refresh:2; url=admin_login.php");  
            exit();}
            
            else {
            echo "Incorrect details, can't change password. Redirecting to Login page";
            header("Refresh:2; url=admin_login.php");  
            exit();
            } 
        }
    }

?>

</html>
<?php

require 'header.php';
require 'connection.php';
$conn = getDB();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM admins";

    $results = mysqli_query($conn, $sql);

    // If there is an connection error, then echo the description of the  error
    // Else, store the results on a variable using mysqli_fetch_all
    if ($results === false) {
        echo mysqli_error($conn);
    } else {
        $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }
    foreach ($users as $user) {
        if (
            $_POST["a_username"] == $user["a_username"] &&
            $_POST["password"] == $user["a_password"]
        ) {
            session_regenerate_id(true);

            $_SESSION["is logged in"] = true;

            $_SESSION["user_id"] = $user["user_id"];

            // redirect("user_home.php");
            header("Location: admin_home.php", true, 301);  
            exit(); 
        } else {
            $error = "Incorrect Login Credentials";
        }
    }
}
?>

<html>

<link href="/travelB/design.css" rel="stylesheet" />

    <header>
        <title>Admin Login</title>
    </header >

    <?php if (!empty($error)): ?>
    <p><?= $error ?></p>
    <?php endif; ?>
<div class="container1">
<h2><p class="p3">Admin account</p> </h2>
    <form method="post">
    <div class="row">
        <div class="col-25">
            <label for="a_username">Username</label>
        </div>
        <div class="col-75">
            <input type="text" name="a_username" id="a_username" />
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="password">Password</label>
        </div>
        <div class="col-75">
            <input type="text" style="-webkit-text-security: square" name="password" id="password" />
        </div>
    </div>
    <div class="row">
    <input type="submit">
    </div>
    </form>
    <div style = "float:right;"><a href="admin_changepass.php"><button class="button button1">Change Password</button></a>
</html>
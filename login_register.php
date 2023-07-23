<?php
require 'header.php';
require 'connection.php';
$conn = getDB();
session_start();

?>

<html><link href="/travelB/design.css" rel="stylesheet" />
    <header>
        <title>Important note</title>
    </header >

    <div class="container1">
    <h2 style="font-weight: bold; color:tomato; font-family: Arial Black; ">Please be informed, </h2>
    <p>in order to book a new bus travel, we require our beloved 
    customers to register and login to their acccount.</p>

    Already have an account? Click here to <a href="user_login.php"><button class="button button1">Login</button><p></a>
    Looking to create an account? Click here to <a href="user_register.php"><button class="button button1">Register</button><p></a>
</div>
</html>
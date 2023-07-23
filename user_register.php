<?php

require 'header.php';
require 'connection.php';
$conn = getDB();

?>

<html>
    <link href="/travelB/design.css" rel="stylesheet" />
    <header>
        <title>Registration</title>
        
    </header >
    <div class="container1">
    <h2><p class="p3">Account Creation</p></h2>
    <form method="post">
    <div class="row">
        <div class="col-25">
            <label for="first_name">First Name</label>
            </div>
        <div class="col-75">
            <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" required>
        </div></div>

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
            <input type="text" name="middle_name" id="middle_name" placeholder="Enter your middle name" required>
            </div></div>

            <div class="row">
        <div class="col-25">
            <label for="email">Email</label>
            </div>
        <div class="col-75">
            <input type="text" name="email" id="email" placeholder="Enter your email address" required>
            </div></div>

        <div class="row">
        <div class="col-25">
            <label for="phone_number">Phone Number</label>
            </div>
        <div class="col-75">
            <input type="text" name="phone_number" id="phone_number" placeholder="Enter your phone number" required>
            </div></div>
    
            <div class="row">
        <div class="col-25">
        <label for="gender">Gender</label>
        </div>
        <div class="col-75">
                <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Prefer not to say">Prefer not to say</option>
                </select>
        </div></div>

        <div class="row">
        <div class="col-25">
            <label for="user_username">Username</label>
            </div>
        <div class="col-75">
            <input type="text" name="user_username" id="user_username" placeholder="Enter your username" required>
            </div></div>

            <div class="row">
        <div class="col-25">
            <label for="user_password">Password</label>
            </div>
        <div class="col-75">
            <input type="text" style="-webkit-text-security: square" name="user_password" id="user_password" placeholder="Enter your password" required>
            </div></div>

            <div class="row">
        <div class="col-25">
            <label for="terms"></label>
            </div>
        <div class="col-75">
            <input type="checkbox" name="terms" id="terms" value="Agree" required> By completing the registration, I understood and agree to the Travel Bliss Terms of Use and Privacy Statement.
            </div></div>
            <div class="row">
    <input type="submit">
    </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "INSERT INTO users (first_name, last_name, middle_name, email, phone_number, gender, user_username, user_password)
                VALUES ('". $_POST['first_name'] . "','"
                        . $_POST['last_name'] . "','"
                        . $_POST['middle_name'] . "','"
                        . $_POST['email'] . "','"
                        . $_POST['phone_number'] . "','"
                        . $_POST['gender'] . "','"
                        . $_POST['user_username'] . "','"
                        . $_POST['user_password'] . "')";

        $results = mysqli_query($conn, $sql);

        if ($results === false) {
            echo mysqli_error($conn);
        } else {
            echo "You are now registered. Please wait while you're being redirected.";
            header("Refresh:2; url=user_login.php");  
            exit();
        }
        }
    ?>
</html>
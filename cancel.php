<?php

require 'connection.php';
$conn = getDB();
session_start();


if (isset($_GET["reservations_no"])) {
    $sql = "SELECT * FROM reservations WHERE reservations_no = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $_GET["reservations_no"]);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            $travel = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
    if ($travel) {
        $travel_no = $travel["reservations_no"];
    } else {
        die("travel not found");
    }
} else {
    header("Refresh:2; url=user_home.php");  
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "CALL delete_res(?);";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $travel_no);

        if (mysqli_stmt_execute($stmt)) {
            header("Refresh:2; url=user_home.php");  
            exit();
        } else {
            echo mysqli_stmt_error($stmt);
        }
    }
}
?>

<html>
<link href="/travelB/design.css" rel="stylesheet" />
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

.active {
  background-color: #04AA6D;
}
</style>
    <header>
        <title>Member Home Page</title>
        
        <ul>
        <li><a href="user_home.php">
                <img src="TB-text.png" alt="Home Logo"  style="opacity: 1"  height="40" ></a></li>
                <li style="float:right"><p class="p2"><a href="logout.php">Logout</a></li>
                    <li style="float:right"><p class="p2"><a href="FAQs.php">FAQs</a></li>
                <li><p class="p2"><a href="newbooking.php">Book New Travel</a></li>
                
        </ul>    
    </header >
    <div class="bg-image"></div>
  <div class="bg-text"> 
        <h2><p class="p3">Cancel reservation</p></h2>
        <p>Please take note that this request will be forwared with the operators
            and you will notified for the cancellation request.</p>

        <form method="post">
            <p>Are you sure?</p>

            <button class="button button1">Delete</button>
             <a href="user_home.php">Cancel</a>
        </form>
</html>
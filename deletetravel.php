<?php

require 'connection.php';
$conn = getDB();
session_start();


if (isset($_GET["travel_no"])) {
    $sql = "SELECT * FROM travels WHERE travel_no = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $_GET["travel_no"]);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            $travel = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
    if ($travel) {
        $travel_no = $travel["travel_no"];
        $travel_origin = $travel["travel_origin"];
        $travel_destination= $travel["travel_destination"];
        $travel_class= $travel["travel_class"];
    } else {
        die("travel not found");
    }
} else {
    header("Refresh:2; url=admin_home.php");  
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "CALL delete_travel(?);";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $travel_no);

        if (mysqli_stmt_execute($stmt)) {
            header("Refresh:2; url=admin_home.php");  
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
    <title>Delete Travel</title>
            <ul>

            <li><a href="admin_home.php">
            <img src="TB-text.png" alt="Home Logo"  style="opacity: 1"  height="40" ></a></li>
            <li style="float:right"><p class="p2"><a href="logout.php">Logout</a></li>
        </ul>
</header>
<div class="bg-image"></div>
  <div class="bg-text">  
        <h2>Delete Bus Travel</h2>

        <form method="post">
            <p>Are you sure you want to delete the bus travel?</p>

            <button class="button button1">Delete</button>
            <a href="admin_home.php">Cancel</a>
        </form>
</html>
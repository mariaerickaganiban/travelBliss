<?php

require 'connection.php';
$conn = getDB();
session_start();

// travels table
$travels_sql = "SELECT operator, travel_origin, travel_destination, dep_time,
                    travel_time, travel_date, travel_fare, travel_class
                FROM travels
                ORDER BY dep_time DESC;";

$travels_results = mysqli_query($conn, $travels_sql);

// If there is an connection error, then echo the description of the  error
// Else, store the results on a variable using mysqli_fetch_all
if ($travels_results === false) {
    echo mysqli_error($conn);
} else {
    $travels = mysqli_fetch_all($travels_results, MYSQLI_ASSOC);
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
        <title>Member Reservation</title>
        
        <ul>
        <li><a href="user_home.php">
                <img src="TB-text.png" alt="Home Logo"  style="opacity: 1"  height="40" ></a></li>
                <li style="float:right"><p class="p2"><a href="logout.php">Logout</a></li>
                    <li style="float:right"><p class="p2"><a href="FAQs.php">FAQs</a></li>
                <li><p class="p2"><a href="newbooking.php">Book New Travel</a></li>
                
        </ul>    
    </header >
        
    <body> 
        
    <div class="container"> 
    <img src="background.png" alt="bus" class="image" width="1000" height="300">
    <div class="middle">
  <div class="text">  
  <h2><p class="p3"><strong>Search for New Bus Travel</strong></p></h2>
        <form action="user_reservation.php" method="post">
        <p class="p1">Origin: <select name="travel_origin">
                    <option value="Manila">Manila</option>
                    <option value="Iriga">Iriga</option>
                    <option value="Clark, Pampanga">Clark, Pampanga</option>
                    <option value="Baler">Baler</option>
                    <option value="Baguio">Baguio</option>
                    <option value="Naga">Naga</option>
                    <option value="Legazpi">Legazpi</option>
                    <option value="Leyte">Leyte</option>
                    <option value="Iloilo">Iloilo</option>
                    <option value="Davao">Davao</option>
                </select></p>

                <p class="p1">Destination: <select name="travel_destination">
                    <option value="Manila">Manila</option>
                    <option value="Iriga">Iriga</option>
                    <option value="Clark, Pampanga">Clark, Pampanga</option>
                    <option value="Baler">Baler</option>
                    <option value="Baguio">Baguio</option>
                    <option value="Naga">Naga</option>
                    <option value="Legazpi">Legazpi</option>
                    <option value="Leyte">Leyte</option>
                    <option value="Iloilo">Iloilo</option>
                    <option value="Davao">Davao</option>
                    </p></select>

                <label for="travel_date">
                    <br>Travel Date: </label>
                    <input type="date" name="travel_date" id="travel_date"><br>
                    <div class="row">
            <input type="submit">
            </div>
            </div> 
        </form> <br> 
    </body>
</html>
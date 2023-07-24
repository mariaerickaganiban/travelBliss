<?php
require 'header.php';
require 'connection.php';
$conn = getDB();
session_start();

// travels table
$travels_sql = "SELECT *
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

<html><link href="/travelB/design.css" rel="stylesheet" />
    <header>
    
        <title>Travel Bliss Reservation</title>
        
    </header >
    <body>   

    <div class="container">
  <img src="background.png" alt="bus" class="image" width="1000" height="300">
  <div class="middle">
  <div class="text">
  <h2><p class="p3"><strong>Search Bus Travels</strong></p></h2>
        <form action="travelsearch.php" method="post">
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
        </dv></dv>
    </body>
</html>
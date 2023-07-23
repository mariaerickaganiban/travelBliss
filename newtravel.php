<?php

require 'connection.php';
$conn = getDB();
session_start();

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
        <title>Add New Travel</title>
            <ul>
            <li><a href="admin_home.php">
            <img src="TB-text.png" alt="Home Logo"  style="opacity: 1"  height="40" ></a></li>
            <li style="float:right"><p class="p2"><a href="logout.php">Logout</a></li>
        <li><p class="p2"><a href="newtravel.php">Add Travel</a></li>
        </ul>
</header>
<div class="container1">
    <p><a href="admin_home.php"><button class="button button1">Back to previous page</button></a> <p>
    <h2><p class="p3">Add Bus Travel</p></h2>

<form method="post">
    <div class="row">
        <div class="col-25">
    <label for="operator">Operator: </label>
    </div>
        <div class="col-75">
            <select name="operator">
            <option value="Genesis">Genesis</option>
            <option value="Victory Liner">Victory Liner</option>
            <option value="JAC Liner">JAC Liner</option>
            </select> </div></div>
    
            <div class="row">
        <div class="col-25">
    Origin:     </div>
        <div class="col-75"><select name="travel_origin">
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
        </select></div></div>

        <div class="row">
        <div class="col-25">
    Destination:   </div>
        <div class="col-75"><select name="travel_destination">
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
        </select></div></div>

        <div class="row">
        <div class="col-25">
        <label for="dep_time">Departure Time</label>
        </div>
        <div class="col-75">
        <input type="text" name="dep_time" id="dep_time" placeholder="Enter departure time" required>
        </div></div>

        <div class="row">
        <div class="col-25">
        <label for="travel_time">Travel Time</label>
        </div>
        <div class="col-75">
        <input type="text" name="travel_time" id="travel_time" placeholder="Enter the travel time" required>
    </div></div>

    <div class="row">
        <div class="col-25">
        <label for="travel_date">Travel Date</label>
        </div>
        <div class="col-75">
        <input type="date" name="travel_date" id="travel_date" placeholder="Enter travel date" required>
        </div></div>

        <div class="row">
        <div class="col-25">
        <label for="travel_fare">Fare per Ticket</label>
        </div>
        <div class="col-75">
        <input type="text" name="travel_fare" id="travel_fare" placeholder="Enter travel fare" required>
    </div></div>

    <div class="row">
        <div class="col-25">
    <label for="travel_class">Travel Class</label></div>
        <div class="col-75">
            <select name="travel_class">
            <option value="Premiere">Premiere</option>
            <option value="Deluxe">Deluxe</option>
            <option value="Executive">Executive</option>
            </select></div></div>
    
    <div class="row">
    <input type="submit">
    </div></div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $sql = "INSERT INTO travels (operator, travel_origin, travel_destination, dep_time, travel_time, travel_date, travel_fare, travel_class)
            VALUES ('". $_POST['operator'] . "','"
                       . $_POST['travel_origin'] . "','"
                       . $_POST['travel_destination'] . "','"
                       . $_POST['dep_time'] . "','"
                       . $_POST['travel_time'] . "','"
                       . $_POST['travel_date'] . "','"
                       . $_POST['travel_fare'] . "','"
                       . $_POST['travel_class'] . "')";

    $results = mysqli_query($conn, $sql);

    if ($results === false) {

        echo mysqli_error($conn);

    } else {
        echo "New travel has been added. Please wait while you're being redirected.";
        header("Refresh:2; url=admin_home.php");  
        exit();
    }

    }

?>
</html>
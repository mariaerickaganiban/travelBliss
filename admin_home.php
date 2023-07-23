<?php

require 'connection.php';
$conn = getDB();
session_start();

// travels table
$travels_sql = "SELECT travel_no, operator, travel_origin, 
                travel_destination, dep_time, travel_time,
                travel_date, travel_fare, travel_class
                FROM travels
                ORDER BY travel_date ASC;";

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
        <title>Admin Home Page</title>
            <ul>

            <li><a href="admin_home.php">
            <img src="TB-text.png" alt="Home Logo"  style="opacity: 1"  height="40" ></a></li>
            <li style="float:right"><p class="p2"><a href="logout.php">Logout</a></li>
        <li><p class="p2"><a href="newtravel.php">Add Travel</a></li>
        </ul>
</header>
<body>
<div class="container1">

        <form action="searchtraveladmin.php" method="post">
        <div>
        <h2><p class="p3">Search Bus Travel</p></h2>
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
            </select></p><br>
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
            </select></p>
            <label for="travel_date">
                <br><p class="p1">Travel Date:</p> </label>
            <input type="date"   name="travel_date" id="travel_date" placeholder="Enter the travel date">
            <div>
            <p class="p1"><label for="travel_class">Travel Class:</label></p>
                <select name="travel_class">
                <option value="Premiere">Premiere</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Executive">Executive</option>
                </select>
            </div><br>
            <div class="row">
    <input type="submit">
    </div>
        </form><br> 

    </div>


    
<h2><p class="p3">Bus Travel Details </p></h2>
        <table>
        <tr>
        <th>Operator</th>
        <th>Origin</th>
        <th>Destination</th>
        <th>Departure Time</th>
        <th>Travel Time</th>
        <th>Travel Date</th>
        <th>Fare</th>
        <th>Travel Class</th>
        <th>Change Details</th>
        <th>Cancel Travel</th>
        </tr>
        <?php foreach ($travels as $travel): ?>  
            <tr>
                <td><?= $travel["operator"]?></td>
                <td><?= $travel["travel_origin"] ?></td>
                <td><?= $travel["travel_destination"] ?></td>
                <td><?= $travel["dep_time"] ?></td>
                <td><?= $travel["travel_time"] ?></td>
                <td><?= $travel["travel_date"] ?></td>
                <td><?= $travel["travel_fare"] ?></td>
            <td><?= $travel["travel_class"] ?></td>
            <td><a href="changebusinfo.php?travel_no=<?= $travel["travel_no"] ?>">
            <button class="button button1">Change Info</button></a></td>
        <td><a href="deletetravel.php?travel_no=<?= $travel["travel_no"] ?>">
            <button class="button button1">Delete</button></a></td>
            </tr>
        <?php endforeach; ?>  
        </table>
        <br> 
    </body>
</html>
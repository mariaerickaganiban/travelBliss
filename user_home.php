<?php

require 'connection.php';
$conn = getDB();
session_start();
$user_id = $_SESSION["user_id"];

$travels_sql = "SELECT 
        travels.travel_no,
        reservations.reservations_no,
        reservations.total_fare,
        reservations.FOP,
        reservations.created_at,
        travels.operator, travels.travel_origin, travels.travel_destination,
        travels.dep_time, travels.travel_date, travels.travel_class
    FROM
        travels
            JOIN
        reservations ON reservations.travel_no = travels.travel_no
    WHERE 
        reservations.user_id = $user_id
    ORDER BY created_at DESC";

$travels_results = mysqli_query($conn, $travels_sql);

// If there is an connection error, then echo the description of the  error
// Else, dump the results of the query
if ($travels_results === false) {
    echo mysqli_error($conn);
} else {
    $travels = mysqli_fetch_all($travels_results, MYSQLI_ASSOC);
}

?>

<html><link href="/travelB/design.css" rel="stylesheet" />
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

    <body>
    <div class="bg-image"></div>
  <div class="bg-text">  
    <h2><p class="p4" style = "text-align: center;">Your reservations, <?php 
            $stud = $_SESSION['user_id'];

            $sql = "SELECT * FROM users WHERE user_id='".$stud."'";
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($query);

            $name = $result['first_name'] . " " . $result['last_name'];
            ?>

            <p class="p3"><?= $name ?></p></p></h2>
        <table>
            <tr>
                <th>Operator</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Departure Time</th>
                <th>Travel Date</th>
                <th>Fare</th>
                <th>FOP</th>
                <th>Travel Class</th>
                <th>Cancellation</th>
                <th>Changes</th>
                
            </tr>
            <?php foreach ($travels as $travel): ?>  
                <tr>
                    <td><?= $travel["operator"]?></td>
                    <td><?= $travel["travel_origin"] ?></td>
                    <td><?= $travel["travel_destination"] ?></td>
                    <td><?= $travel["dep_time"] ?></td>
                    <td><?= $travel["travel_date"] ?></td>
                    <td><?= $travel["total_fare"] ?></td>
                    <td><?= $travel["FOP"]?></td>
                    <td><?= $travel["travel_class"] ?></td>
                    <td><a href="cancel.php?reservations_no=<?= $travel["reservations_no"] ?>">
                        <button class="button button1">Cancel Travel</button></a></td>
                    <td><a href="changeFOP.php?reservations_no=<?= $travel["reservations_no"] ?>">
                        <button class="button button1">Change FOP</button></a></td>
                </tr>
            <?php endforeach; ?>  
        </table>
    </body>
</html>
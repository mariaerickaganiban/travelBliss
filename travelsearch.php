<?php

require 'header.php';
require 'connection.php';
$conn = getDB();
session_start();

if (isset($_POST['travel_date'])) {

    $trdate=$_POST['travel_date']; 
    $trorigin=$_POST['travel_origin']; 
    $trdest=$_POST['travel_destination'];

    $sql = "SELECT * FROM travels WHERE travel_date = '".$trdate."'
    AND travel_origin='".$trorigin."' AND travel_destination='".$trdest."';";
    $result = mysqli_query($conn, $sql);

    $travels_results = mysqli_query($conn, $sql);

    if ($travels_results === false) {
    echo mysqli_error($conn);
    } else {
    $travels = mysqli_fetch_all($travels_results, MYSQLI_ASSOC);
    }
}


?>
<html><link href="/travelB/design.css" rel="stylesheet" />

  <header>
    <title>Travel Bliss Reservation</title>
  </header>
<div class="bg-image"></div>
  <div class="bg-text">  
  <p><a href="index.php"><button class="button button1">Back to previous page</button></a> <p>
<?php if (empty($travels)): ?>
  <div style = "background-color: #FAA0A0;
  width: 300px;
  border: 2px solid red;
  padding: 30px;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
  border-radius: 5px;">
  <p style="font-weight: bold; ">Unfortunately, no travels available at the moment.</p></div>
<?php else: ?>    
  <h2><p class="p3">Available Travels</p></h2>

  <form action="login_register.php" method="post">
          <div>
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
          <th>Reserve</th>
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
            <td><button class="button button1">Book</button></td>
          </tr>
        <?php endforeach; ?>  
      </table> 
  </form> <br> 
  <?php endif; ?>           
</html>



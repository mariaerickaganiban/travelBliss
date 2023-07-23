<?php
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
  <p><a href="newbooking.php"><button class="button button1">Back to previous page</button></a> <p>
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

  <form method="post">  
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
        <td><a href="user_addinfo.php?travel_no=<?= $travel["travel_no"] ?>">
          <button class="button button1">Book</button></a></td>
      </tr>
      <?php endforeach; ?>  
    </table> 
  </form> <br> 
  <?php endif; ?>           
</html>



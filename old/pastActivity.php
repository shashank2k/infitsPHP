<?php

$server="127.0.0.1:3306";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$today = date('Y-m-d');

$from = date('Y-m-d', strtotime('-8 days', strtotime($today)));

$to = date('Y-m-d', strtotime('1 days', strtotime($today)));


$clientID = $_POST['clientID'];

// $clientID = 'Azarudeen';

// $sql = "select sum(steps),dateandtime from steptracker where clientID = '$clientID' and dateandtime between '$from' and '$to';";
$sql = "select sum(steps),dateandtime from steptracker where clientID = '$clientID' and dateandtime between '$from' and '$to'GROUP BY Cast(dateandtime as date) ORDER BY Cast(dateandtime as date);";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
      $emparray['date'] = date("d-m-Y",strtotime($row['dateandtime']));
      $emparray['steps'] = $row['sum(steps)'];
      $full[] = $emparray;
    }
    echo json_encode(['steps' => $full]);
?>
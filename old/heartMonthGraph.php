<?php

$server="127.0.0.1:3306";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$from = date("Y-m-d", strtotime("first day of this month"));
$to = date("Y-m-d", strtotime("last day of this month"));

$clientID = $_POST['clientID'];

$sql = "select * from heartrate where clientID = '$clientID' and dateandtime between '$from' and '$to';";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $full = array();
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['date'] = date("d",strtotime($row['dateandtime']));
        // $emparray['date'] = $row['cast(dateandtime as time)'];
        $a = json_decode($row['maximum']);
        $average = array_sum($a) / count($a);
        $emparray['avg'] = $average;
        $emparray['min'] = min($a);
        $emparray['max'] = max($a);
        $full[] = $emparray;
    }
    echo json_encode(['heart' => $full]);

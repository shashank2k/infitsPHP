<?php

$server="127.0.0.1:3306";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$userID = $_POST['userID'];
$dateandtime = date('Y-m-d h:i:s', strtotime($_POST['dateandtime']));
$goal = $_POST['goal'];
$type = $_POST['type'];
$amount = $_POST['amount'];
$consumed = $_POST['consumed'];

// $sql = "select drinkConsumed from watertracker where clientID='$userID' and date = '$date'";

// $result = mysqli_query($conn, $sql);

// if(mysqli_num_rows($result) == 0){
// $sql = "insert into watertracker values('$consumed','$goal','$date','$userID')";
// if (mysqli_query($conn,$sql)) {
//     echo "updated";
// }
// else{
//     echo "error";
// }
// }
// else{
//     $sql = "update watertracker set drinkConsumed = '$consumed',goal = '$goal' where clientID = '$userID' and date = '$date'";
//     if (mysqli_query($conn,$sql)) {
//         echo "updated";
//     }
//     else{
//         echo "error";
//     }   
// }

// $sql = "select drinkConsumed from watertrackerdt where clientID='$userID' and dateandtime = '$dateandtime'";
// $sql = "select drinkConsumed from watertrackerdt where clientID like'$userID' and DATE(`dateandtime`) = '$dateandtime'";
$sql = "SELECT drinkConsumed FROM watertrackerdt WHERE clientID='$userID' AND dateandtime LIKE '%$dateandtime%'";

// $liquid = 0;

$result = mysqli_query($conn, $sql);
print_r($result);

if(mysqli_num_rows($result) == 0){
    $sql = "insert into watertrackerdt values('$consumed','$goal','$dateandtime','$userID','$type','$amount')";
    if (mysqli_query($conn,$sql)) {
        echo "inserted";
    }
    else{
        echo "error";
    }
}
else{
    echo "not zero";
    while ($row = mysqli_fetch_assoc($result)) {
        $liquid = $row['drinkConsumed'];
    }

    $liquid += $amount;

    $sql = "DELETE FROM watertrackerdt WHERE clientID='$userID' AND dateandtime LIKE '%$dateandtime%'";
    // DELETE FROM `watertrackerdt` WHERE `clientID` = 'test' AND DATE(`dateandtime`) = '2023-04-01';

    if (mysqli_query($conn,$sql)) {
        echo "deleted";
    }
    else{
        echo "error";
    }

    
    $sql = "insert into watertrackerdt values('$liquid','$goal','$dateandtime','$userID','$type','$amount')";
    if (mysqli_query($conn,$sql)) {
        echo "updated";
    }
    else{
        echo "error";
    }
}

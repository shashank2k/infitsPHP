<?php

$server="127.0.0.1:3306";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);
// $conn = new mysqli("www.db4free.net", "infits_free_test", "EH6.mqRb9QBdY.U", "infits_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Kolkata');

$userID = $_POST['userID'];
$sleeptime = date('Y-m-d h:i:s',strtotime($_POST['sleeptime']));
$waketime = date('Y-m-d h:i:s',strtotime($_POST['waketime']));
$hrsslept = date('H',strtotime($_POST['timeslept']));
$goal = $_POST['goal'];
$minsslept = date('i',strtotime($_POST['timeslept']));

// $date = date('d-m-y h:i:s');
// echo $date;


// echo $sleeptime."  ";

// echo $waketime;

// $sql = "insert into sleeptracker values('$sleeptime','$waketime','$hrsslept','$minsslept','$goal','$userID')";
// $sql = "insert into sleeptracker values('$sleeptime','$waketime','$userID','$hrsslept','$goal','$minsslept')";
$sql = "INSERT INTO `sleeptracker` (`ID`, `sleeptime`, `waketime`, `clientID`, `hrsSlept`, `goal`, `minsSlept`) 
        VALUES (NULL, '$sleeptime', '$waketime', '$userID', '$hrsslept', '$goal', '$minsslept');";
// INSERT INTO `sleeptracker` (`ID`, `sleeptime`, `waketime`, `clientID`, `hrsSlept`, `goal`, `minsSlept`) VALUES (NULL, '2023-04-13 10:10:00', '2023-04-14 06:00:00', 'user1', '8', '10', '200');
// insert into sleeptracker values('2023-04-13 10:10:00','2023-04-14 06:00:00','Azarudeen','8','10','200')
if (mysqli_query($conn,$sql)) {
    echo "updated--";
}
else{
    echo "error";
}
?>
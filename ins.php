<?php

require "connect.php";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$date = date('Y-m-d');

$sql = "insert into watertracker values('4000','4500','$date','Azarudeen')";
if (mysqli_query($conn,$sql)) {
    echo "updated";
}
else{
    echo "error";
}

?>

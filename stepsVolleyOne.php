<?php 
require "connect.php";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	//$userID = $_POST['userID'];
//	$date = $_POST['date'];
	$userID = 'Azarudeen';
	$date = '2022-07-03';

	$stmnt = $conn -> prepare("SELECT SUM(steps) FROM `steptracker` WHERE cast(steptracker.dateandtime as DATE)=? and clientid=? ");
	
	$stmnt-> bind_param("ss",$date,$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($Sum);
	
	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['Sum']= $Sum;
	   
	  array_push($products,$temp);
	}


if(count($products)>-1){
echo json_encode($products);
}

else {
echo "failure";
}
?>

<?php 
// require "connect.php";
$server="127.0.0.1:3307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$userID = $_POST['userID'];
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	
	// $userID = "Azarudeen";
	// $date1 = date('Y-m-d',strtotime("19-03-2022"));;
	// $date2 = date('Y-m-d',strtotime("25-05-2022"));

	// '2022-07-03'

	$stmnt = $conn -> prepare("SELECT dateandtime,SUM(steps) FROM `steptracker` WHERE clientid=? AND dateandtime BETWEEN ? AND ? GROUP by dateandtime");
	
	$stmnt-> bind_param("sss",$userID,$date1,$date2);
	$stmnt-> execute();
	$stmnt-> bind_result($date,$Sum);
	
	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['date']= $date;
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
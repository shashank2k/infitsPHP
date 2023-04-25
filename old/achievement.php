<?php 
$server="127.0.0.1";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$userID = $_POST['userID'];
	$stmnt = $conn -> prepare("SELECT COUNT(clientID) FROM subscribedclient WHERE dietitianID=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($count);
	

	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['count']= $count;
	  
	  array_push($products,$temp);
	}

if(count($products)>0){
echo json_encode($products);
}
else {
echo "failure";
}
?>
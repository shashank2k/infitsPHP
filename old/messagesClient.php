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

	$dieticianID = $_POST['dieticianID'];
    $clientID = $_POST['clientID'];
	
$stmnt = $conn -> prepare("SELECT * FROM `messages` WHERE dietitianID=? and clientID=?");

$stmnt->bind_param("ss",$dieticianID,$clientID);
$stmnt->execute();
$stmnt-> bind_result($dieticianID,$clientID,$message,$messageBy,$time);



	$products = array();
	while($stmnt->fetch())
	{
	  $temp = array();
	  $temp['dieticianID']= $dieticianID;
	  $temp['clientID']= $clientID;
	$temp['message']= $message;
	$temp['messageBy']= $messageBy;
	$temp['time']=$time;
	  
	array_push($products,$temp);
	}
	
if(count($products)>-1){
echo json_encode($products);
}

else {
echo "failure";
}

?>
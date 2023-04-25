<?php 
$server="127.0.0.1:3307";
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
	$message = $_POST['message'];

  // $dieticianID = "Rahul";
  // $clientID = "Eden";
	// $message = "hyy";
	
$stmnt = $conn -> prepare("INSERT INTO `messages`(`dietitianID`, `clientID`, `message`, `messageBy`, `time`, `unread`) VALUES (?,?,?,'dietitian',CURRENT_TIMESTAMP,'U')");

$stmnt->bind_param("sss",$dieticianID,$clientID,$message);

if($stmnt->execute()){
echo "success";
}

else {
echo "failure";
}

?>
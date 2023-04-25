// getClientDetail.php
// getAppointmentDetail.php
// getPlan.php

<?php 
    // Database connection details
$server = "127.0.0.1:3306";
$username = "root";
$password = "";
$database = "infits";

// Create connection
$conn = mysqli_connect($server, $username, $password, $database);

// Check for errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

    $userID = $_POST['userID'];
	$stmnt = $conn -> prepare("SELECT * FROM `addclient` WHERE `name` LIKE ?");
	// $stmnt->bind_param("s",$userID);
    // $stmnt->execute();
	// $stmnt-> bind_result($clientuserID,$password,$name,$location,
	// $email,$mobile,$plan,$profilePhoto,$dietitianuserID,$gender,$age,$verification,$height,$weight);
	$stmnt->bind_param("s", $userID);
    $stmnt->execute();
    $row = $stmnt->get_result()->fetch_assoc();

    $clientuserID = "default";

    $imageName = "$clientuserID.jpg";
		$image = 'upload/'.$imageName;
	   $type = pathinfo($image, PATHINFO_EXTENSION);
	   $data = file_get_contents($image);

    $products = array();
	$products['dietitianuserID'] = $row['dietitianuserID'];
	$products['Clientname'] = $row['name'];
    // $products['clientPhoto']= base64_encode($data);
    $products['gender'] = $row['gender'];
    $products['email'] = $row['email'];
    $products['weight'] = $row['weight'];
    $products['height'] = $row['height'];
    $products['planID'] = $row['plan_id'];

    if(count($products) > 0)    
    {
        $products['error'] = "false";
        $products['message'] = "success";
    }
    else{
        $products['error'] = "true";
        $products['message'] = "failure";
    }

    //Dieticain Details

    $stmnt = $conn -> prepare("SELECT * FROM `dietitian` WHERE `dietitianuserID` = ?");

    $stmnt->bind_param("s",$products['dietitianuserID']);
    $stmnt->execute();
    $diet =  $stmnt->get_result()->fetch_assoc();

    $dietitianuserID = "default"; //change to dieticain id

		$imageName = "$dietitianuserID.jpg";
		$image = 'upload/'.$imageName;
	   $type = pathinfo($image, PATHINFO_EXTENSION);
	   $data = file_get_contents($image);
	  $products['Dieticianname']= $diet['name'];
	//   $products['dieticainPhoto']= base64_encode($data);


    //Plan Details

    $planID = $products['planID'];
    $stmnt = $conn->prepare("SELECT * FROM `createplan` WHERE `plan_id` = ?");
    $stmnt->bind_param("s", $planID);
    $stmnt->execute();
    $row = $stmnt->get_result()->fetch_assoc();

    // while ($row = $result->fetch_assoc()) {
    $products['Planname'] = $row['name'];
    $products['Planduration'] = $row['duration'];
    $products['Planprice'] = $row['price'];
    // $products['message'] = "yeahh";

    echo json_encode($products);

?>
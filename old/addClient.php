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

$dietitianID = $_POST['dietitianID'];

$clientName = $_POST['clientName'];

$gender = $_POST['gender'];

$age = $_POST['age'];

$height = $_POST['height'];

$weight = $_POST['weight'];

$about = $_POST['about'];

$description = $_POST['description'];

$title = $_POST['title'];

$plantitle = $_POST['plantitle'];

$plandescription = $_POST['plandescription'];

$referalcode = $_POST['referalcode'];

$sql = "insert into create_client values('$dietitianID','$clientName','$gender',$age,$height,$weight,'$about','$description','$title','$plantitle','$plandescription','$referalcode')";

if (mysqli_query($conn,$sql)) {
  echo "success";
}
else{
  echo "failed";
}

?>
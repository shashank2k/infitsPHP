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
$email = $_POST['email'];
$password = $_POST['password'];
$userID = $_POST['userID'];
$name = $_POST['name'];
$mobile = $_POST['phone'];
$age = $_POST['age'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$verification = $_POST['verification'];
$sql = "insert into client (clientuserID,password,name,email,mobile,age,verification,height,weight) VALUES ('$userID','$password',
	'$name','$email','$mobile','$age','$verification','$height','$weight');";
    try {
        if($conn->query($sql)){
            echo "success";
        }
    } catch (mysqli_sql_exception $th) {
        echo "UserName already taken";
    }
?>
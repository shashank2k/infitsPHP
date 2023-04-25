<?php

$server = "127.0.0.1:3306";
$username = "root";
$password = "";
$database = "infits";

$conn = mysqli_connect($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$referralCode = $_POST['referralCode'];

$sql = "select * from referral_table where referralCode = '$referralCode'";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

if(mysqli_num_rows($result) == 0) {
    echo "not found";
} else {
    echo "found";
}

?>
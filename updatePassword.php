<?php
$server = "127.0.0.1:3306";
$username = "root";
$password = "";
$database = "infits";
// Create connection
$conn = mysqli_connect($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['pass'];

$sql = "update client set password = '$pass' where email = '$email'";

if ($conn->query($sql)) {
    echo "success";
} else {
    echo "failure";
}

?>

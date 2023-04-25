<?php

$conn = new mysqli("www.db4free.net", "infits_free_test", "EH6.mqRb9QBdY.U", "infits_db");

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
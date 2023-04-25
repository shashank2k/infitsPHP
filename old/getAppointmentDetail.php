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
    $stmnt = $conn->prepare("SELECT * FROM appointment_booking WHERE event_name LIKE ?"); //change event name to userID/name
    $stmnt->bind_param("s", $userID);
    $stmnt->execute();
    $result = $stmnt->get_result();
    $full = array();

    while ($row = $result->fetch_assoc()) {
    $products = array();
    $products['event_name'] = $row['event_name'];
    $products['dieticain'] = $row['add_dietitian'];
    $products['appointment_type'] = $row['appointment_type'];
    $products['appointment_time'] = $row['appointment_time'];
    $full[] = $products;
    }

    echo json_encode(['plans' => $full]);

?>
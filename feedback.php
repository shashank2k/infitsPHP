<?php 
    // Database connection details
    $server = "127.0.0.1:3306";
    $username = "root";
    $password = "";
    $database = "infits";

    // Create connection
    $conn = mysqli_connect($server, $username, $password, $database);

    $result = array();

    // Check for errors
    if ($conn->connect_error) {
        $result['error'] = "true";
        $result['message'] =  $conn->connect_error;
    die("Connection failed: " . $conn->connect_error);
    }

    // if(isset($_POST['dietitianID']))

    $dieticianID = $_POST['dieticianID'];

    $clientID = $_POST['clientID'];

    $dietitian_rating = $_POST['dietitian_rating'];

    $app_rating = $_POST['app_rating'];

    $feedback = $_POST['feedback'];

    $stmt = $conn->prepare("INSERT INTO `feedback` (`rate_dietician`, `rate_overall_experience`, `feedback`, `client_id`, `dietician_id`)
                            VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss",$dietitian_rating,$app_rating,$feedback,$clientID,$dieticianID);

    if($stmt->execute()){
        // echo "success";
        $result['error'] = "false";
        $result['message'] =  "Values entered sucessfully";
    }
    else{
        $result['error'] = "true";
        $result['message'] =  "Values not entered";
    }

    echo json_encode($result);
  
?>
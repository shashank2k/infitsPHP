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

// Get appointment details from form
$event_name = $_POST["event_name"];
$add_dietitian = $_POST["add_dietitian"];
$appointment_time = $_POST["appointment_time"];
$description = $_POST["description"];
$attachment = $_POST["attachment"];
$select_schedule = $_POST["select_schedule"];
$timing_slots = $_POST["timing_slots"];
$appointment_type = $_POST["appointment_type"];
$file_type = $_POST["file_type"];
$file_name = $_POST["file_name"];


// Check if appointment time and dietitian are already occupied
$sql = "SELECT * FROM appointment_booking WHERE add_dietitian=? AND select_schedule=? AND timing_slots=? AND ((appointment_time >= ? AND appointment_time < DATE_ADD(?, INTERVAL 1 HOUR)) OR (DATE_ADD(appointment_time, INTERVAL 1 HOUR) > ? AND appointment_time <= ?))";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $add_dietitian, $select_schedule, $timing_slots, $appointment_time, $appointment_time, $appointment_time, $appointment_time);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Appointment time and dietitian are already occupied, return failure status
  $response = array("status" => "failure", "message" => "Appointment time is already occupied with this dietitian.");
} else {

 // Try to upload the file
  if(file_put_contents("upload/Appointments/$file_name".".jpg",base64_decode($attachment))){
    // File upload successful, insert appointment into database
    $sql = "INSERT INTO appointment_booking (event_name, add_dietitian, description, attachment, select_schedule, timing_slots, appointment_type, appointment_time, file_type) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $event_name, $add_dietitian, $description, $file_name, $select_schedule, $timing_slots, $appointment_type, $appointment_time, $file_type);
    $stmt->execute();

    // Check for errors
    if ($stmt->errno) {
      $response = array("status" => "error", "message" => $stmt->error);
    } else {
      // If successful, return confirmation message
      $response = array("status" => "success");
    }
  } else {
    // File upload failed, return failure status
    $response = array("status" => "failure1", "message" => "Failed to upload file.");
  }
}
echo json_encode($response);

// Close connection
$stmt->close();
$conn->close();
?>

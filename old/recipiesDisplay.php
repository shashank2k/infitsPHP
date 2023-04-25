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

// $dietianID = $_POST['dietianID'];

$dietianID = 'Rahul';

$sql = "select * from dietian_recipies where dietitianuserID = '$dietianID'";

$result = mysqli_query($conn,$sql);

$emparray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $emparray["name"] = $row["name"];
    $emparray["time"] = $row["time"];
    $emparray["serving"] = $row["serving"];
    $emparray["link"] = $row["link"];
    $emparray["calories"] = $row["calories"];
    $emparray["proteins"] = $row["proteins"];
    $emparray["fats"] = $row["fats"];
    $emparray["carbs"] = $row["carbs"];
    $emparray["fibres"] = $row["fibres"];
    $emparray["ingredient"] = $row["ingredient"];
    $emparray["category"] = $row["category"];
    $emparray["instruction"] = $row["instruction"];

    $imageName = $row['name']."$dietianID.jpg";
	$image = 'upload/Recipies/'.$imageName;
	$type = pathinfo($image, PATHINFO_EXTENSION);
	$data = file_get_contents($image);

    $emparray["image"] = base64_encode($data);
    $full[] = $emparray;
}

echo json_encode($full);

?>
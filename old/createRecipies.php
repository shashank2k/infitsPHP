<?php 

$server="127.0.0.1:3307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$dietianID = $_POST['dietianID'];
$name = $_POST['name'];
$time = $_POST['time'];
$serving = $_POST['serving'];
$link = $_POST['link'];
$image = $_POST['image'];
$calories = $_POST['calories'];
$proteins = $_POST['proteins'];
$fats = $_POST['fats'];
$fibres = $_POST['fibres'];
$carbs = $_POST['carbs'];
$ingredient = $_POST['ingredients'];
$instruction = $_POST['instruction'];
$files = $_POST['files'];
$category = $_POST['category'];

$sql = "insert into dietian_recipies values('$name','$time',$serving,'$link','$calories','$proteins','$fats','$fibres','$carbs','$ingredient','$instruction','$category','$dietianID','$image',$files)";

if (mysqli_query($conn,$sql)) {
  if (file_put_contents("upload/Recipies/"."$name$dietianID",base64_decode($image))){
    echo "updated";
}
}
else {
    echo "failure";
}

?>
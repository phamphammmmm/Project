<?php
require_once 'connect.php';
mysqli_select_db($conn,"restaurant");

if(isset($_GET['id'])){
    $id=$_GET['id'];

//take info from database
$query="SELECT*FROM meals WHERE meal_id=$id";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);

$sql="DELETE FROM meals WHERE meal_id=$id";
mysqli_query($conn,$sql);

//update all of values meal_id in database
mysqli_query($conn,"SET @num := 0; ");
mysqli_query($conn,"UPDATE meals SET meal_id = @num:= (@num+1);");
mysqli_query($conn,"ALTER TABLE meals AUTO_INCREMENT =1;");
}

//redirect to meals page
header("Location: meal.php");
exit();
?>
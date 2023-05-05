<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id=$_GET['id'];

    //lấy thông tin của bữa ăn với id truyền vào
    $sql="SELECT * FROM meals WHERE meal_id=$id";
    $result = mysqli_query($conn,$sql);
    $row =mysqli_fetch_assoc($result);
    $meal_name = $row['meal_name'];
    $item_name = $row['item_name'];
}

if(isset($_POST['save'])){
    $id = $_GET['id'];
    $item_name=$_POST['item_name'];
    $meal_name=$_POST['meal_name'];

    //cập nhật thông tin bữa ăn
    $sql="UPDATE meals SET item_name='$item_name', meal_name='$meal_name' WHERE meal_id=$id";
    mysqli_query($conn,$sql);

    $conn->close();
    header("Location: meal.php");

    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Meal</title>
</head>

<body>
    <form method="POST" action="edit_meal.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <label for="meal_name">Meal Name:</label>
        <select id="meal_name" name="meal_name" required>
            <option value="">Select a meal</option>
            <option value="Regular">Regular</option>
            <option value="Lunch">Lunch</option>
            <option value="Snacks">Snacks</option>
            <option value="Dessert">Dessert</option>
            <option value="Beverages">Beverages</option>
        </select>
        <br>
        <label for="item_name">Item name:</label>
        <input type="text" name="item_name" value="<?php echo $item_name?>">
        <br>
        <button type="submit" name="save">Save</button>
    </form>
</body>

</html>
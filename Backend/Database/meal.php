<?php
require_once 'connect.php';
// require_once 'gallery.php';
mysqli_select_db($conn,"restaurant");

$meal_name="";
$item_name="";
$meal_info = array(); // Khai báo biến lưu trữ thông tin món
$gallery_options = array(); // Khai báo một mảng để lưu trữ danh sách tùy chọn cho trường tìm kiếm

// Lấy danh sách tên item_name từ bảng gallery
$query = "SELECT DISTINCT item_name FROM gallery ORDER BY item_name ASC";
$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $gallery_options[] = $row['item_name'];
    }
}

$meal_id = ""; // or some other default value
if (isset($_POST['search'])) {
    $item_name = $_POST['item_name'];
    $query = "SELECT * FROM gallery WHERE item_name = '$item_name'";
    $result = mysqli_query($conn, $query);
    $meal_info = mysqli_fetch_assoc($result);
    $meal_name = $meal_info['item_name'];
}

if(isset($_POST['save'])){
    $meal_name=$_POST['meal_name'];
    $item_name=$_POST['item_name'];

    // Kiểm tra giá trị được nhập vào trường meal_name
    $valid_meal_names = array('Regular', 'Lunch', 'Snacks', 'Dessert', 'Beverages');
    if(!in_array($meal_name, $valid_meal_names)){
        echo "Invalid meal name";
        exit;
    }

    // Kiểm tra giá trị được nhập vào trường item_name
    $valid_item_names = array_map(function($option){ return $option; }, $gallery_options);
    if(!in_array($item_name, $valid_item_names)){
        echo "Invalid item name";
        exit;
    }
    
    $sql="INSERT INTO `meals` (`meal_name`, `item_name`) VALUES ('$meal_name','$item_name')";
    mysqli_query($conn,$sql);
}

$query="SELECT*FROM meals";
$result=mysqli_query($conn,$query);
$meals=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Meals Form</title>
    <style>
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input,
    textarea {
        margin: 10px;
        padding: 5px;
        width: 300px;
        border-radius: 5px;
        border: none;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    button {
        margin: 10px;
        padding: 5px;
        border-radius: 5px;
        border: none;
        background-color: #4CAF50;
        color: white;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    table {
        margin-top: 20px;
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    </style>
</head>

<body>
    <h1>Meal Form</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="meal_id" value="<?php echo $meal_id?>">
        <label for="meal_name">Meal name:</label>
        <select id="meal_name" name="meal_name" required>
            <option value="">Select a meal</option>
            <option value="Regular">Regular</option>
            <option value="Lunch">Lunch</option>
            <option value="Snacks">Snacks</option>
            <option value="Dessert">Dessert</option>
            <option value="Beverages">Beverages</option>
        </select>

        <label for="item_name">Item name:</label>
        <input type="text" id="item_name" name="item_name" list="item_list" required>
        <datalist id="item_list">
            <?php foreach($gallery_options as $option): ?>
            <option value="<?= $option ?>"><?php echo $option ?></option>
            <?php endforeach; ?>
        </datalist>


        <button type="submit" name="save">Save</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Meal</th>
                <th>Item</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($meals as $row) {?>
            <tr>
                <td><?php echo $row['meal_id']?></td>
                <td><?php echo $row['meal_name']?></td>
                <td><?php echo $row['item_name']?></td>
                <?php
                $item_query = "SELECT * FROM gallery WHERE item_name='".$row['item_name']."'";
                $item_result = mysqli_query($conn, $item_query);
                $item = mysqli_fetch_assoc($item_result);
                ?>
                <td><?php echo $item['price_item'] ?></td>
                <td><?php echo $item['item_description'] ?></td>
                <td><img src="<?php echo $item['image_path']; ?>" width="100"></td>
                <td>
                    <button><a href="edit_meal.php?id=<?php echo $row['meal_id']?>">Edit</a><button>
                            <button><a href="delete_meal.php?id=<?php echo $row['meal_id']?>">Delete</a><button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>


</html>
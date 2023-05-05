<?php
require_once 'connect.php';
mysqli_select_db($conn, 'restaurant');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = 1; // Thay đổi giá trị customer_id tương ứng
    $meal_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = 100; // Thay đổi giá trị price tương ứng
    add_to_cart($customer_id, $meal_id, $quantity, $price);
}

// Thêm sản phẩm vào giỏ hàng
function add_to_cart($customer_id, $meal_id, $quantity, $price) {
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT * FROM cart WHERE customer_id = ? AND meal_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $customer_id, $meal_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        // Sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
        $row = mysqli_fetch_assoc($result);
        $new_quantity = $row['quantity'] + $quantity;
        $new_price = $row['price'] + $price;
        $stmt = mysqli_prepare($conn, "UPDATE cart SET quantity = ?, price = ? WHERE cart_id = ?");
        mysqli_stmt_bind_param($stmt, "idi", $new_quantity, $new_price, $row['cart_id']);
        mysqli_stmt_execute($stmt);
    } else {
        // Sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
        $stmt = mysqli_prepare($conn, "INSERT INTO cart (customer_id, meal_id, quantity, price) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iiid", $customer_id, $meal_id, $quantity, $price);
        mysqli_stmt_execute($stmt);
    }
}


// Lấy dữ liệu từ bảng cart
$query = "SELECT * FROM cart";
$result = mysqli_query($conn, $query);
$cart = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Tính tổng tiền của giỏ hàng
$total_price = 0;
foreach ($cart as $item) {
$total_price += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    
</head>

<body>
    <h1>Cart</h1>
    <table>
        <thead>
            <tr>
                <div id="cart-info">
                    <p>Giỏ hàng của bạn hiện có <?php echo count($cart); ?> sản phẩm.</p>
                    <p>Tổng tiền: <?php echo $total_price; ?> đồng.</p>
                </div>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $item) { ?>
            <tr>
                <td><img src="<?php echo $item['image_path'] ?>"></td>
                <td><?php echo $item['item_name'] ?></td>
                <td><?php echo $item['item_description'] ?></td>
                <td><?php echo number_format($item['price'])?></td>
                <td>
                    <form method="POST" action="update_cart.php">
                        <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?>">
                        <input type="number" name="quantity" value="<?php echo $item['quantity'] ?>">
                        <button type="submit" name="update">Update</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="update_cart.php">
                        <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?>">
                        <button type="submit" name="remove">Remove</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
</body>

</html>



<!-- <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 100px;
        max-height: 100px;
    }

    .quantity {
        width: 50px;
        text-align: center;
    }

    .total {
        font-weight: bold;
    }

    .button {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .button:hover {
        background-color: #3e8e41;
    }
    </style> -->
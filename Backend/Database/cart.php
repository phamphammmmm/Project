<?php
require_once 'connect.php';
mysqli_select_db($conn, 'restaurant');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price=$_POST['price'];

    // Truy vấn để lấy thông tin sản phẩm từ bảng meals
    $stmt_meal = mysqli_prepare($conn, "SELECT * FROM meals WHERE item_name = ?");
    mysqli_stmt_bind_param($stmt_meal, "s", $item_name);
    mysqli_stmt_execute($stmt_meal);
    $result_meal = mysqli_stmt_get_result($stmt_meal);
    $row_meal = mysqli_fetch_assoc($result_meal);
    $meal_id = $row_meal['meal_id'];

    // Truy vấn để lấy thông tin sản phẩm từ bảng gallery
    $stmt_gallery = mysqli_prepare($conn, "SELECT * FROM gallery WHERE item_name = ?");
    mysqli_stmt_bind_param($stmt_gallery, "s", $item_name);
    mysqli_stmt_execute($stmt_gallery);
    $result_gallery = mysqli_stmt_get_result($stmt_gallery);
    $row_gallery = mysqli_fetch_assoc($result_gallery);
    $description = $row_gallery['item_description'];
    $image_path = $row_gallery['image_path'];

    // Lấy customer_id từ session
    $customer_id = $_SESSION['customer_id'];

    add_to_cart($conn, $customer_id, $meal_id, $quantity, $price, $description, $image_path);
}

// Thêm sản phẩm vào giỏ hàng
function add_to_cart($conn, $customer_id, $meal_id, $quantity, $price, $description, $image_path) {
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        $item_id = $_POST['item_id'];
        remove_from_cart($conn, $item_id);
    }
}

// Function to remove item from cart
function remove_from_cart($conn, $item_id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE meal_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $item_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: cart.php"); // Redirect back to cart page
    exit();
}


    // Lấy dữ liệu từ bảng cart
    $query = "SELECT * FROM cart WHERE customer_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['customer_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cart = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Tính tổng tiền của giỏ hàng
$total_price = 0;
foreach ($cart as $item) {
    if (is_numeric($item['price']) && is_numeric($item['quantity'])) {
        $total_price += $item['price'] * $item['quantity'];
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>

</head>

<body>
    <h1>Cart</h1>
    <div id="cart-info">
        <p>Giỏ hàng của bạn hiện có <?php echo count($cart); ?> sản phẩm.</p>
        <p>Tổng tiền: <?php echo $total_price; ?> đồng.</p>
    </div>
    <table>
        <thead>
            <tr>
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
            <?php foreach ($cart as $item) {
                $meal_id = $item['meal_id'];
                $stmt = mysqli_prepare($conn, "SELECT meals.item_name, gallery.image_path, gallery.item_description FROM meals INNER JOIN gallery ON meals.item_name = gallery.item_name WHERE meals.meal_id = ?");
                mysqli_stmt_bind_param($stmt, "i", $meal_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                if ($row) { ?>
            <tr>
                <td><img src="<?php echo $row['image_path']; ?>"></td>
                <td><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['item_description']; ?></td>
                <td><?php echo number_format($item['price']); ?></td>
                <td>
                    <form method="POST" action="update_cart.php">
                        <input type="hidden" name="item_id" value="<?php echo $item['meal_id']; ?>">
                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>">
                        <button type="submit" name="update">Update</button>
                    </form>
                </td>
                <td><?php echo number_format($item['price'] * $item['quantity']); ?></td>
                <td>
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="item_id" value="<?php echo $item['meal_id']; ?>">
                        <button type="submit" name="remove"
                            onclick="return confirm('Are you sure you want to remove this item from the cart?')">Remove</button>
                    </form>

                </td>
            </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <script>
    function updateCart(itemID) {
        var form = document.getElementById('update-form-' + itemID);
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_cart.php', true);
        xhr.onload = function() {
            // Handle the response here if needed
        };
        xhr.send(formData);
    }
    </script>

</body>

</html>
<style>
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
</style>

</html>
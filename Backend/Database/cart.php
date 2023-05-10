<?php
require_once 'connect.php';
include 'header.php';
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

    if (isset($_POST['remove'])) {
        $cart_id = $_POST['item_id'];
        remove_from_cart($conn, $cart_id);
    }

    // Lấy dữ liệu từ bảng cart
    $query = "SELECT cart.*, meals.item_name, gallery.image_path, gallery.item_description 
    FROM cart
    INNER JOIN meals ON cart.meal_id = meals.meal_id
    INNER JOIN gallery ON meals.item_name = gallery.item_name
    WHERE cart.customer_id = ?";

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
    <form id="cart-form" method="POST" action="checkout.php">
        <table>
            <thead>
                <tr>
                    <th>Tích đi em iu</th>
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
                    <td><input type="checkbox" name="selected_items[]" value="<?php echo $item['cart_id']; ?>"></td>
                    <td><img src="uploads/<?php echo $item['image_path']; ?>"></td>
                    <td><?php echo $item['item_name']; ?></td>
                    <td><?php echo $item['item_description']; ?></td>
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
                        <button type="button" onclick="removeItem(<?php echo $item['meal_id']; ?>)">Remove</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="submit">Buy Now</button>
    </form>

    <script>
    document.getElementById('cart-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn form gửi đi

        // Lấy giá trị của các nút tích
        var checkboxes = document.getElementsByName('selected_items[]');
        var selectedItems = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedItems.push(checkboxes[i].value);
            }
        }

        // Hiển thị giá trị trên console
        console.log(selectedItems);

        // Tiếp tục xử lý gửi form đến trang "checkout.php" nếu cần thiết
        var form = document.getElementById('cart-form');
        var selectedItemsInput = document.createElement('input');
        selectedItemsInput.setAttribute('type', 'hidden');
        selectedItemsInput.setAttribute('name', 'selected_items');
        selectedItemsInput.setAttribute('value', selectedItems.join(','));
        form.appendChild(selectedItemsInput);

        // Gửi form đến trang checkout.php
        form.submit();
    });
    </script>

</body>

<style>
body {
    margin-top: 50px;
}

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
    color: white;
    text-decoration: none;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.button:hover {
    /* background-color: #3e8e41; */
}
</style>

</html>
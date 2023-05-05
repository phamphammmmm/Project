<?php
require_once 'connect.php';
mysqli_select_db('$conn','restaurant');

require_once 'connect.php';
mysqli_select_db($conn, 'restaurant');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get the data from the request
$customer_id = $_POST['customer_id'];
$meal_id = $_POST['meal_id'];
$quantity = $_POST['quantity'];

// Check if the quantity is zero, if yes then remove the item from the cart
if ($quantity == 0) {
    $sql = "DELETE FROM cart WHERE customer_id=$customer_id AND meal_id=$meal_id";
    mysqli_query($conn, $sql);
} else {
    // Update the quantity in the cart
    $sql = "UPDATE cart SET quantity=$quantity WHERE customer_id=$customer_id AND meal_id=$meal_id";
    mysqli_query($conn, $sql);
}

// Return a success message
echo "Cart updated successfully";
} else {
// Return a 405 Method Not Allowed error
http_response_code(405);
echo "Method Not Allowed";
}
?>
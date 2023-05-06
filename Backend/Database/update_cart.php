<?php
require_once 'connect.php';
mysqli_select_db($conn, 'restaurant');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Update quantity in cart
    update_cart_quantity($conn, $item_id, $quantity);
}

// Function to update quantity in cart
function update_cart_quantity($conn, $item_id, $quantity) {
    $stmt = mysqli_prepare($conn, "UPDATE cart SET quantity = ? WHERE meal_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $quantity, $item_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: cart.php"); // Redirect back to cart page
    exit();
}
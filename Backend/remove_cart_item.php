<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove']) && isset($_POST['item_id'])) {
        $cart_id = $_POST['item_id'];
        remove_from_cart($conn, $cart_id);
    }
}

function remove_from_cart($conn, $cart_id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE cart_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $cart_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: cart.php");
    exit();
}
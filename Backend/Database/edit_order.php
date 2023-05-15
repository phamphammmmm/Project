<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $customer_name = $_POST['customer_name'];
    $phone_order = $_POST['phone_order'];
    $address = $_POST['address'];

    // Update the order in the database
    $sql = "UPDATE orders SET customer_id = '$customer_id', order_date = '$date', order_time = '$time', customer_name = '$customer_name', phone_order = '$phone_order', address = '$address' WHERE order_id = '$order_id'";
    if ($conn->query($sql) === TRUE) {
        $message = "Order updated successfully.";
        header('Location: order_admin.php');
        exit();
    } else {
        $message = "Error updating order: " . $conn->error;
    }
}

// Get the order ID from the URL parameter
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve the order information from the database
    $sql = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Order</title>
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

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    h1 {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    form {
        border: 2px solid black;
        max-width: 400px;
        margin: 0 auto;
        padding: 20px 40px;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="textarea"] {
        margin: 0;
    }

    input[type="text"],
    input[type="date"],
    input[type="email"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <h1>Edit Order</h1>
    <?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">

        <label for="customer_id">Customer ID:</label>
        <input type="text" id="customer_id" name="customer_id" value="<?php echo $row['customer_id']; ?>" required>
        <br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $row['order_date']; ?>" required>
        <br>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" value="<?php echo $row['order_time']; ?>" required>
        <br>

        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" value="<?php echo $row['customer_name']; ?>"
            required>
        <br>

        <label for="phone_order">Contact Phone:</label>
        <input type="text" id="phone_order" name="phone_order" value="<?php echo $row['phone_order']; ?>" required>
        <br>

        <label for="address">Contact Email:</label>
        <input type="email" id="address" name="address" value="<?php echo $row['address']; ?>" required>
        <br>

        <input type="submit" value="Save">
    </form>

</body>

</html>
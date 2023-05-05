<?php
// Start a session
session_start();


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if they are not logged in
    header('Location: login.php');
    exit();
}
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the form
    $customer_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $number_of_guests = $_POST['number_of_guests'];
    $meals = $_POST['meals'];

    // Insert the order into the database
    $sql = "INSERT INTO orders (customer_id, order_date, order_time) VALUES ('$customer_id', '$date', '$time')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;
        foreach ($meals as $meal_id => $quantity) {
            $sql = "INSERT INTO order_detail (order_id, meal_id, quantity, price) VALUES ('$order_id', '$meal_id', '$quantity', '0')";
            $conn->query($sql);
        }
        $sql = "UPDATE orders SET total_price = (SELECT SUM(quantity * price) FROM order_detail WHERE order_id = '$order_id') WHERE order_id = '$order_id'";
        $conn->query($sql);
        $message = "Order placed successfully.";
    } else {
        $message = "Error placing order: " . $conn->error;
    }
    // Close the database connection
    $conn->close();
}

// Retrieve the customer's order history
$sql = "SELECT * FROM orders WHERE customer_id = '".$_SESSION['user_id']."'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Place an Order</title>
</head>

<body>
    <h1>Place an Order</h1>
    <?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>
        <br>
        <label for="number_of_guests">Number of guests:</label>
        <input type="number" id="number_of_guests" name="number_of_guests" min="1" max="10" required>
        <br>
        <?php
        // Retrieve the meals from the database
        $sql = "SELECT * FROM meals";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<input type="checkbox" id="meal_'.$row['id'].'" name="meals['.$row['id'].']" value="'.$row['id'].'">';
                echo '<label for="meal_'.$row['id'].'">'.$row['name'].' - $'.$row['price'].'</label><br>';
            }
        }
        ?>
        <br>
        <input type="submit" value="Place Order">
    </form>

    <?php
    // Display the customer's order history
    if ($result->num_rows > 0) {
        echo '<h2>Order History</h2>';
        echo '<table>';
        echo '<tr><th>Order ID</th><th>Date</th><th>Time</th><th>Total Price</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['order_id'] . '</td>';
            echo '<td>' . $row['order_date'] . '</td>';
            echo '<td>' . $row['order_time'] . '</td>';
            echo '<td>' . $row['total_price'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>
</body>
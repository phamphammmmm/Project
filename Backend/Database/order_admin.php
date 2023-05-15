<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

// DELETE: Delete an order
if (isset($_POST['delete'])) {
    $order_id = $_POST['order_id'];

    $sql = "DELETE FROM orders WHERE order_id = '$order_id'";
    if ($conn->query($sql) === TRUE) {
        $message = "Order deleted successfully.";
    } else {
        $message = "Error deleting order: " . $conn->error;
    }
}

// READ: Retrieve orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    table {
        margin: 20px;
        width: 97%;
        border-collapse: collapse;
    }

    table thead th {
        background-color: #36304a;
        color: white;
        padding: 10px;
    }

    table tbody tr td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tbody tr:nth-child(odd) {
        background-color: #fff;
    }

    table tbody tr:hover {
        background-color: #e5e5e5;
    }

    table tbody td {
        text-align: center;
    }

    table tbody td:last-child {
        border-bottom: none;
    }

    button {
        margin: 2px;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        background-color: #2ecc71;
        cursor: pointer;
    }

    button a {
        color: white;
        text-decoration: none;
    }

    button:hover {
        background-color: #27ae60;
    }

    button:active {
        background-color: #1e8449;
    }

    i {
        padding: 5px;
        color: black;
    }

    .ID {
        border-radius: 15px 0 0;
    }
    </style>
</head>

<body>

    <!-- Display Orders -->

    <?php if ($result->num_rows > 0): ?>
    <h2 style="text-align:center;">Order List</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Customer Name</th>
                <th>Phone order</th>
                <th>Address order</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['customer_id']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td><?php echo $row['order_time']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['phone_order']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
                <a href="edit_order.php?order_id=<?php echo $row['order_id']; ?>"><i
                        class="fa-regular fa-pen-to-square"></i></a>
                <a href="delete_order.php?order_id=<?php echo $row['order_id']; ?>"> <i
                        class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php endif; ?>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
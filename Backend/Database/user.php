<?php
// session_start();
// if (empty($_SESSION['loggedin'])) {
//     header('Location:user.php');
//     exit();
// }
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

$sql = "SELECT * FROM customers";

$result = $conn->query($sql);
$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
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
    <?php if (!empty($users)) : ?>
    <table>
        <thead>
            <tr>
                <th style="border-radius: 15px 0px 0px;">ID</th>
                <th>User</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Number phone</th>
                <th>Email</th>
                <th>Admin</th>
                <th style="border-radius: 0 15px 0 0;">
                    <div class="Action">Action</div>
                </th>
            </tr>
        </thead>
        <tbody class="infor_customer">
            <?php foreach ($users as $user) : ?>
            <tr>
                <td>
                    <div class="customer_id"><?php echo $user['customer_id']; ?></div>
                </td>
                <td>
                    <div class="user_name"><?php echo $user['user_name']; ?></div>
                </td>
                <td>
                    <div class="cutomer_name"><?php echo $user['customer_name']; ?></div>
                </td>
                <td>
                    <div class="customer_date"><?php echo $user['customers_date']; ?></div>
                </td>
                <td>
                    <div class="contact_phone"><?php echo $user['contact_phone']; ?></div>
                </td>
                <td>
                    <div class="contact_email"><?php echo $user['contact_email']; ?></div>
                </td>
                <td>
                    <div class=""><?php echo $user['is_admin']; ?></div>
                </td>
                <td>
                    <a href="edit_user.php?id=<?php echo $user['customer_id']; ?>">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a href="delete_user.php?id=<?php echo $user['customer_id']; ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php else : ?>
    <p>Không có người dùng nào.</p>
    <?php endif; ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
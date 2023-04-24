<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

function delete_user($user_id) {
    global $conn;
    $sql = "DELETE FROM customers WHERE customer_id = " . $user_id;
    if ($conn->query($sql) === TRUE) {
        echo "Người dùng đã được xóa thành công";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    delete_user($user_id);
}

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
</head>

<body>
    <h1>User</h1>
    <?php if (!empty($users)) : ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên đăng nhập</th>
                <th>Tên khách hàng</th>
                <th>Ngày đăng ký</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['customer_id']; ?></td>
                <td><?php echo $user['user_name']; ?></td>
                <td><?php echo $user['customer_name']; ?></td>
                <td><?php echo $user['customers_date']; ?></td>
                <td><?php echo $user['contact_phone']; ?></td>
                <td><?php echo $user['contact_email']; ?></td>
                <td><?php echo $user['is_admin']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $user['customer_id']; ?>">Sửa</a> |
                    <a href="delete_user.php?id=<?php echo $user['customer_id']; ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
    <p>Không có người dùng nào.</p>
    <?php endif; ?>
</body>

</html>
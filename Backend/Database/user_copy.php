<?php
//  session_start();
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

</head>

<body>
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
                <!-- Thêm nút "Sửa" vào cột Hành động -->
                <td>
                    <button class="edit-btn" data-id="<?php echo $user['customer_id']; ?>">Sửa</button>
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
    <script>
    // Sử dụng JavaScript và AJAX để tạo ra form sửa
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.dataset.id;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `edit_user_copy.php?id=${userId}`);
            xhr.onload = () => {
                if (xhr.status === 200) {
                    const row = button.closest('tr');
                    row.outerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    });
    </script>
</body>

</html>
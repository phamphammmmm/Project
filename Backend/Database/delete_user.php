<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

function delete_user($user_id) {
    global $conn;

    // Xóa khách hàng
    $sql = "DELETE FROM customers WHERE customer_id = " . $user_id;
    if ($conn->query($sql) === TRUE) {
        echo "Người dùng đã được xóa thành công";

        // Cập nhật lại customer_id
        $sql = "SELECT customer_id FROM customers ORDER BY customer_id ASC";
        $result = $conn->query($sql);
        $new_id = 0;
        while ($row = $result->fetch_assoc()) {
            $old_id = $row['customer_id'];
            $sql = "UPDATE customers SET customer_id = " . $new_id . " WHERE customer_id = " . $old_id;
            $conn->query($sql);
            $new_id++;
        }

        // Cập nhật lại customer_id trong các bảng khác tham chiếu đến bảng customers
        $sql = "UPDATE orders SET customer_id = NULL WHERE customer_id = " . $user_id;
        $conn->query($sql);
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    delete_user($user_id);
}

$conn->close();
header('Location: user.php');
exit();
?>
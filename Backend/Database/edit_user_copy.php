<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

function update_user($user_id, $user_name, $customer_name, $customers_date, $contact_phone, $contact_email, $is_admin) {
    global $conn;
    $sql = "UPDATE customers SET user_name='$user_name', customer_name='$customer_name', customers_date='$customers_date', contact_phone='$contact_phone', contact_email='$contact_email', is_admin='$is_admin' WHERE customer_id = " . $user_id;
    if ($conn->query($sql) === TRUE) {
        // echo "Thông tin người dùng đã được cập nhật thành công";
        header("Location: user_copy.php"); // chuyển hướng về trang user.php
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $customer_name = $_POST['customer_name'];
    $customers_date = $_POST['customers_date'];
    $contact_phone = $_POST['contact_phone'];
    $contact_email = $_POST['contact_email'];
    $is_admin = $_POST['is_admin'];
    update_user($user_id, $user_name, $customer_name, $customers_date, $contact_phone, $contact_email, $is_admin);

    // kiểm tra nếu các trường dữ liệu không được điền đầy đủ
    if (empty($user_name) || empty($customer_name) || empty($contact_phone) || empty($contact_email)) {
        $error_msg = "Vui lòng nhập đầy đủ thông tin.";
    } else {
        // cập nhật thông tin người dùng trong database
        $sql = "UPDATE customers SET user_name='$user_name', customer_name='$customer_name', contact_phone='$contact_phone', contact_email='$contact_email', is_admin='$is_admin' WHERE customer_id=$user_id";

        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thông tin người dùng thành công";
            $conn->close();
            exit;
        }
        
        
    }
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM customers WHERE customer_id = ".$user_id;
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    $conn->close();
} else {
    echo "Lỗi: Không có ID người dùng được cung cấp.";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa người dùng</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            // Ngăn chặn trình duyệt gửi yêu cầu đến server và tải lại trang.
            event.preventDefault();

            // Lấy dữ liệu từ form.
            var user_id = $("input[name=user_id]").val();
            var user_name = $("input[name=user_name]").val();
            var customer_name = $("input[name=customer_name]").val();
            var customers_date = $("input[name=customers_date]").val();
            var contact_phone = $("input[name=contact_phone]").val();
            var contact_email = $("input[name=contact_email]").val();
            var is_admin = $("select[name=is_admin]").val();

            // Gửi yêu cầu AJAX đến server.
            $.ajax({
                url: 'update_user.php',
                type: 'POST',
                data: {
                    user_id: user_id,
                    user_name: user_name,
                    customer_name: customer_name,
                    customers_date: customers_date,
                    contact_phone: contact_phone,
                    contact_email: contact_email,
                    is_admin: is_admin
                },
                success: function(response) {
                    // Thông báo cập nhật thành công.
                    alert("Cập nhật thông tin người dùng thành công!");

                    // Chuyển hướng về trang user_copy.php.
                    window.location.href = 'user_copy.php';
                },
                error: function(xhr, status, error) {
                    // Thông báo lỗi.
                    alert("Lỗi: " + xhr.responseText);
                }
            });
        });
    });
    </script>
</head>

<body>
    <h1>Sửa người dùng</h1>
    <form method="post" action="">
        <input type="hidden" name="user_id" value="<?php echo $user['customer_id']; ?>">
        <label>Tên đăng nhập:</label>
        <input type="text" name="user_name" value="<?php echo $user['user_name']; ?>"><br>
        <label>Tên khách hàng:</label>
        <input type="text" name="customer_name" value="<?php echo $user['customer_name']; ?>"><br>
        <label>Ngày đăng ký:</label>
        <input type="date" name="customers_date" value="<?php echo $user['customers_date']; ?>"><br>
        <label>Số điện thoại:</label>
        <input type="text" name="contact_phone" value="<?php echo $user['contact_phone']; ?>"><br>
        <label>Email:</label>
        <input type="email" name="contact_email" value="<?php echo $user['contact_email']; ?>"><br>
        <label>Admin:</label>
        <select name="is_admin">
            <option value="1" <?php if ($user['is_admin'] == 1) echo 'selected'; ?>>Có</option>
            <option value="0" <?php if ($user['is_admin'] == 0) echo 'selected'; ?>>Không</option>
        </select><br>
        <input type="submit" name="submit" value="Cập nhật">

    </form>
</body>

</html>
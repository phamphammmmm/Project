<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

function update_user($user_id, $user_name, $customer_name, $customers_date, $contact_phone, $contact_email, $is_admin) {
    global $conn;
    $sql = "UPDATE customers SET user_name='$user_name', customer_name='$customer_name', customers_date='$customers_date', contact_phone='$contact_phone', contact_email='$contact_email', is_admin='$is_admin' WHERE customer_id = " . $user_id;
    if ($conn->query($sql) === TRUE) {
        // echo "Thông tin người dùng đã được cập nhật thành công";
        header("Location: user.php"); // chuyển hướng về trang user.php
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
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    h1 {
        margin-bottom: 20px;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="email"],
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
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
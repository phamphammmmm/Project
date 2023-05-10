<?php
require_once 'connect.php';
include 'header.php';
mysqli_select_db($conn, 'restaurant');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_items = isset($_POST['selected_items']) ? $_POST['selected_items'] : '';
    $selected_items = is_string($selected_items) ? explode(',', $selected_items) : [];

    // Hiển thị thông tin sản phẩm dựa trên cart_id
    echo '<table class="product">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';
            
    $totalPrice = 0; // Biến lưu tổng số tiền

    foreach ($selected_items as $cart_id) {
        $stmt = mysqli_prepare($conn, "SELECT cart.*, meals.item_name, gallery.image_path, gallery.item_description 
        FROM cart
        INNER JOIN meals ON cart.meal_id = meals.meal_id
        INNER JOIN gallery ON meals.item_name = gallery.item_name
        WHERE cart.cart_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $cart_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $item = mysqli_fetch_assoc($result);

        // Hiển thị thông tin sản phẩm
        
        echo '<tr>
                <td><img src="uploads/' . $item['image_path'] . '" alt="' . $item['item_name'] . '"></td>
                <td>' . $item['item_name'] . '</td>
                <td>' . $item['item_description'] . '</td>
                <td>' . $item['price'] . '</td>
                <td>' . $item['quantity'] . '</td>
                <td>' . ($item['price'] * $item['quantity']) . '</td>
            </tr>';
            
        // Tính tổng số tiền
        $totalPrice += ($item['price'] * $item['quantity']);
    }

    echo '</tbody>
    </table>';
    // Hiển thị tổng số tiền
    echo '<p>Total Price: ' . $totalPrice . '</p>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <style>
    /* Thiết lập các kiểu cho form */
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    form #search-box {
        padding: 10px
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"] {
        width: 95%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Thiết lập kiểu cho các sản phẩm */
    body {
        margin-top: 100px;
    }

    .product {
        margin-bottom: 20px;
    }

    .product img {
        width: 100px;
        height: auto;
        margin-bottom: 10px;
    }

    .product .name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .product .description {
        margin-bottom: 5px;
    }

    .product .price {
        font-weight: bold;
    }
    </style>
</head>

<body>

    <!-- Form thanh toán -->
    <form id="payment-form" method="POST" action="process_payment.php">
        <fieldset>
            <legend>Thông tin người dùng</legend>
            <label for="name">Họ tên:</label>
            <input type="text" name="name" id="name" required maxlength="100">

            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" id="address" required>

            <label for="note">Tin nhắn:</label>
            <input type="text" name="note" id="note" required placeholder="Note for restaurant">
        </fieldset>

        <fieldset>
            <legend>Thông tin thanh toán</legend>
            <label for="card_number">Số thẻ:</label>
            <input type="text" name="card_number" id="card_number" required>

            <label for="expiration_date">Ngày hết hạn:</label>
            <input type="text" name="expiration_date" id="expiration_date" required>

            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" id="cvv" required>
        </fieldset>

        <!-- Các trường ẩn chứa thông tin đơn hàng đã chọn -->
        <?php
    if (isset($_POST['selected_items']) && !empty($_POST['selected_items'])) {
        $selected_items = isset($_POST['selected_items']) ? $_POST['selected_items'] : '';
        $selected_items = is_string($selected_items) ? explode(',', $selected_items) : [];

        foreach ($selected_items as $cart_id) {
            echo '<input type="hidden" name="selected_items[]" value="' . $cart_id . '">';
        }
    }
    ?>

        <input type="hidden" name="total_price" id="total_price" value="<?php echo $totalPrice; ?>">

        <button type="submit" name="submit" id="order-now-btn">Order Now</button>
    </form>

    <script>
    // Javascript for expiration_date by using DatePicker
    $(function() {
        $("#expiration_date").datepicker({
            dateFormat: "yy-mm-dd", // Định dạng ngày tháng
            minDate: 0, // Ngày hiện tại trở đi
            changeMonth: true, // Cho phép chọn tháng
            changeYear: true, // Cho phép chọn năm
        });
    });

    //Order now button
    $(document).ready(function() {
        $('#order-now-btn').on('click', function(event) {
            event.preventDefault();

            // Lấy giá trị của các trường input
            var name = $('#name').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var note = $('#note').val();
            var cardNumber = $('#card_number').val();
            var expirationDate = $('#expiration_date').val();
            var cvv = $('#cvv').val();

            // Lấy giá trị của các sản phẩm đã chọn
            var selectedItems = [];
            $('input[name="selected_items[]"]').each(function() {
                selectedItems.push($(this).val());
            });
            console.log(selectedItems);

            // Lấy giá trị tổng giá tiền
            var totalPrice = $('#total_price').val();


            // Log the values to check
            // console.log('Name:', name);
            // console.log('Phone:', phone);
            // console.log('Address:', address);
            // console.log('Note:', note);
            // console.log('Card Number:', cardNumber);
            // console.log('Expiration Date:', expirationDate);
            // console.log('CVV:', cvv);
            // if (typeof selectedItems !== 'undefined') {
            //     console.log('Selected Items:', selectedItems);
            // }

            // if (typeof totalPrice !== 'undefined') {
            //     console.log('Total Price:', totalPrice);
            // }

            // Tạo một form ẩn để chứa dữ liệu và submit
            var form = $('<form method="POST" action="process_payment.php"></form>');

            // Tạo các input ẩn để truyền dữ liệu
            function createHiddenInput(name, value) {
                return $('<input type="hidden" />').attr('name', name).val(value);
            }
            // Thêm các trường input vào form
            form.append(createHiddenInput('name', name));
            form.append(createHiddenInput('phone', phone));
            form.append(createHiddenInput('address', address));
            form.append(createHiddenInput('note', note));
            form.append(createHiddenInput('card_number', cardNumber));
            form.append(createHiddenInput('expiration_date', expirationDate));
            form.append(createHiddenInput('cvv', cvv));
            for (var i = 0; i < selectedItems.length; i++) {
                form.append(createHiddenInput('selected_items[]', selectedItems[i]));
            }
            form.append(createHiddenInput('total_price', totalPrice));

            // Thêm form vào body và submit
            $('body').append(form);
            form.submit();
        });
    });
    </script>
</body>

</html>

</html>
<?php
require_once 'connect.php';
include 'header.php';
mysqli_select_db($conn, "restaurant");

// Lấy dữ liệu từ bảng meals
$query = "SELECT * FROM meals";
$result = mysqli_query($conn, $query);
$meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Meal</title>
    <style>
    //* CSS cho giao diện hiển thị món ăn */
    .meal {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .meal-item {
        flex-basis: calc(100% / 5 - 20px);
        /* Định nghĩa kích thước cột cho mỗi meal-item */
        margin: 50px 10px;
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .meal-item ul {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        /* Định nghĩa các cột trong grid */
        grid-gap: 10px;
        /* Khoảng cách giữa các cột */
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .meal-item li {
        margin: 0;
        padding: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .hidden-price {
        display: none;
    }

    .meal-item img {
        width: 100%;
        height: 150px;
        /* height:auto; */
    }

    .meal-item h3,
    .meal-item h4,
    .meal-item h5 {
        text-align: center;
        margin: 0;
        padding: 10px;
        background-color: #eee;
        font-size: 18px;
        font-weight: normal;
    }

    .meal-item button {
        display: block;
        margin: 10px auto;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #2ecc71;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .meal-item button:hover {
        background-color: #27ae60;
    }

    @media (max-width: 768px) {

        /* Hiển thị mỗi meal-item trên một dòng và chiếm full width */
        .meal-item {
            flex-basis: calc(100% - 20px);
        }
    }

    /* popup */
    .popup {
        display: none;
        position: fixed;
        z-index: 999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .popup-content {
        width: 350px;
        background-color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .popup-content p {
        width: 100%;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .popup button {
        margin: 10px 0px auto;
    }

    /* Popup outside */
    #popup-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #popup-item-description,
    #popup-item-name {
        width: 100%;
        box-sizing: border-box;
        text-align: center;
    }

    .popup-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .popup-content img {
        margin-bottom: 10px;
    }

    .popup-content h2,
    .popup-content p,
    .popup-content .quantity,
    .popup-content button {
        margin-bottom: 5px;
    }

    .quantity {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #popup-item-price {
        font-weight: bold;
    }

    #popup-quantity-increase,
    #popup-quantity-decrease {
        border: 1px solid black;
        margin-right: 5px;
        margin-left: 5px;
    }

    input[type="number"] {
        border: 1px solid black;
    }

    #popup-item-quantity {
        margin-top: 5px;
        width: 80px;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="meal">
        <?php
        // Danh sách các tên bữa ăn
        $meal_names = array("lunch", "regular","Snacks","Dessert","Beverages");

        // Lặp qua các tên bữa ăn
        foreach ($meal_names as $meal_name) {
        ?>
        <div class="meal-item">
            <h3><?php echo ucfirst($meal_name) ?></h3>
            <?php 
                // Lấy danh sách các món ăn tương ứng với bữa ăn hiện tại
                $query = "SELECT * FROM meals WHERE meal_name = '".$meal_name."'";
                $result = mysqli_query($conn, $query);
                $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <ul>
                <?php foreach ($items as $item) { ?>
                <?php 
                        // Lấy danh sách các ảnh tương ứng với món ăn hiện tại
                        $query = "SELECT * FROM gallery WHERE item_name = '".$item['item_name']."'";
                        $result = mysqli_query($conn, $query);
                        $gallerys = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                <li>

                    <?php foreach ($gallerys as $gallery) { ?>
                    <img src="uploads/<?php echo $gallery['image_path'] ?>" alt="" width="100">
                    <?php } ?>
                    <h4><?php echo $item['item_name'] ?></h4>
                    <p><?php echo $gallery['item_description'] ?></p>
                    <p class="hidden-price"><?php echo number_format($gallery['price_item'], 0, '.', ',') . " VND" ?>
                    </p>
                    <button data-product-id="<?php echo $gallery['item_name'] ?>">View</button>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
    </div>
    <div id="popup" class="popup">
        <div id="popup-overlay"></div> <!-- Thêm phần tử overlay -->
        <div class="popup-content">
            <img id="popup-item-image" src="" alt="" width="350px">
            <h2 id="popup-item-name"></h2>
            <p id="popup-item-description"></p>
            <p id="popup-item-price"></p>
            <div class="quantity">
                <button id="popup-quantity-decrease">-</button>
                <input id="popup-item-quantity" type="number" value="1" min="1">
                <button id="popup-quantity-increase">+</button>
            </div>
            <button type="submit" form="add-to-cart-form" formaction="cart.php" formmethod="post"
                id="popup-add-to-cart">Add to Cart</button>
            <!-- <button id="popup-close">Close</button> -->
        </div>
    </div>

    <script>
    //update quantity
    var quantityInput = document.getElementById("popup-item-quantity");
    var quantityIncreaseButton = document.getElementById("popup-quantity-increase");
    var quantityDecreaseButton = document.getElementById("popup-quantity-decrease");

    quantityIncreaseButton.addEventListener("click", function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    quantityDecreaseButton.addEventListener("click", function() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });

    // Lấy phần tử popup và các phần tử con của nó
    var popup = document.getElementById("popup");
    var overlay = document.getElementById('popup-overlay');
    var popupItemName = document.getElementById("popup-item-name");
    var popupItemImage = document.getElementById("popup-item-image");
    var popupItemDescription = document.getElementById("popup-item-description");
    var popupItemPrice = document.getElementById("popup-item-price");
    var popupItemQuantity = document.getElementById("popup-item-quantity");

    // Khởi tạo biến productId và gán giá trị ban đầu là null
    var productId = null;

    // Lặp qua tất cả các nút VIEW và thêm sự kiện click cho chúng
    var viewButtons = document.querySelectorAll("button");
    for (var i = 0; i < viewButtons.length; i++) {
        viewButtons[i].addEventListener("click", function(event) {
            // Ngăn chặn hành động mặc định của nút VIEW
            event.preventDefault();

            // Kiểm tra xem nút VIEW có chứa thuộc tính "data-product-id" hay không
            if (this.hasAttribute("data-product-id")) {
                // Lấy giá trị của thuộc tính "data-product-id" và gán cho biến productId
                productId = this.getAttribute("data-product-id");
            }
            // Lấy thông tin về sản phẩm từ các phần tử con của nút VIEW
            var itemName = this.parentNode.querySelector("h4").textContent;
            var itemImage = this.parentNode.querySelector("img").src;
            var itemDescription = this.parentNode.querySelector("p:nth-of-type(1)").textContent;
            var itemPrice = this.parentNode.querySelector("p:nth-of-type(2)").textContent;

            // Cập nhật thông tin của popup
            popupItemName.innerHTML = itemName;
            popupItemImage.src = itemImage;
            popupItemDescription.textContent = itemDescription;
            popupItemPrice.innerHTML = itemPrice;

            // Cập nhật giá trị của thuộc tính data-product-id của nút Add to cart
            popupAddToCartButton.dataset.productId = productId;

            // Hiển thị popup
            popup.style.display = "block";
        });
    }

    // Thêm sự kiện click cho nút Add to cart
    var popupAddToCartButton = document.getElementById("popup-add-to-cart");
    popupAddToCartButton.addEventListener("click", function(event) {
        // Ngăn chặn hành động mặc định của nút Add to cart
        event.preventDefault();
        popup.style.display = "none";

        // Lấy thông tin sản phẩm và số lượng
        var productId = this.getAttribute("data-product-id");
        var quantity = document.getElementById("popup-item-quantity").value;
        var price = document.getElementById("popup-item-price").innerHTML;
        var price = document.getElementById("popup-item-price").innerHTML;
        var price = document.getElementById("popup-item-price").innerHTML;

        console.log(productId);
        console.log(quantity);
        console.log(price);

        // Gửi yêu cầu POST đến trang cart.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "cart.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
            }
        };
        xhr.send("product_id=" + encodeURIComponent(productId) + "&quantity=" + encodeURIComponent(quantity) +
            "&price=" + encodeURIComponent(price));

        // Đóng popup
        popup.style.display = "none";
    });

    //Click popup outside
    overlay.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    // Thêm sự kiện click cho nút Close
    // var popupCloseButton = document.getElementById("popup-close");
    // popupCloseButton.addEventListener("click",
    //     function() {
    //         // Đóng popup
    //         popup.style.display = "none";
    //     });
    </script>
    <?php
    include 'footer.php';
    ?>
</body>

</html>
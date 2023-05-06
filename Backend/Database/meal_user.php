<?php
require_once 'connect.php';
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
    /* CSS cho giao diện hiển thị món ăn */
    .meal {
        flex-wrap: wrap;
        justify-content: center;
    }

    .meal-item {
        margin: 40px 10px;
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
    }

    .meal-item ul {
        display: flex;
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .meal-item li {
        display: inline-block;
        margin: 5px;
        padding: 5px;
        border: 1px solid #ccc;
    }

    .meal-item img {
        width: 100%;
        height: auto;
    }

    .meal-item h3 {
        text-align: center;
        margin: 0;
        padding: 10px;
        background-color: #eee;
        font-size: 18px;
        font-weight: normal;
    }

    .meal-item h4 {
        text-align: center;
        margin: 0;
        padding: 10px;
        background-color: #eee;
        font-size: 18px;
        font-weight: normal;
    }

    .meal-item h5 {
        text-align: center;
        margin: 10px;
        font-size: 14px;
        line-height: 1.4;
    }

    .meal-item button {
        display: block;
        margin: 10px auto;
        padding: 10px 20px;
        border: none;
        background-color: #2ecc71;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .meal-item button:hover {
        background-color: #27ae60;
    }

    @media (min-width: 768px) {
        .col-sm-6 {
            flex-basis: 50%;
        }

        .col-md-4 {
            flex-basis: 33.33%;
        }

        .col-lg-3 {
            flex-basis: 25%;

        }
    }

    @media (min-width: 1200px) {
        .meal-item {
            width: 25%;
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
        background-color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    #popup-item-description {
        width: 300px;
    }

    .popup button {
        margin: 10px 0px auto;
    }

    #popup-item-quantity {
        width: 80px;
        text-align: center;
    }
    </style>
</head>

<body>
    <h1>Meal</h1>
    <div class="meal">
        <?php
        // Danh sách các tên bữa ăn
        $meal_names = array("lunch", "regular","Snacks","Desert","Beverages");

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
                    <p><?php echo number_format($gallery['price_item'], 0, '.', ',') . " VND" ?></p>
                    <button data-product-id="<?php echo $gallery['item_name'] ?>">View</button>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
    </div>
    <div id="popup" class="popup">
        <div class="popup-content">
            <img id="popup-item-image" src="" alt="" width="200">
            <h2 id="popup-item-name"></h2>
            <p id="popup-item-description"></p>
            <p id="popup-item-price"></p>
            <button id="popup-quantity-increase">+</button>
            <input id="popup-item-quantity" type="number" value="1" min="1">
            <button id="popup-quantity-decrease">-</button>
            <br>

            <button type="submit" form="add-to-cart-form" formaction="cart.php" formmethod="post"
                id="popup-add-to-cart">Add to Cart</button>
            <br>

            <button id="popup-close">Close</button>
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
            var itemName = this.parentNode.querySelector("h4")?.textContent ?? "Unknown item";
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

        // console.log(productId);
        // console.log(quantity);

        // Gửi yêu cầu POST đến trang cart.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "cart.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
            }
        };
        xhr.send("product_id=" + encodeURIComponent(productId) + "&quantity=" + encodeURIComponent(quantity));

        // Đóng popup
        popup.style.display = "none";
    });

    // Thêm sự kiện click cho nút Close
    var popupCloseButton = document.getElementById("popup-close");
    popupCloseButton.addEventListener("click",
        function() {
            // Đóng popup
            popup.style.display = "none";
        });
    </script>
</body>

</html>
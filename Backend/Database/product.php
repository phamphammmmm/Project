<?php
require_once 'connect.php';
mysqli_select_db($conn, 'restaurant');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Popup Example</title>
    <style>
    /* Popup container styles */
    .popup-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    /* Popup styles */
    .popup {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        max-width: 500px;
        width: 100%;
        text-align: center;
    }

    /* Popup close button styles */
    .popup .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Popup image styles */
    .popup .popup-img {
        max-width: 100%;
        height: auto;
    }

    /* Popup details styles */
    .popup .popup-details {
        margin-top: 20px;
        text-align: left;
    }

    /* Popup title styles */
    .popup .popup-title {
        font-size: 24px;
        margin-bottom: 10px;
    }

    /* Popup description styles */
    .popup .popup-description {
        font-size: 16px;
        margin-bottom: 20px;
    }

    /* Popup price styles */
    .popup .popup-price {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Popup quantity styles */
    .popup .popup-quantity {
        margin-bottom: 20px;
    }

    /* Popup add to cart button styles */
    .popup #add-to-cart-popup {
        padding: 10px 20px;
        background-color: #008CBA;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Popup add to cart button hover styles */
    .popup #add-to-cart-popup:hover {
        background-color: #006080;
    }
    </style>
</head>

<body>
    <div class="product-container">
        <div class="product">
            <img class="product-img" src="product1.jpg" alt="Product 1">
            <h3>Product 1</h3>
            <p>Description of Product 1</p>
            <button class="view-btn" data-id="1" data-product-id="123">View</button>
        </div>
        <div class="product">
            <img class="product-img" src="product2.jpg" alt="Product 2">
            <h3>Product 2</h3>
            <p>Description of Product 2</p>
            <button class="view-btn" data-id="2">View</button>
        </div>
    </div>

    <div class="popup-container">
        <div id="product-popup" class="popup">
            <div class="popup-content">
                <img class="popup-img" src="" alt="">
                <div class="popup-details">
                    <h2 class="popup-title">Product Name</h2>
                    <img class="popup-img" alt="">
                    <p class="popup-description">Description of product</p>
                    <label for="popup-quantity">Quantity:</label>
                    <input type="number" id="popup-quantity" name="quantity" value="1">
                    <button id="add-to-cart-popup" data-product-id="">Add to Cart</button>
                    <button class="close">close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Lấy các phần tử cần thiết
    const viewBtns = document.querySelectorAll(".view-btn");
    const popupContainer = document.querySelector(".popup-container");
    const popup = document.querySelector(".popup");
    const popupImg = document.querySelector(".popup-img");
    const popupTitle = document.querySelector(".popup-title");
    const popupDescription = document.querySelector(".popup-description");
    const popupQuantity = document.querySelector("#popup-quantity");
    const addToCartBtn = document.querySelector("#add-to-cart-popup");

    // Hàm hiển thị popup
    function showPopup() {
        popupContainer.style.display = "block";
    }

    // Hàm ẩn popup
    function hidePopup() {
        popupContainer.style.display = "none";
    }

    // Lặp qua tất cả các nút "View"
    viewBtns.forEach(function(viewBtn) {
        // Thêm sự kiện "click" cho mỗi nút "View"
        viewBtn.addEventListener("click", function() {
            // Lấy thông tin sản phẩm từ thuộc tính "data" của nút "View"
            const productId = this.getAttribute("data-product-id");
            const productName = "Product " + this.getAttribute("data-id");
            const productDescription = "Description of " + productName;

            // Chèn thông tin sản phẩm vào popup
            popupImg.src = "product" + productId + ".jpg";
            popupTitle.textContent = productName;
            popupDescription.textContent = productDescription;
            addToCartBtn.setAttribute("data-product-id", productId);

            // Hiển thị popup
            showPopup();
        });
    });

    // Thêm sự kiện click cho nút "Add to Cart"
    addToCartBtn.addEventListener("click", function() {
        // Lấy ID sản phẩm và số lượng từ popup
        const productId = addToCartBtn.dataset.productId;
        const quantity = popupQuantity.value;

        // Gửi yêu cầu POST đến cart.php để lưu sản phẩm vào giỏ hàng
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Xử lý kết quả trả về (nếu có)
                console.log(xhr.responseText);
            }
        };
        xhr.send("product_id=" + productId + "&quantity=" + quantity);
    });


    // Thêm sự kiện "click" cho nút "close" trong popup
    popup.addEventListener("click", function(event) {
        if (event.target.classList.contains("close")) {
            hidePopup();
        }
    });
    </script>
</body>

</html>
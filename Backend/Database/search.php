<?php
require_once 'connect.php';
mysqli_select_db($conn,"restaurant");

// Searching function
function searchImages($keyword) {
    global $conn;
    $result = array();

    // Executive a search query
    $stmt = $conn->prepare("SELECT * FROM gallery WHERE item_name LIKE ? OR item_description LIKE ?");
    $keyword = "%" . $keyword . "%"; //Thêm ký tự % vào trước và sau từ khóa để tìm kiếm mẫu chuỗi
    $stmt->bind_param("ss", $keyword, $keyword);
    $stmt->execute();
    $query_result = $stmt->get_result();

    // Take data from query result
    while ($row = $query_result->fetch_assoc()) {
        $result[] = $row;
    }

    // Close connection and return searching result
    $stmt->close();
    $conn->close();
    return $result;
}

// Use searching function
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = $_POST["keyword"];
    $images = searchImages($keyword);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tìm kiếm ảnh</title>
    <style>
    /* CSS cho phần tìm kiếm */
    h1 {
        text-align: center;
    }

    form {
        text-align: center;
        margin-bottom: 20px;
    }

    input[type="text"] {
        padding: 10px;
        width: 300px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
    }

    /* CSS cho phần hiển thị kết quả */
    .image-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .image-container img {
        max-width: 80%;
        height: auto;
    }

    .image-info {
        text-align: center;
        margin-bottom: 10px;
    }

    hr {
        border: none;
        border-top: 1px solid #ccc;
        margin: 20px 0;
    }

    /* Responsive Design */
    @media screen and (max-width: 600px) {
        .image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-container img {
            max-width: 50%;
        }
    }
    </style>
</head>

<body>
    <h1>Tìm kiếm </h1>
    <form method="post" action="">
        <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
        <button type="submit">Tìm kiếm</button>
    </form>

    <?php
    // Hiển thị kết quả tìm kiếm
    if (!empty($images)) {
        foreach ($images as $image) {
            echo '<div class="image-container">';
            echo '<div class="image-info">';
            echo "Item Name: " . $image["item_name"] . "<br>";
            echo "Item Description: " . $image["item_description"] . "<br>";
            echo "Price_item: " . $image["price_item"] . "<br>";
            echo '</div>';
            echo '<img src="./uploads/' . $image["image_path"] . '" alt="' . $image["item_name"] . '">';
            echo '</div>';
            echo "<hr>";
        }
    }
    ?>
</body>

</html>
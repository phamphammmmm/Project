<?php
//Connect to database
require_once 'connect.php';
mysqli_select_db($conn,"restaurant");

// Searching function
function searchImages($keyword) {
    global $conn;
    $result = array();

    // Executive a search query
    $stmt = $conn->prepare("SELECT * FROM gallery WHERE image_name LIKE ? OR image_description LIKE ?");
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
    // Hiển thị kết quả tìm kiếm
    if (!empty($images)) {
        foreach ($images as $image) {
            echo "Image ID: " . $image["image_id"] . "<br>";
            echo "Image Name: " . $image["image_name"] . "<br>";
            echo "<img src='./uploads/" . $image["image_path"] . "' alt='" . $image["image_name"] . "'><br>";
            echo "Image Description: " . $image["image_description"] . "<br>";
            echo "Last Modified: " . $image["last_modified"] . "<br>";
            echo "<hr>";
        }
    } else {
        echo "Không tìm thấy kết quả nào.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tìm kiếm ảnh</title>
</head>

<body>
    <h1>Tìm kiếm ảnh</h1>
    <form method="post" action="">
        <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
        <button type="submit">Tìm kiếm</button>
    </form>
</body>

</html>
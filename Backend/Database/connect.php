<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS Restaurant";
try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Database created successfully";
    }
} catch (Exception $e) {
    echo "Error creating database:  " . $e->getMessage();
    die();
}

$conn->select_db("Restaurant");

// Create meals table
$sql = "CREATE TABLE IF NOT EXISTS meals (
    meal_id INT AUTO_INCREMENT PRIMARY KEY,
    meal_name VARCHAR(255) NOT NULL,
    item_name VARCHAR(50)
)";

try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Table meals created successfully or already exists<br>";
    }
} catch (Exception $e) {
    echo "Error creating table:   " . $e->getMessage();
    die();
}

// Create orders table
$sql = "CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id VARCHAR(50),
    order_date DATE,
    order_time TIME,
    customer_name VARCHAR(50),
    phone_order VARCHAR(20),
    address VARCHAR(100)
)";

try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Table orders created successfully or already exists<br>";
    }
} catch (Exception $e) {
    echo "Error creating table:   " . $e->getMessage();
    die();
}

// Create customers table
$sql = "CREATE TABLE IF NOT EXISTS customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    is_admin INT,
    customer_name VARCHAR(50),
    user_name VARCHAR(50),
    user_password VARCHAR(50),
    customers_date DATE,
    customers_time TIME,
    contact_phone VARCHAR(20),
    contact_email VARCHAR(50),
    order_id INT,
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
)";

try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Table customers created successfully or already exists<br>";
    }
} catch (Exception $e) {
    echo "Error creating table:   " . $e->getMessage();
    die();
}

// Create cart table
$sql = "CREATE TABLE IF NOT EXISTS cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    meal_id INT,
    quantity INT,
    price DECIMAL(8,2),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
    FOREIGN KEY (meal_id) REFERENCES meals(meal_id)
)";

try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Table cart created successfully or already exists<br>";
    }
} catch (Exception $e) {
    echo "Error creating table:   " . $e->getMessage();
    die();
}
// Create order_detail table
$sql = "CREATE TABLE IF NOT EXISTS order_detail (
    order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    meal_id INT,
    quantity INT,
    item_name VARCHAR(50),
    price DECIMAL(8,2),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (meal_id) REFERENCES meals(meal_id)
)";

try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Table order_detail created successfully or already exists<br>";
    }
} catch (Exception $e) {
    echo "Error creating table:   " . $e->getMessage();
    die();
}

// Create gallery table
$sql = "CREATE TABLE IF NOT EXISTS gallery (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(50),  
    image_path VARCHAR(100),
    item_description TEXT,
    price_item DECIMAL(8,2),
    last_modified DATETIME 
)";
try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Table gallery created successfully or already exists<br>";
    }
} catch (Exception $e) {
    echo "Error creating table:   " . $e->getMessage();
    die();
}

// Create feedback table
$sql = "CREATE TABLE IF NOT EXISTS feedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(50),
    contact_phone VARCHAR(20),
    contact_email VARCHAR(50),
    feedback_message TEXT
)";

try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Table feedback created successfully or already exists<br>";
    }
} catch (Exception $e) {
    echo "Error creating table:   " . $e->getMessage();
    die();
}

// Create award table
$sql = "CREATE TABLE IF NOT EXISTS award (
    award_id INT PRIMARY KEY,
    award_name VARCHAR(50),
    award_category VARCHAR(50),
    award_year INT
)";

try {
    $res = $conn->query($sql);
    if ($res) {
        // echo "Table award created successfully or already exists<br>";
    }
} catch (Exception $e) {
    echo "Error creating table:   " . $e->getMessage();
    die();
}
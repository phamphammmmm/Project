<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

$customer_name = $_POST['customer_name'];
$contact_phone = $_POST['contact_phone'];
$contact_email = $_POST['contact_email'];
$feedback_message = $_POST['feedback_message'];

$sql = "INSERT INTO feedback (customer_name, contact_phone, contact_email, feedback_message) VALUES ('$customer_name', '$contact_phone', '$contact_email', '$feedback_message')";

if (mysqli_query($conn, $sql)) {
    echo "Feedback successfully submitted. Thank you for your feedback!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
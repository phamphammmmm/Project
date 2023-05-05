<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Customer Name</th><th>Contact Phone</th><th>Contact Email</th><th>Feedback Message</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['feedback_id'] . "</td>";
        echo "<td>" . $row['customer_name'] . "</td>";
        echo "<td>" . $row['contact_phone'] . "</td>";
        echo "<td>" . $row['contact_email'] . "</td>";
        echo "<td>" . $row['feedback_message'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No feedback found.";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Feedback</title>
</head>

<body>
    <h1>Add Feedback</h1>
    <form method="post" action="save_feedback.php">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" id="customer_name">
        <br>
        <label for="contact_phone">Contact Phone:</label>
        <input type="text" name="contact_phone" id="contact_phone">
        <br>
        <label for="contact_email">Contact Email:</label>
        <input type="email" name="contact_email" id="contact_email">
        <br>
        <label for="feedback_message">Feedback Message:</label>
        <textarea name="feedback_message" id="feedback_message"></textarea>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>
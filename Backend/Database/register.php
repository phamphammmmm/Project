<?php
require_once "connect.php";
$errors = [];
if (isset($_POST['register'])) {
    $user_name = $_POST['username'];
    $user_password = $_POST['password'];
    $contact_phone = $_POST['phone'];
    if (empty($user_name)) {
        $errors[] = "Username is required";
    }
    if (empty($user_password)) {
        $errors[] = "Password is required";
    }
    if (empty($contact_phone)) {
        $errors[] = "Phone is required";
    }
    if(strlen($contact_phone) < 10 || strlen($contact_phone) > 11){
        $errors[] = "Phone number is invalid";
    }
    if (!preg_match("/^[0-9]{10,11}$/", $contact_phone)) {
        $errors[] = "Phone number is invalid";
    }

    $sql = "SELECT * FROM customers WHERE user_name = '$user_name'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $errors[] = "Username is already existed";
    }

    if (count($errors) == 0) {
        $password_hash = sha1($user_password);
        $sql = "INSERT INTO customers (is_admin, customer_name, user_name, user_password, customers_date, customers_time, number_of_guests, contact_phone, contact_email, order_id) 
        VALUES ('0', NULL, '$user_name', '$password_hash', CURDATE(), CURTIME(), '0', '$contact_phone', NULL, NULL)";
        $res = $conn->query($sql);
        if($res){
            header("Location: login.php");
                exit;
            die();
        }
        else{
            echo "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body style="background-image: url(image3.jpg);
  background-size: cover;">
    <div class="signup">
        <div class="signup-connect">
            <h1>Create your account</h1>
            <a href="#" class="btn btn-social btn-facebook"><i class="fa
                        fa-facebook"></i>Sign in with Facebook</a>
            <a href="#" class="btn btn-social btn-twitter"><i class="fa
                        fa-twitter"></i>Sign in with Twitter</a>
            <a href="#" class="btn btn-social btn-google"><i class="fa
                        fa-google"></i>Sign in with Google</a>
            <a href="#" class="btn btn-social btn-Linkedin"><i class="fa
                        fa-linkedin"></i>Sign in with Linkedin</a>
        </div>
        <div class="signup-classic" style="color:white ">
            <p>Register form</p>
            <form action="" method="post" id="signup-form">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password"><br>
                <label for="phone">Phone number:</label>
                <input type="number" name="phone" id="phone">
                <input type="submit" value="Registration" name="register">
                <ul>
                    <?php
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            ?>
                </ul>
            </form>
        </div>
    </div>
    <script>

    </script>
</body>

</html>
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
        $sql = "INSERT INTO customers (is_admin, customer_name, user_name, user_password, customers_date, customers_time, contact_phone, contact_email, order_id) 
        VALUES ('0', NULL, '$user_name', '$password_hash', CURDATE(), CURTIME(), '$contact_phone', NULL, NULL)";
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
    <!-- <link rel="stylesheet" href="signup.css"> -->
    <style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        font-family: "Abel", sans-serif;
    }

    body {
        background-image: url(./image/login.jpg);
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }

    .signup {
        position: relative;
        min-height: 500px;
        width: 700px;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
        padding: 2%;
        background: rgba(0, 0, 0, 0.5);
    }

    .signup-connect,
    .signup-classic {
        position: relative;
        width: 70%;
        margin: 30px 50px;
    }

    a:hover {
        color: white;
        box-shadow: 0 1px white;
        text-decoration: none;
    }

    h1 {
        border-bottom: 1px solid #fff;
        color: #fff;
        font-size: 35px;
    }

    p {
        color: white;
        font-size: 33px;
        margin-bottom: 15px;
    }


    /* Buttons */
    .btn {
        display: block;
        color: #fff;
        text-decoration: none;
        margin: 20px 0;
        padding: 15px 15px;
        border-radius: 10px;
        border: 1px ridge #fff;
    }

    .btn-facebook {
        background-color: hsl(221, 44%, 41%);
    }

    .btn-twitter {
        background-color: hsl(206, 82%, 63%);
    }

    .btn-google {
        background-color: hsl(7, 71%, 55%);
    }

    .btn-Linkedin {
        background-color: #3F920F;
    }

    #username,
    #password,
    #phone {
        width: 100%;
        height: 40px;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        margin-bottom: 5px;
        border: 3px inset #fff;
        background-color: #fff;
    }

    label {
        color: white;
    }

    #btn-register {
        margin-top: 15px;
        cursor: pointer;
        width: 47%;
        height: 38px;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        margin-bottom: 5px;
        border: 3px inset #fff;
        background-color: #fff;
    }
    </style>
</head>

<body>
    <div class="signup">
        <div class="signup-connect">
            <h1>Create your Account</h1>
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
                <span class="icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </span>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">

                <span class="icon">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                </span>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password"><br>

                <ion-icon name="call-outline"></ion-icon>
                <label for="phone">Phone number:</label>
                <input type="number" name="phone" id="phone">

                <input type="submit" value="Registration" name="register" id="btn-register">
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
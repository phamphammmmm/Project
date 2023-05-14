<?php
session_start();
require_once "connect.php";
mysqli_select_db($conn, "restaurant");

$errors = [];
try {

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);

        if (empty($username)) {
            $errors['username'] = "Username cannot be left blank.<br>";
        }
        if (empty($password)) {
            $errors['password'] = "Password cannot be left blank.<br>";
        }
        if (empty($errors)) {
            $sql = "SELECT * FROM customers WHERE user_name = '$username'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_assoc($result);

                if ($password === $res['user_password']) {
                    $_SESSION['login'] = true;
                    $_SESSION['customer_id'] = $res['customer_id'];
                    header('Location: home.php');
                } else {
                    var_dump($password);
                    $errors['password2'] = "wrong account password";
                }
            } else {
                $errors['username2'] = "wrong account name";
            }
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylesheet/login_css.css">
    <style>
    @import url("https://fonts.googleapis.com/css?family=Abel|Abril+Fatface|Alegreya|Arima+Madurai|Dancing+Script|Dosis|Merriweather|Oleo+Script|Overlock|PT+Serif|Pacifico|Playball|Playfair+Display|Share|Unica+One|Vibur");

    * {
        padding: 0;
        margin: 0;
        font-family: "Abel", sans-serif;
    }

    section {
        background-image: url(./image/home3.jpg);
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }

    .container {
        position: relative;
        width: 380px;
        height: 450px;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
        padding: 2%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(15px);
    }

    h2 {
        text-align: center;
        font-size: 250%;
        color: #fff;
    }

    .use {
        position: relative;
        width: 310px;
        margin: 30px 0;
        border-bottom: 1px solid #fff;
    }

    .use .icon {
        color: white;
        position: absolute;
        right: 8px;
        font-size: 1.2em;
        line-height: 57px;
    }

    .use label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        color: #fff;
        font-size: 1em;
        pointer-events: none;
        transition: .5s;
    }

    .use input:focus~label,
    .use input:valid~label {
        top: -5px;
    }

    .use input {
        width: 100%;
        height: 50px;
        background: transparent;
        border: none;
        outline: none;
        color: white;
        font-size: 1em;
    }

    .login {
        text-align: center;
        width: 100%;
    }

    .login button {
        padding: 5px;
        width: 100%;
        height: 40px;
        border-radius: 40px;
        background-color: #fff;
        border: none;
        outline: none;
        font-weight: 600;

    }

    .container2 {
        margin-top: 30px;
    }

    .container2 a {
        font-weight: 600;
    }

    .psw,
    a {
        color: #fff;
        text-decoration: none;
    }

    a:hover {
        color: white;
        box-shadow: 0 1px white;
        text-decoration: none;
    }

    /* buttons hover */
    button:hover {
        transform: translatey(3px);
        box-shadow: none;
    }

    /* buttons hover Animation */
    button:hover {
        animation: ani9 0.4s ease-in-out infinite alternate;
    }

    @keyframes ani9 {
        0% {
            transform: translateY(3px);
        }

        100% {
            transform: translateY(5px);
        }
    }

    @media (max-width: 1024px) {
        .container {
            width: 100%;
            height: 100vh;
        }
    }
    </style>
    <title>login</title>
</head>

<body>

    <section>
        <div class="container">
            <form action="" method="post">
                <div class="title">
                    <h2>FORM LOGIN</h2>
                </div>
                <div class="use">
                    <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </span>
                    <input class="input1" type="text" placeholder="" name="username" required>
                    <label for="username">Username</label>

                    <?php if (!empty($errors['username'])) { ?>
                    <div class="error"><?php echo $errors['username']; ?></div>
                    <?php } ?>
                    <?php if (!empty($errors['username2'])) { ?>
                    <div class="error"><?php echo $errors['username2']; ?></div>
                    <?php } ?>
                </div>
                <div class="use">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <input class="input1" type="password" placeholder="" name="password" required>
                    <label for="psw">Password</label>

                    <?php if (!empty($errors['password'])) { ?>
                    <div class="error"><?php echo $errors['password']; ?></div>
                    <?php } ?>
                    <?php if (!empty($errors['password2'])) { ?>
                    <div class="error"><?php echo $errors['password2']; ?></div>
                    <?php } ?>
                </div>

                <div class="login">
                    <p><button type="submit" name="submit">LOGIN</button></p>
                </div>

                <div class="container2">
                    <span class="psw forgot"> <a href="./forgot.php"> Forgot password?</a></span><br>
                    <span class="psw ">Do not have an account? <a href="register.php">Register now</a></span><br>
                </div>
            </form>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
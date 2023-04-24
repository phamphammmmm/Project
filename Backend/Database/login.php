<?php
require_once "connect.php";

if (isset($_POST['login'])) {
    $user_name = $_POST['username'];
    $user_password = $_POST['password'];

    $sql = "SELECT * FROM customers WHERE user_name = '$user_name'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $password_hash = sha1($user_password);
        if ($password_hash == $row['user_password']) {
            session_start();
            $_SESSION['user_id'] = $row['customer_id'];
            $_SESSION['user_name'] = $row['user_name'];
            header("Location:home .php");
        } else {
            $error_msg = "Invalid password";
        }
    } else {
        $error_msg = "Invalid username";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' el='stylesheet'>
</head>

<body>
    <div class="overlay">
        <?php if (isset($error_msg)) { ?>
        <div class="error"><?php echo $error_msg; ?></div>
        <?php } ?>
        <form method="post" action="" id="login-form">
            <div class="con">
                <header class="header-form">
                    <h2>Log in</h2>
                    <p>Login here using your username and
                        password</p>
                </header>

                <div class="field-set">
                    <!--User name-->
                    <div class="input-item">
                        <span class="bx bx-user-circle"></span>
                        <input class="form-input" id="username" type="text" placeholder="Username" name="username"
                            required>
                    </div>

                    <!--Password-->
                    <div class="input-item">
                        <span class="bx bx-lock"></span>
                        <input class="form-input" id="password" type="password" name="password" placeholder="Password"
                            required>
                        <!--Show/hidden password-->
                        <span>
                            <i class="fa fa-eye" aria-hidden="true" id="eye" type="button"></i>
                        </span>
                    </div>


                    <!--button log in-->
                    <input type="submit" value="Login" name="login"></input>
                    <div class="alert">
                        <div id="error" style="color: red;"></div>
                    </div>
                </div>

                <!--button other-->
                <div class="other">
                    <!--button forgot-->
                    <button class="btn submits ftgt-pass">Forgot
                        Password</button>
                    <!--Sign up button-->
                    <button class="btn submits sign-up" onclick="return signup()">Sign Up<span class="bx
                                        bx-user-plus"></span></button>
                </div>
            </div>
        </form>
    </div>
    <script src="login.js"></script>
</body>

</html>
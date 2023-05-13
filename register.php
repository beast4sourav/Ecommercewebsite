<?php

include('connect.php');


session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
;

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email,]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        echo 'email already exists!';
    } else {
        if ($pass != $cpass) {
            echo 'confirm password not matched!';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
            $insert_user->execute([$name, $email, $cpass]);
            $message[] = 'registered successfully, login now please!';

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
    <title>Zash | Register</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <script src="https://kit.fontawesome.com/1ca3e04119.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

</head>

<body>
    <?php include('message.php'); ?>

    <div id="preloader"></div>
    <div class="login-container">
        <div class="login-navbar">
            <div class="logo-1">
                <h1>ZASH.</h1>
            </div>
            <div class="menu1">
                <ul>
                    <a href="index.php">
                        <li>Home</li>
                    </a>
                    <a href="">
                        <li>Top selling</li>
                    </a>
                    <a href="">
                        <li>Categories</li>
                    </a>
                    <a href="">
                        <li>Offer</li>
                    </a>
                    <a href="">
                        <li><a href="#">

                                <lord-icon src="https://cdn.lordicon.com/xfftupfv.json" trigger="hover"
                                    colors="primary:#ffffff" style="width:20px;height:20px">
                                </lord-icon>
                            </a></li>
                    </a>
                    <a href="">
                        <li><a href="#">
                                <lord-icon src="https://cdn.lordicon.com/hyhnpiza.json" trigger="hover"
                                    colors="primary:#ffffff" style="width:20px;height:20px">
                                </lord-icon>

                            </a></li>

                    </a>
                </ul>
            </div>

            <div class="hamburger login-hamburger" onclick="menuopen()">
                <i class="fa-solid fa-bars"></i>
            </div>

        </div>
        <div class="register-box ">
            <h1>
                Register
            </h1>

            <form action="" method="post">
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="pass" placeholder="Password">
                <input type="text" name="cpass" placeholder=" Confirm Password" class="sec">
                <input type="submit" name="register" value="Register">
            </form>
            <p>Already an User <a href="login.php"> Login <i class="fa-solid fa-right-to-bracket"></i></a></p>
        </div>
    </div>
    <div class="mobile-menu login-menu" id="menus">
        <div class="cut-btn" onclick="menuclose()">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="mobile-menus">
            <ul>
                <a href="index.php">
                    <li><i class="fa-solid fa-house"></i> Home</li>
                </a>
                <a href="">
                    <li><i class="fa-solid fa-arrow-trend-up"></i> Top selling</li>
                </a>
                <a href="">
                    <li><i class="fa-solid fa-list"></i> Categories</li>
                </a>
                <a href="">
                    <li><i class="fa-solid fa-ticket"></i> Offer</li>
                </a>
                <a href="">
                    <li><i class="fa-solid fa-cart-shopping"></i> Cart</li>
                </a>
                <a href="login.php">
                    <li><i class="fa-solid fa-user"></i> Login</li>
                </a>
            </ul>

        </div>
    </div>
</body>
<script src="loader.js"></script>

</html>
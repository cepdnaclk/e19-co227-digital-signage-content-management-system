<?php include "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/login.css">
    <?php include APP_ROOT . "/includes/header_core.php" ?>
    <title>IT Center | Login</title>
</head>

<body>
    <div class="login">
        <div class="left">
            <h3>Admin Portal</h3>
            <h5>Information Technology Center - CMS</h5>
            <p>Welcome to the Admin Portal of the IT Center's Content Management System. Here you can manage and update all the content related to our center's services and offerings.</p>
            <span>Need help? <a href="">Contact us</a></span>
        </div>
        <div class="content">
            <form action="">
                <h1>Login</h1>
                <div class="login-input">
                    <label for="uname">Username</label>
                    <input type="text" id="uname" placeholder="Joen Doe">
                </div>
                <div class="login-input">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="xxxxxxxx">
                </div>
                <p>Forgot your password? <a href="">Forgot Password</a></p>
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>

</html>
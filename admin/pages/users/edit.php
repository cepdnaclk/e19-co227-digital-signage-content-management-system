<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php" ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$u_id = $_SESSION['user_id'];
$user = getUser($u_id);
if (isset($user['error']))
    if (!isset($_GET['error']))
        header("Location: ./?error={$user['error']}");
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/adduser.css">
    <title>Edit Profile</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(2);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="register-user container">
                <h2>Edit Profile</h2>
                <div class="form-container">
                    <form action="/backend/users/edit.php" method="POST">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" value="<?= $user['user_name'] ?>" required>
                        <br><br>

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?= $user['email'] ?>">
                        <br><br>

                        <label for="opassword">Old Password:</label>
                        <input type="password" name="opassword" id="opassword">
                        <br><br>

                        <label for="password">New Password:</label>
                        <input type="password" name="password" id="password">
                        <br><br>

                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password">
                        <br><br>

                        <label for="contact">Contact:</label>
                        <input type="text" name="contact" id="contact" value="<?= $user['contact'] ?>">
                        <br><br>

                        <input type="submit" value="Register User">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
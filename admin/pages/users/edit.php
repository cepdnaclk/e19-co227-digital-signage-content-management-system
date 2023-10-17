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
            sidebar(2,0);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="register-user container">
                <div class="title">
                    <div>
                        <h1><a href="./">Users ></a>Edit Profile</h1>
                        <p>Edit your account settings</p>
                    </div>
                </div>
                <br><br>
                <h3>User Details</h3>
                <div class="form-container">
                    <form action="/backend/api/users/edit.php" method="POST">
                        <input type="text" name="u_id" id="u_id" value="<?= $user['u_id'] ?>" required style="display:none">

                        <label for="username">Username:</label>
                        <p><?= $user['user_name'] ?></p>

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?= $user['email'] ?>">


                        <label for="contact">Contact:</label>
                        <input type="text" name="contact" id="contact" value="<?= $user['contact'] ?>">

                        <input type="submit" value="Update">
                    </form>
                </div>
                <br><br><br>
                <h3>Change Password</h3>
                <div class="form-container">
                    <form action="/backend/api/users/changepass.php" method="POST">
                        <input type="text" name="u_id" id="u_id" value="<?= $user['u_id'] ?>" required style="display:none">

                        <label for="old_password">Old Password:</label>
                        <input type="password" name="old_password" id="old_password" required>

                        <label for="password">New Password:</label>
                        <input type="password" name="password" id="password" required>

                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" required>

                        <input type="submit" value="Change Password">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
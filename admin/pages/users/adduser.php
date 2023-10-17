<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/adduser.css">
    <title>Register New User</title>
    <style>
        .register-user form p {
            border: none;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(2, 0);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="register-user container">
                <div class="title">
                    <div>
                        <h1><a href="./">Users ></a><?= $clearenceStatus[$_SESSION['clearense']] > 1 ? 'Register New User' : 'Register new Course Coordinator' ?></h1>
                        <p>Add a user to manage the site</p>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/users/add.php" method="POST" onsubmit="return validateForm()">
                        <?php if ($clearenceStatus[$_SESSION['clearense']] > 1) { ?>
                            <div class="role-selection">
                                <p>Select User Role:</p></br>
                                <div class="role">
                                    <input type="radio" id="role1" name="user_role" value="admin" required checked>
                                    <label for="role1">
                                        Admin
                                    </label>
                                    <input type="radio" id="role2" name="user_role" value="course_c" required>
                                    <label for="role2">
                                        Course Coordinator
                                    </label>
                                </div>
                            </div>
                        <?php } else { ?>
                            <input type="radio" name="user_role" value="course_c" checked style="display: none;">
                        <?php } ?>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>
                        <br><br>

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email">
                        <br><br>

                        <label for="contact">Contact:</label>
                        <input type="text" name="contact" id="contact">
                        <br><br>

                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>
                        <br><br>

                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" required>
                        <br><br>

                        <input type="submit" value="Register User">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/users.css">
    <title>IT Center | Users</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(2);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="users">
                <div class="container">
                    <h1>Users</h1>
                    <p>Currently active users in charge of CMS handling</p>

                    <!-- User Role Icons and Counts -->
                    <div class="user-roles">
                        <div class="user-role">
                            <div class="user-icon">
                                <img src="../images/superadmin.svg" alt="Superadmin Icon">
                            </div>
                            <div class="user-details">
                                <h3>Superadmin</h3>
                                <p>Director of IT Center</p>
                            </div>
                            <div class="user-count">1</div>
                        </div>
                        <div class="user-role">
                            <div class="user-icon">
                                <img src="../images/admin.svg" alt="Admin Icon">
                            </div>
                            <div class="user-details">
                                <h3>Admin</h3>
                                <p>Administrator</p>
                            </div>
                            <div class="user-count">5</div>
                        </div>
                        <div class="user-role">
                            <div class="user-icon">
                                <img src="../images/coordinator.svg" alt="Coordinator Icon">
                            </div>
                            <div class="user-details">
                                <h3>Course Coordinator</h3>
                                <p>Coordinator</p>
                            </div>
                            <div class="user-count">10</div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>

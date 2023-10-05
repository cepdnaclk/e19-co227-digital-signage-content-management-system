<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

$users = getUsers();

if (!isset($users))
    header("Location: '/'");
?>

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
            <main class="users">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1>Users</h1>
                            <p>Currently active users in charge of CMS handling</p>
                        </div>
                        <a href="/pages/adduser.php"><img src="../images/Add_round.svg" alt=""> Register New User</a>
                    </div>

                    <!-- User Role Icons and Counts -->
                    <div class="user-roles">
                        <div class="user-role" id="super-admin-role">
                            <div class="user-icon">
                                <img src="../images/superadmin.svg" alt="Superadmin Icon">
                            </div>
                            <div class="user-details">
                                <h3>Super-Admin</h3>
                                <p>Director of IT Center</p>
                            </div>
                            <div class="user-count"><?= isset($users['super_admin']) ? sizeof($users['super_admin']) : 0 ?></div>
                        </div>
                        <div class="user-role" id="admin-role">
                            <div class="user-icon">
                                <img src="../images/admin.svg" alt="Admin Icon">
                            </div>
                            <div class="user-details">
                                <h3>Admin</h3>
                                <p>Administrator</p>
                            </div>
                            <div class="user-count"><?= isset($users['admin']) ? sizeof($users['admin']) : 0 ?></div>
                        </div>
                        <div class="user-role" id="coordinator-role">
                            <div class="user-icon">
                                <img src="../images/coordinator.svg" alt="Coordinator Icon">
                            </div>
                            <div class="user-details">
                                <h3>Course Coordinator</h3>
                                <p>Coordinator</p>
                            </div>
                            <div class="user-count"><?= isset($users['course_c']) ? sizeof($users['course_c']) : 0 ?></div>
                        </div>
                    </div>

                    <!-- Display all users -->
                    <div class="all-users">
                        <div class="user-list super-admin">
                            <h3>Super Admin</h3>
                            <ul>
                                <?php
                                if (isset($users['super_admin']))
                                    foreach ($users['super_admin'] as $key => $sa) {
                                ?>
                                    <li>
                                        <p><?= $sa['user_name'] ?></p>
                                        <?php if ($_SESSION['user_id'] == $sa['u_id']) { ?>
                                            <a class="btn btn-success" href="/backend/users.php?edit=<?= $sa['u_id'] ?>">EDIT</a>
                                        <?php } ?>
                                    </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>

                        <div class="user-list admins">
                            <h3>Admins</h3>
                            <ul>
                                <?php
                                if (isset($users['admin']))
                                    foreach ($users['admin'] as $key => $admin) {
                                ?>
                                    <li>
                                        <p><?= $admin['user_name'] ?></p>
                                        <?php if ($clearenceStatus[$_SESSION['clearense']] > 1) { ?>
                                            <a class="btn btn-danger" href="/backend/api/users/get.php?delete=<?= $admin['u_id'] ?>">DELETE</a>
                                        <?php } ?>
                                        <?php if ($_SESSION['user_id'] == $admin['u_id']) { ?>
                                            <a class="btn btn-success" href="/backend/user.php?edit=<?= $admin['u_id'] ?>">EDIT</a>
                                        <?php } ?>
                                    </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>

                        <div class="user-list coordinators">
                            <h3>Coordinators</h3>
                            <ul>
                                <?php
                                if (isset($users['course_c']))
                                    foreach ($users['course_c'] as $key => $cc) {
                                ?>
                                    <li>
                                        <p><?= $cc['user_name'] ?></p>
                                        <?php if ($clearenceStatus[$_SESSION['clearense']] > 1) { ?>
                                            <a class="btn btn-danger" href="/backend/api/users/get.php?delete=<?= $cc['u_id'] ?>">DELETE</a>
                                        <?php } ?>
                                        <?php if ($_SESSION['user_id'] == $cc['u_id']) { ?>
                                            <a class="btn btn-success" href="/backend/user.php?edit=<?= $cc['u_id'] ?>">EDIT</a>
                                        <?php } ?>
                                    </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </main>

        </div>
    </div>
</body>

</html>
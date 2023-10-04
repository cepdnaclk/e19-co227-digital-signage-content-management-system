<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/users.css">
    <title>IT Center | Users</title>
    
    <script> //display relevent data on hovering
       
        document.addEventListener("DOMContentLoaded", function () {
            const superAdminRole = document.getElementById("super-admin-role");
            const adminRole = document.getElementById("admin-role");
            const coordinatorRole = document.getElementById("coordinator-role");
            const allUsers = document.querySelector(".all-users");

            superAdminRole.addEventListener("mouseenter", function () {
            // Hide all user data except Super Admin
            document.querySelector(".super-admin").style.display = "block";
            document.querySelector(".admins").style.display = "none";
            document.querySelector(".coordinators").style.display = "none";
            });

        adminRole.addEventListener("mouseenter", function () {
            // Hide all user data except Admins
            document.querySelector(".super-admin").style.display = "none";
            document.querySelector(".admins").style.display = "block";
            document.querySelector(".coordinators").style.display = "none";
            });

        coordinatorRole.addEventListener("mouseenter", function () {
            // Hide all user data except Coordinators
            document.querySelector(".super-admin").style.display = "none";
            document.querySelector(".admins").style.display = "none";
            document.querySelector(".coordinators").style.display = "block";
            });
        });
    </script>
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
                    <div class="title">
                        <div>
                        <h1>Users</h1>
                        <p>Currently active users in charge of CMS handling</p>
                        </div>
                        <a href="/pages/adduser.php" class="btn btn-success"><img src="../images/Add_round.svg" alt=""> Register New User</a>
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
                            <div class="user-count">1</div>
                        </div>
                        <div class="user-role" id="admin-role">
                            <div class="user-icon">
                                <img src="../images/admin.svg" alt="Admin Icon">
                            </div>
                            <div class="user-details">
                                <h3>Admin</h3>
                                <p>Administrator</p>
                            </div>
                            <div class="user-count">5</div>
                        </div>
                        <div class="user-role" id="coordinator-role">
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
                    
                    <!-- Display all users -->
                    <div class="all-users">
                <div class="user-list super-admin">
                    <h3>Super Admin</h3>
                    <ul>
                        <!-- List Super Admin users here -->
                        <li>Super Admin 1</li>
                    </ul>
                </div>

                <div class="user-list admins">
                    <h3>Admins</h3>
                    <ul>
                        <!-- List Admin users here -->
                        <li>Admin 1</li>
                        <li>Admin 2</li>
                        <li>Admin 3</li>
                        <!-- Add more Admin users as needed -->
                    </ul>
                </div>

                <div class="user-list coordinators">
                    <h3>Coordinators</h3>
                    <ul>
                        <!-- List Coordinator users here -->
                        <li>Coordinator 1</li>
                        <li>Coordinator 2</li>
                        <!-- Add more Coordinator users as needed -->
                    </ul>
                </div>
            </div>

            </div>
        </main>

        </div>
    </div>
   
</body>

</html>

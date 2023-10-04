<?php include_once "../config.php" ;
  include (APP_ROOT . "/includes/header.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/users.css">
    <title>IT Center | Users</title>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Make an AJAX request to fetch user names
            fetch("../backend/users.php")
                .then((response) => response.json())
                .then((data) => {
                    // Populate user names for each role
                    console.log(data);
                    document.querySelector(".super-admin ul").innerHTML = data["super_admin"].map((name) => `<li>${name}</li>`).join("");
                    document.querySelector(".admins ul").innerHTML = data["admin"].map((name) => `<li>${name}</li>`).join("");
                    document.querySelector(".coordinators ul").innerHTML = data["coordinator"].map((name) => `<li>${name}</li>`).join("");
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
                                <!-- User names for Super Admin will be populated dynamically -->
                            </ul>
                        </div>

                        <div class="user-list admins">
                            <h3>Admins</h3>
                            <ul>
                                <!-- User names for Admins will be populated dynamically -->
                            </ul>
                        </div>

                        <div class="user-list coordinators">
                            <h3>Coordinators</h3>
                            <ul>
                                <!-- User names for Coordinators will be populated dynamically -->
                            </ul>
                        </div>
                    </div>

                </div>
            </main>

        </div>
    </div>
</body>

</html>

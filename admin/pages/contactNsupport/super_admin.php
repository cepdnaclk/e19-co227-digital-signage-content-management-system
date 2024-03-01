<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include(APP_ROOT . "/includes/header_contactNSupport.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/manual.css">
    <title>IT Center | Super Admin's User Manaul</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(2, 0);
            ?>
        </div>
        <div class="right">


            <main class="manual">
                <div class="container">
                    <h2>Super Admin's User Manual</h2>
                    </br>

                    <!-- Button 1: Getting an Overview of the Dashboard -->
                    <button class="accordion">1. Getting an Overview of the Dashboard</button>
                    <div class="panel">
                        </br>
                        <p>i) Preview, Pages and Timers</p>
                        <img src="/images/Manual/super_admin/1.png" alt="dashboard_timers_sa">
                        </br>
                        <p>ii) Handling messages and complaints from Admins,Course Coordinators and Guests</p>
                        <img src="/images/Manual/super_admin/2.png" alt="message_board_sa">
                        </br>
                        <p>iii) Checking the log history and recent user activities</p>
                        <img src="/images/Manual/super_admin/3.png" alt="log_board_sa">
                        </br>
                    </div>

                    <!-- Button 2: Creating a new Admin Account -->
                    <button class="accordion">2. Creating a New Admin Account</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Users/Register New User' </p>
                        <img src="/images/Manual/super_admin/4.png" alt="reg_sa1">
                        </br>
                        <p>ii) Register the new admin by filling the form </p>
                        <img src="/images/Manual/super_admin/5.png" alt="reg_sa2">
                        </br>
                        <p>iii) Go to 'Users' and ensure whether the new admin account is visible in the list </p>
                        <img src="/images/Manual/super_admin/6.png" alt="reg_sa3">
                        </br>
                    </div>

                    <!-- Button 3: Creating a new Course Coordinator Account (Optional) -->
                    <button class="accordion">3. Creating a New Course Coordinator Account (Optional)</button>
                    <div class="panel">
                        </br>
                        <p>i) Similar to registering a new admin. Go to 'Users/Register New User' and fill the form </p>
                        <img src="/images/Manual/super_admin/7.png" alt="reg_sa4">
                        </br>
                        <p>ii) Go to 'Users' and ensure whether the new "Course Coordinator" account is visible in the list </p>
                        <img src="/images/Manual/super_admin/8.png" alt="reg_sa5">
                        </br>
                    </div>

                    <!-- Button 4: Editing Your Own Account Details -->
                    <button class="accordion">4. Edit Your Own Account/ Change Password</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Users' and click the edit button in front of your username</p>
                        <img src="/images/Manual/super_admin/9.png" alt="edit_sa1">
                        </br>
                        <p>ii) Edit details/ Change password</p>
                        <img src="/images/Manual/super_admin/10.png" alt="edit_sa2">
                        </br>
                    </div>

                    <div class="links">
                    <p>Additional References: &emsp;
                    <a href="/pages/contactNsupport/admin.php"><u><i>Admin's User Manual</i></u></a> &emsp;
                    <a href="/pages/contactNsupport/coordinator.php"><u><i>Course Coordinator's User Manual</i></u></a>

                </p>
                    </div>
                </div>
            </main>


        </div>
    </div>

</body>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("activ");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>
</html>
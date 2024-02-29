<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include(APP_ROOT . "/includes/header_contactNSupport.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/manual_super_admin.css">
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
                    <h2>Super Admin User Manual</h2>
                    </br>

                    <!-- Button 1: Getting an Overview of the Dashboard -->
                    <button class="accordion">1. Getting an Overview of the Dashboard</button>
                    <div class="panel">
                        <p>Content for section 1 goes here...</p>
                    </div>

                    <!-- Button 2: Creating a new Admin Account -->
                    <button class="accordion">2. Creating a new Admin Account</button>
                    <div class="panel">
                        <p>Content for section 2 goes here...</p>
                    </div>

                    <!-- Button 3: Creating a new Course Coordinator Account (Optional) -->
                    <button class="accordion">3. Creating a new Course Coordinator Account (Optional)</button>
                    <div class="panel">
                        <p>Content for section 3 goes here...</p>
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
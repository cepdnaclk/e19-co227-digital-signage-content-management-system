<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include(APP_ROOT . "/includes/header_contactNSupport.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/manual.css">
    <title>IT Center | Course Coordinator's User Manaul</title>
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
                    <h2>Course Coordinator's User Manual</h2>
                    </br>

                    <!-- Button 1: Getting an Overview of the Dashboard -->
                    <button class="accordion">1. Getting an Overview of the Dashboard</button>
                    <div class="panel">
                        </br>
                        <p>i) Preview and Courses </p>
                        <img src="/images/Manual/course_coordinator/1.png" alt="dash_cc1">
                        </br>
                        <p>ii) Add/Edit A Course Advertiesment/Poster </p>
                        <img src="/images/Manual/course_coordinator/2.png" alt="dash_cc2">
                        </br>
                        <p>iii) Fill the form</p>
                        <img src="/images/Manual/course_coordinator/3.png" alt="course_pub_cc1">
                        </br>
                        <p>iv) Ensure the new course advertiesment/poster has been updated succesfully</p>
                        <img src="/images/Manual/course_coordinator/4.png" alt="course_pub_cc2">
                        </br>
                        <p>v) Publish the course to the TV display</p>
                        <img src="/images/Manual/course_coordinator/5.png" alt="course_pub_cc3">
                        </br>
                        <p>vi) Ensure the new course advertiesment/poster has been published succesfully</p>
                        <img src="/images/Manual/course_coordinator/6.png" alt="course_pub_cc4">
                        </br>
                    </div>


                    <!-- Button 2: Editing Your Own Account Details -->
                    <button class="accordion">2. Edit Your Own Account/ Change Password</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Users' and click the edit button in front of your username</p>
                        <img src="/images/Manual/super_admin/9.png" alt="edit_sa1">
                        </br>
                        <p>ii) Edit details/ Change password</p>
                        <img src="/images/Manual/super_admin/10.png" alt="edit_sa2">
                        </br>
                    </div>

                     <!-- Button 3: Add/Edit a Lab Slot -->
                     <button class="accordion">3. Add/Edit a Lab Slot</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Lab Allocations' using the sidebar</p>
                        <img src="/images/Manual/admin/24.png" alt="lab_a1">
                        </br>
                        <p>ii) Select the relevent Lab or Seminar room and click "Add a slot"</p>
                        <img src="/images/Manual/admin/25.png" alt="lab_a2">
                        </br>
                        <p>iii) Fill the relevent details of the lab slot</p>
                        <img src="/images/Manual/admin/26.png" alt="lab_a3">
                        </br>
                        <p>iv) Ensure whether the lab slot added to the list. (No need to manually publish a lab slot. When added it would immeadiately be published)</p>
                        <img src="/images/Manual/admin/27.png" alt="lab_a4">
                        </br>
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
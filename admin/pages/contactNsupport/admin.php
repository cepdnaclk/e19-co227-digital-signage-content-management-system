<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include(APP_ROOT . "/includes/header_contactNSupport.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/manual.css">
    <title>IT Center | Admin's User Manaul</title>
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
                    <h2>Admin's User Manual</h2>
                    </br>

                    <!-- Button 1: Getting an Overview of the Dashboard -->
                    <button class="accordion">1. Getting an Overview of the Dashboard</button>
                    <div class="panel">
                        </br>
                        <p>i) Preview, Pages and Timers</p>
                        <img src="/images/Manual/admin/1.png" alt="dashboard_timers_a">
                        </br>
                        <p>ii) Handling messages and complaints from Admins,Course Coordinators and Guests</p>
                        <img src="/images/Manual/admin/2.png" alt="message_board_a">
                        </br>
                        <p>iii) Checking the log history and recent user activities</p>
                        <img src="/images/Manual/admin/3.png" alt="log_board_a">
                        </br>
                    </div>

            

                    <!-- Button 2: Creating a new Course Coordinator Account  -->
                    <button class="accordion">2. Creating a New Course Coordinator Account </button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Users' </p>
                        <img src="/images/Manual/admin/4.png" alt="reg_a1">
                        </br>
                        <p>ii) Go to 'Users/Register New Course Coordinator' and fill the form </p>
                        <img src="/images/Manual/admin/5.png" alt="reg_a2">
                        </br>
                        <p>iii) Go to 'Users' and ensure whether the new "Course Coordinator" account is visible in the list </p>
                        <img src="/images/Manual/admin/6.png" alt="reg_a3">
                        </br>
                    </div>

                    <!-- Button 3: Creating a New Course -->
                    <button class="accordion">3. Creating a New Course</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Courses'</p>
                        <img src="/images/Manual/admin/7.png" alt="course_a1">
                        </br>
                        <p>ii) Fill the form</p>
                        <img src="/images/Manual/admin/8.png" alt="course_a2">
                        </br>
                        <p>iii) Ensure the new course has been added to the course list</p>
                        <img src="/images/Manual/admin/9.png" alt="course_a3">
                        </br>
                    </div>

                     <!-- Button 4: Publishing a Course Advertiesment/Poster -->
                     <button class="accordion">4. Creating/Editing a Course Advertiesment/Poster </button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Courses' and select the course that you want to add a new poster</p>
                        <img src="/images/Manual/admin/10.png" alt="course_pub_a1">
                        </br>
                        <p>ii) Fill the form</p>
                        <img src="/images/Manual/admin/11.png" alt="course_pub_a2">
                        </br>
                        <p>iii) Ensure the new course advertiesment/poster has been updated succesfully</p>
                        <img src="/images/Manual/admin/12.png" alt="course_pub_a3">
                        </br>
                        <p>iv) Publish the course to the TV display</p>
                        <img src="/images/Manual/admin/13.png" alt="course_pub_a4">
                        </br>
                        <p>v) Ensure the new course advertiesment/poster has been published succesfully</p>
                        <img src="/images/Manual/admin/14.png" alt="course_pub_a5">
                        </br>
                    </div>

                    <!-- Button 5: Editing Your Own Account Details -->
                    <button class="accordion">5. Edit Your Own Account/ Change Password</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Users' and click the edit button in front of your username (in Admins' section)</p>
                        <img src="/images/Manual/admin/15.png" alt="edit_a1">
                        </br>
                        <p>ii) Edit details/ Change password</p>
                        <img src="/images/Manual/admin/16.png" alt="edit_a2">
                        </br>
                    </div>

                    <!-- Button 6: Add an event/ achievement -->
                    <button class="accordion">6. Add a New Event/Achievement</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Events & Achievements' using the sidebar</p>
                        <img src="/images/Manual/admin/17.png" alt="event_a1">
                        </br>
                        <p>ii) Select the catergory of the Event. Then click the corresponding "See All" button. ( All the 3 catergories of event adding procedures are similar) </p>
                        <img src="/images/Manual/admin/18.png" alt="event_a2">
                        </br>
                        <p>iii) Click "Add Event"</p>
                        <img src="/images/Manual/admin/19.png" alt="event_a3">
                        </br>
                        <p>iv) Fill the form. By Ticking the "Published" field in this form, the poster will be immeadiately published to the public display. Or else you can choose to publish this at a later time ( just leave "Published" unticked )</p>
                        <img src="/images/Manual/admin/20.png" alt="event_a4">
                        </br>
                        <p>v)  Ensure the event added and "Published" to the public TV</p>
                        <img src="/images/Manual/admin/21.png" alt="event_a5">
                        </br>
                    </div>

                     <!-- Button 7: Edit an event/ achievement -->
                     <button class="accordion">7. Edit an Event/Achievement</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'Events & Achievements' using the sidebar. Then Go to the relevent catergory of your event (upcoming/previous/achievement) and click the "Edit" button on your event </p>
                        <img src="/images/Manual/admin/22.png" alt="event_edit_a1">
                        </br>
                        <p>ii) Edit the form </p>
                        <img src="/images/Manual/admin/23.png" alt="event_edit_a2">
                        </br>
                        <p>v)  Ensure the event has been updated and "Published" to the public TV</p>
                        <img src="/images/Manual/admin/24.png" alt="event_edit_a3">
                        </br>
                    </div>

                    <!-- Button 8: Add/Edit a Lab Slot -->
                    <button class="accordion">8. Add/Edit a Lab Slot</button>
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

                      <!-- Button 9: Add/Edit General Info -->
                      <button class="accordion">9. Add/Edit General Info (The Content Posted to the Mobile/User App )</button>
                    <div class="panel">
                        </br>
                        <p>i) Go to 'General Info' using the sidebar</p>
                        <img src="/images/Manual/admin/28.png" alt="general_a1">
                        </br>
                        <p>ii) Select the relevent catergory and add/edit the forms</p>
                        <img src="/images/Manual/admin/29.png" alt="general_a2">
                        </br>
                    </div>

                    <div class="links">
                    <p>Additional References: &emsp;
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
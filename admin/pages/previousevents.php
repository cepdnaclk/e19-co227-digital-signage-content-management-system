<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/previousevents.css">
    <title>IT Center | PreviousEvents</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(3);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="previousevents">
                <div class="container">
                    <div class="title">
                        <h1>Previous Events and Services</h1>
                        <a href="/pages/addpreviousevent.php"><img src="../images/Add_round.svg" alt=""> Add Previous Event</a>
                    </div>
                    
                    <div class="card-container">

                        <!-- Card 1 -->
                        <div class="card">
                            <img src="../images/previous-event-posters/image-1.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">Certificate Award Ceremony of the SITSEP- Staff IT Skills Development Programme- 2022 - level 1</h2>
                                <p class="card-description">Certificate Award Ceremony of the SITSEP- Staff IT Skills Development Programme 2022 (Level 1), first batch was held on January 2nd. <span class="show-more">Show More</span></p>
                                <p class="card-date">2022/01/02</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="publish-button" id="publish-button-1"><span class="icon">&#10004;</span>Publish</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 2 -->
                        <div class="card">
                            <img src="../images/previous-event-posters/image-2.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">SITSEP- Staff IT Skills Development Programme- 2022</h2>
                                <p class="card-description">The Department of Veterinary Pathobiology, Faculty of Veterinary Medicine and Animal Science, organized the ICGEB workshop on "Genomic Approaches in Understanding Vector-Borne Parasites". <span class="show-more">Show More</span></p>
                                <p class="card-date">2023/09/22</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="publish-button" id="publish-button-2"><span class="icon">&#10004;</span>Publish</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 3 -->
                        <div class="card">
                            <img src="../images/previous-event-posters/image-3.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">The poster presentation of the final projects of the staff IT development program, level 3</h2>
                                <p class="card-description">The poster presentation of the final projects of the staff IT development program-level 3 was held on Monday, February 20-2023 from 1 to 3 p.m. at the ground floor of the Senate building. 9 Groups was present their posters and Dr. Janaka Wijekulasuriya, Former Director, Information Technology and the Dr. D.M.I.S. Dasanayake, Acting Director of Information Technology Center was participate this event. This course is offered for the staff of the University of Peradeniya and it covers the data analysis and visualization for office and research. Over 55 staff members are participate in this course.  <span class="show-more">Show More</span></p>
                                <p class="card-date">2023/09/22</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="publish-button" id="publish-button-3"><span class="icon">&#10004;</span>Publish</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 4 -->
                        <div class="card">
                            <img src="../images/previous-event-posters/image-4.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">SITSEP- Staff IT Skills Development Programme- 2022 - Batch 2</h2>
                                <p class="card-description">Information Technology Center stated a training programme for the second batch of the SITSEP programme on 2022 August 16. <span class="show-more">Show More</span></p>
                                <p class="card-date">2023/09/22</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="publish-button" id="publish-button-4"><span class="icon">&#10004;</span>Publish</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Function to toggle the "Publish" button's state and background color
        function togglePublishButton(buttonId) {
            const button = document.getElementById(buttonId);

            if (button.classList.contains("published")) {
                button.classList.remove("published");
                button.style.backgroundColor = ''; // Reset background color
                button.innerHTML = '<span class="icon">&#10004;</span>Publish';
            } else {
                button.classList.add("published");
                button.style.backgroundColor = '#B2BEB5'; // Change the background color as needed
                button.innerHTML = '<span class="icon">&#10680;</span>Unpublish';
            }
        }

        // Add click event listeners to each "Publish" button
        document.getElementById("publish-button-1").addEventListener("click", function () {
            togglePublishButton("publish-button-1");
        });

        document.getElementById("publish-button-2").addEventListener("click", function () {
            togglePublishButton("publish-button-2");
        });

        document.getElementById("publish-button-3").addEventListener("click", function () {
            togglePublishButton("publish-button-3");
        });

        document.getElementById("publish-button-4").addEventListener("click", function () {
            togglePublishButton("publish-button-4");
        });
    </script>

</body>

</html>
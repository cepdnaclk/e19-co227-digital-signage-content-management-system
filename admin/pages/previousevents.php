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
                    <h1>Previous Events</h1>


                    <div class="card-container">


                        <!--Default card-->
                        <div class="card">
                            <!--<img src="../images/previousevents/default.png" alt="Add Event Image">-->
                            <div class="card-content">
                                <a href="addnewevent.php" class="default-button" title="Add New Event"></a>

                            </div>


                        </div>



                        <!-- Card 1 -->
                        <div class="card">
                            <img src="../images/previous-event-posters/image-1.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">Certificate Award Ceremony of the SITSEP- Staff IT Skills Development Programme- 2022 - level 1</h2>
                                <!-- <p>Certificate Award Ceremony of the SITSEP- Staff IT Skills Development Programme- 2022 � level 1, first batch was held on January 2nd</p> -->
                                <!-- <p class="card-venue">Seminar Room</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p> -->
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 2 -->
                        <div class="card">
                            <img src="../images/previous-event-posters/image-2.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">SITSEP- Staff IT Skills Development Programme- 2022</h2>
                                <!-- <p>The Department of Veterinary Pathobiology, Faculty of Veterinary Medicine and Animal Science, organized the ICGEB workshop on "Genomic Approaches in Understanding Vector-Borne Parasites".</p> -->
                                <!-- <p class="card-venue">Seminar Room</p> --> 
                                <!-- <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p> -->
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 3 -->
                        <div class="card">
                            <img src="../images/previous-event-posters/image-3.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">The poster presentation of the final projects of the staff IT development program, level 3</h2>
                                <!-- <p>The Department of Veterinary Pathobiology, Faculty of Veterinary Medicine and Animal Science, organized the ICGEB workshop on "Genomic Approaches in Understanding Vector-Borne Parasites".</p> -->
                                <!-- <p class="card-date">2023/09/22 at 9.00 a.m</p>
                                <p class="card-venue">Seminar Room</p> -->
                                <!-- <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p> -->
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 4 -->
                        <div class="card">
                            <img src="../images/previous-event-posters/image-4.png" alt="Add Event Image">
                            <div class="card-content">
                                <h2 class="card-title">SITSEP- Staff IT Skills Development Programme- 2022 - Batch 2</h2>
                                <!-- <p>Information Technology Center stated a training programme for the second batch of the SITSEP programme on 2022 August 16</p> -->
                                <!-- <p class="card-date">2023/09/23 at 3 p.m</p>
                                <p class="card-venue">Seminar Room</p> -->
                                <!-- <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p> -->
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
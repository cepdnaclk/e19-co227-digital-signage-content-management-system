<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/upcomingevents.css">
    <title>IT Center | UpcomingEvents</title>
    <style>
        .card-container {
            margin-bottom: 5rem !important;
        }
    </style>
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
            <main class="upcomingevents">
                <div class="container">
                    <div class="title">
                        <h1>Upcoming Events</h1>
                        <a href="/pages/upcomingevents.php">See All</a>
                    </div>
                    <div class="card-container">
                        <!-- Card 1 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-1.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event1</h2>
                                <p class="card-date">2023/09/20 at 9.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 2 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-2.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event2</h2>
                                <p class="card-date">2023/09/21 at 11.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 3 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-3.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event3</h2>
                                <p class="card-date">2023/09/22 at 9.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 4 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-3.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event 4</h2>
                                <p class="card-date">2023/09/23 at 3 p.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>
                    </div>
                    <div class="title">
                        <h1>Previous Events</h1>
                        <a href="/pages/previousevents.php">See All</a>
                    </div>
                    <div class="card-container">
                        <!-- Card 1 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-1.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event1</h2>
                                <p class="card-date">2023/09/20 at 9.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 2 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-2.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event2</h2>
                                <p class="card-date">2023/09/21 at 11.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 3 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-3.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event3</h2>
                                <p class="card-date">2023/09/22 at 9.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 4 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-3.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event 4</h2>
                                <p class="card-date">2023/09/23 at 3 p.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>
                    </div>
                    <div class="title">
                        <h1>Achivements</h1>
                        <a href="../pages/achievements.php">See All</a>
                    </div>
                    <div class="card-container">
                        <!-- Card 1 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-1.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event1</h2>
                                <p class="card-date">2023/09/20 at 9.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 2 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-2.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event2</h2>
                                <p class="card-date">2023/09/21 at 11.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 3 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-3.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event3</h2>
                                <p class="card-date">2023/09/22 at 9.00 a.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 4 -->
                        <div class="card">
                            <img src="../images/upcoming-event-posters/upcoming-event-3.jpg" alt="See All Image">
                            <div class="card-content">
                                <h2 class="card-title">Event 4</h2>
                                <p class="card-date">2023/09/23 at 3 p.m</p>
                                <p class="card-venue">Seminar Room</p>
                                <p><br>Display Duration</p>
                                <p class="card-duration">From 2023/09/10<br>To 2023/09/22 </p>
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
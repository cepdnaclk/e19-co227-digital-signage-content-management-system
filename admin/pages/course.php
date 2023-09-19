<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/course.css">
    <title>IT Center | Courses</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php")
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="course">
                <div class="container">
                    <h1>Courses</h1>
                    <p>Currently Offered Courses by Us</p>

                    <div class="card-container">
                        <!-- Card 1 -->
                        <div class="card">
                            <img src="../images/ccna.png" alt="Card Image 1">
                            <div class="card-content">
                                <h2 class="card-title">CCNA</h2>
                                <p class="card-text">Dr. Kumaratunga Munidasa</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 2 -->
                        <div class="card">
                            <img src="../images/ccna.png" alt="Card Image 2">
                            <div class="card-content">
                                <h2 class="card-title">CCNA</h2>
                                <p class="card-text">Dr. Don Don</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 3 -->
                        <div class="card">
                            <img src="../images/ccna.png" alt="Card Image 3">
                            <div class="card-content">
                                <h2 class="card-title">CCNA</h2>
                                <p class="card-text">Dr. Magic Perera</p>
                            </div>
                            <!-- Card actions with icons -->
                            <div class="card-actions">
                                <button class="edit-button"><span class="icon">&#9998;</span>Edit</button>
                                <button class="delete-button"><span class="icon">&#128465;</span>Delete</button>
                            </div>

                        </div>

                        <!-- Card 4 -->
                        <div class="card">
                            <img src="../images/ccna.png" alt="Card Image 4">
                            <div class="card-content">
                                <h2 class="card-title">CCNA</h2>
                                <p class="card-text">Dr. A.B. de Great</p>
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
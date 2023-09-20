<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/course-offerings/ccna.css">
    <title>IT Center | CCNA Course Offerings</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(1);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="ccna">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="/pages/course.php">Courses > </a>CCNA Course Offerings</h1>
                            <p>Cisco Certified Network Associate</p>
                        </div>
                        <a href="" class="btn btn-success"><img src="../images/Add_round.svg" alt=""> Add CCNA Course-Offering</a>
                    </div>

                    <div class="card-container">
                        <!-- Card 1 -->
                        <div class="card">
                            <img src="../images/ccna.png" alt="CCNA 2023: Aug">
                            <div class="card-content">
                                <h2 class="card-title">CCNA 2023: Aug</h2>
                                <p class="card-start-date">Start Date: 2023/08/15</p>
                                <p class="card-end-date">End Date: 2023/08/30</p>
                                <div class="card-buttons">
                                    <button class="edit-button">Edit</button>
                                    <button class="delete-button">Delete</button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="card">
                            <img src="../images/ccna.png" alt="CCNA 2022: Dec">
                            <div class="card-content">
                                <h2 class="card-title">CCNA 2022: Dec</h2>
                                <p class="card-start-date">Start Date: 2022/12/10</p>
                                <p class="card-end-date">End Date: 2022/12/25</p>
                                <div class="card-buttons">
                                    <button class="edit-button">Edit</button>
                                    <button class="delete-button">Delete</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
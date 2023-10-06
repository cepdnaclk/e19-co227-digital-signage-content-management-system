<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/achievements.css">
    <title>IT Center | Achievements</title>
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
            <main class="achievements">
                <div class="container">
                    <div class="title">
                        <h1>Achievements</h1>
                        <a href="/pages/addachievement.php"><img src="/images/Add_round.svg" alt=""> Add Achievement</a>
                       
                    </div>
                    <div class="card-container">                           
                        <?php include_once "/backend/displayachievements.php"; ?> 
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
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
                        <h1>Previous Events</h1>
                        <a href="/pages/addpreviousevent.php"><img src="../images/Add_round.svg" alt=""> Add Previous Event</a>
                       
                    </div>
                    <div class="card-container">                           
                        <?php include_once "../backend/display_previous_events.php"; ?> 
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/addnewevent.css">
    <title>New Event Information Form</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(3);
            ?>
        </div>
        
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <div class="right">
            <h2>Add New Event</h2>
            <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="image">Select an Image:</label>
                <input type="file" name="image" id="image" required>
                <br><br>
                <label for="event_date">Date:</label>
                <input type="date" name="date" id="date" >
                <br><br>
                <label for="event_time">Time:</label>
                <input type="time" name="time" id="time" >
                <br><br>
                <label for="venue">Venue:</label>
                <input type="text" name="venue" id="venue" >
                <br><br>
                <label for="display_duration_from">Display from:</label>
                <input type="date" name="from" id="from" required>
                <br><br>
                <label for="display_duration_to">Display to:</label>
                <input type="date" name="to" id="to" required>
                <br><br>
                <input type="submit" value="Upload">
            </form>
            </div>
        </div>
    </div>
</body>

</html>
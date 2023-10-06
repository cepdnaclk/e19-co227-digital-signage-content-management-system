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
            <div class="add-events">
                <h2>Add New Event</h2>
                <div class="form-container">
                    <form action="/backend/api/upcoming/add.php" method="POST" enctype="multipart/form-data">
                        <label for="e_img">Select an Image:</label>
                        <input type="file" name="e_img" id="e_img" required>
                        <br>
                        <label for="e_name">Name:</label>
                        <input type="text" name="e_name" id="e_name">
                        <br>
                        <label for="e_date">Date:</label>
                        <input type="date" name="e_date" id="e_date">
                        <br>
                        <label for="e_time">Time:</label>
                        <input type="time" name="e_time" id="e_time">
                        <br>
                        <label for="e_venue">Venue:</label>
                        <input type="text" name="e_venue" id="e_venue">
                        <br>
                        <label for="display_from">Display from:</label>
                        <input type="date" name="display_from" id="display_from" required>
                        <br>
                        <label for="display_to">Display to:</label>
                        <input type="date" name="display_to" id="display_to" required>
                        <br>
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
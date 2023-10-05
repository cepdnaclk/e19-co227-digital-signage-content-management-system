<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/addpreviousevent.css">
    <title>Previous Event Information Form</title>
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
            <div class="add-previous-event">
                <h2>Add Previous Event</h2>
                <div class="form-container">
                    <form action="../backend/previousevents.php" method="POST" enctype="multipart/form-data">
                    <label for="p_img">Select an Image:</label>
                        <input type="file" name="p_img" id="p_img" required>
                        <br>
                        <label for="p_name">Name:</label>
                        <input type="text" name="p_name" id="p_name">
                        <br>
                        <label for="p_desc">Description:</label>
                        <textarea name="p_desc" id="p_desc" rows="6"></textarea>
                        <br>
                        <label for="p_date">Date:</label>
                        <input type="date" name="p_date" id="p_date">
                        <br>
                        <!-- <label for="p_time">Time:</label>
                        <input type="time" name="p_time" id="p_time">
                        <br><br>
                        <label for="p_venue">Venue:</label>
                        <input type="text" name="p_venue" id="p_venue">
                        <br><br>
                        <label for="display_from">Display from:</label>
                        <input type="date" name="display_from" id="display_from" required>
                        <br><br>
                        <label for="display_to">Display to:</label>
                        <input type="date" name="display_to" id="display_to" required>                        -->
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
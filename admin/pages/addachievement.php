<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/addachievement.css">
    <title>Achievements Information Form</title>
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
            <div class="add-achievement">
                <h2>Add Achievement</h2>
                <div class="form-container">
                    <form action="../backend/achievements.php" method="POST" enctype="multipart/form-data">
                        <label for="a_img">Select an Image:</label>
                        <input type="file" name="a_img" id="a_img" required>
                        <br>
                        <label for="a_name">Achievement Title:</label>
                        <input type="text" name="a_name" id="a_name">
                        <br>
                        <label for="a_desc">Description:</label>
                        <input type="text" name="a_desc" id="a_desc" style="height: 150px;">
                        <br>
                        <label for="a_date">Date:</label>
                        <input type="date" name="e_date" id="e_date">
                        <br>
                        <!-- <label for="a_time">Time:</label>
                        <input type="time" name="a_time" id="a_time">
                        <br><br>
                        <label for="a_venue">Venue:</label>
                        <input type="text" name="a_venue" id="a_venue">
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
<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/addcourse.css">
    <title>Add New Course</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(1);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-course">
                <h2>Add New Course</h2>
                <div class="form-container">
                    <form action="../backend/addcourse.php" method="POST">
                        <label for="c_code">Course Code:</label>
                        <input type="text" name="c_code" id="c_code" required>
                        <br><br>
                        <label for="c_name">Course Name:</label>
                        <input type="text" name="c_name" id="c_name" required>
                        <br><br>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" rows="4" cols="50"></textarea>
                        <br><br>
                        <input type="submit" value="Add Course">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

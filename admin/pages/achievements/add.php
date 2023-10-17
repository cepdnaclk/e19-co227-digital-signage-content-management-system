<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addachievement.css">
    <title>Achievement Information Form</title>
    <style>
        .container {
            padding: 1rem 0;
            background-color: var(--color-1);
            box-shadow: 0 0 0 1000px var(--color-1);
        }

        .container .title {
            filter: invert();
        }

        .container .title a {
            opacity: 1;
            color: black;
        }
    </style>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(3, 3);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-achievement">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Achievements ></a>Add Achivement</h1>
                            <p>Add a new Achievement</p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/achivements/add.php" method="POST" enctype="multipart/form-data">
                        <label for="a_img">Select an Image:</label>
                        <input type="file" name="a_img" id="a_img" required>
                        <br>
                        <label for="a_name">Achievement Title:</label>
                        <input type="text" name="a_name" id="a_name">
                        <br>
                        <label for="a_desc">Description:</label>
                        <textarea name="a_desc" id="a_desc" rows="6"></textarea>
                        <br>
                        <label for="a_date">Date:</label>
                        <input type="date" name="a_date" id="a_date">
                        <br>
                        <label for="published">Published:</label>
                        <input type="checkbox" name="published" id="published">
                        <br>
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
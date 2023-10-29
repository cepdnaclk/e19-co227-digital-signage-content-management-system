<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addmap.css">
    <title>Map Information Form</title>
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
            sidebar(5, 1);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-map">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Maps ></a>Add a Map</h1>
                            <p>Add a new Map</p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/maps/add.php" method="POST" enctype="multipart/form-data">
                        <label for="m_file">Select Video:</label>
                        <input type="file" name="m_file" id="m_file" required>
                        <br>
                        <label for="m_name">Map Title:</label>
                        <input type="text" name="m_name" id="m_name">
                        <br>
                        <label for="m_desc">Description:</label>
                        <textarea name="m_desc" id="m_desc" rows="6"></textarea>
                        <br>
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
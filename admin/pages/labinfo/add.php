<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addnewlab.css">
    <title>Add New Lab Information</title>
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
            sidebar(5, 2);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-lab">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Lab Info ></a>Add New Lab</h1>


                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/facilities/add.php" method="POST" enctype="multipart/form-data">

                        <label for="f_name">Name:</label>
                        <input type="text" name="f_name" id="f_name" required>
                        <br>
                        <label for="total_seats">No of Seats:</label>
                        <input type="number" name="total_seats" id="total_seats" required>
                        <br>
                        <label for="price">Price per Seat per hr:</label>
                        <input type="number" name="price" id="price" required>
                        <br>
                        <label for="floor">Floor:</label>
                        <input type="text" name="floor" id="floor" required>
                        <br>
                        <label for="in_charge">In charge of the Lab:</label>
                        <input type="text" name="in_charge" id="in_charge" required>
                        <br>

                        <br>
                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
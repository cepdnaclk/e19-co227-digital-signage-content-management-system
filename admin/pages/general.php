<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Center | General Info</title>
    <link rel="stylesheet" type="text/css" href="/css/general.css">

</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(5, 0);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>

            <!-- Cards Section -->
            <div class="card-container">
                <div class="card">
                    <img src="/images/maps.jpeg" alt="Maps Image">
                    <div class="card-body">
                        <h5 class="card-title">Maps</h5>
                        <p class="card-text">Explore our IT Center: maps.</p>
                        <center><a href="/pages/maps/" class="btn">Go to Maps</a></center>
                    </div>
                </div>

                <div class="card">
                    <img src="/images/lab_info.jpeg" alt="Lab Info Image">
                    <div class="card-body">
                        <h5 class="card-title">Lab Info</h5>
                        <p class="card-text">Get information about our labs.</p>
                        <center><a href="/pages/labinfo/" class="btn">Go to Lab Info</a></center>
                    </div>
                </div>
            </div>
            <!-- End Cards Section -->

        </div>
    </div>
</body>

</html>
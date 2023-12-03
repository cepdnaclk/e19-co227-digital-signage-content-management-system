<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";
//include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php"; // Include the bookings functions file

$facilities = getFacilities();
if (isset($facilities['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$facilities['error']}");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/labinfo.css">

    <title>IT Center | Bookings</title>
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
            <main class="labinfo">
                <div class="container">
                    <div class="title">
                        <h1>Lab Info</h1>
                        <a href="add.php"><img src="/images/Add_round.svg" alt=""> Add a Lab Info</a>

                    </div>
                    <div class="card-container">
                        <?php if (isset($facilities[0]['f_name'])) //Creating display cards for the number of facilities
                                foreach ($facilities as $key => $row) { ?>
                                <div class='card'>
                                    <div class='card-content'>
                                        <h2 class='card-title'>
                                            <?= $row["f_name"] ?>
                                        </h2>
                                        <p class='card-description'>
                                            <?php $Total_seats = $row["total_seats"] ?>
                                            Total Seats:
                                            <?= $Total_seats ?>
                                        </p>
                                        <p class='card-description'>
                                            <?php $price = $row["price"] ?>
                                            Price per seat per hr:
                                            <?= $price ?>
                                        </p>
                                        <p class='card-description'>
                                            <?php $floor = $row["floor"] ?>
                                            Floor:
                                            <?= $floor ?>
                                        </p>
                                        <p class='card-description'>
                                            <?php $in_charge = $row["in_charge"] ?>
                                            In_charge of the Lab:
                                            <?= $in_charge ?>
                                        </p>



                                    </div>
                                    <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                        <div class='card-actions'>
                                            <a href="add.php?f_id=<?= $row['f_id'] ?> ">
                                                <button class="edit-button">
                                                    <span class="icon">&#9998;</span>
                                                    Edit
                                                </button>
                                            </a>


                                            <a href="/backend/api/bookings/displayall.php?f_id=<?= $row['f_id'] ?>">
                                                <button class="delete-button">
                                                    <span class="icon">&#128065;</span>
                                                    Delete
                                                </button>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                            <p style="width:400px">No facilities Found.</p>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
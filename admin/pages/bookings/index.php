<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";

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
    <link rel="stylesheet" href="/css/bookings.css">
    <title>IT Center | Bookings</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(6, 0);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="bookings">
                <div class="container">
                    <div class="title">
                        <h1>Bookings</h1>
                        <!-- <a href="add.php"><img src="/images/Add_round.svg" alt=""> Add Achievement</a> -->
                    </div>
                    <div class="card-container">
                        <?php if (isset($facilities[0]['f_name']))
                            foreach ($facilities as $key => $row) { ?>
                            <div class='card'>
                                
                                <div class='card-content'>
                                    <h2 class='card-title'>
                                        <?= $row["f_name"] ?>
                                    </h2>
                                    <p class='card-description'>
                                        Total Seats :<?= $row["total_seats"] ?>
                                    </p>
                                    <p class='card-description'>
                                        Price     Rs: <?= $row["price"] ?> per 1hr per seat
                                    </p>
                                    <p class='card-description'>
                                        <label for="date">Select a date:</label>
                                        <input type="date" id="date">
                                    </p>
                                    <p class='card-description'>
                                        <label for="timeslot">Select a time slot:</label>
                                        <select id="timeslot">
                                            <option value="08:00 - 09:00">08:00 - 09:00 AM</option>
                                            <option value="09:00 - 10:00">09:00 - 10:00 AM</option>
                                            <option value="10:00 - 11:00">10:00 - 11:00 AM</option>
                                            <option value="11:00 - 12:00">11:00 - 12:00 PM</option>
                                            <option value="12:00 - 13:00">12:00 - 01:00 PM</option>
                                            <option value="13:00 - 14:00">01:00 - 02:00 PM</option>
                                            <option value="14:00 - 15:00">02:00 - 03:00 PM</option>
                                            <option value="15:00 - 16:00">03:00 - 04:00 PM</option>
                                        </select>

                                    </p>
                                    <p class='card-description'>
                                        Booked Seats :<?= $row["total_seats"] ?>
                                    </p>
                                    <p class='card-description'>
                                        Available Seats :<?= $row["total_seats"] ?>
                                    </p>

                                </div>
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    <div class='card-actions'>
                                        <a href="edit.php?edit_id=<?= $row['f_id'] ?>">
                                            <button class="edit-button">
                                                <span class="icon">&#9998;</span>
                                                + Booking
                                            </button>
                                        </a>


                                        <a href="/backend/api/bookings/delete.php?delete_id=<?= $row['f_id'] ?>">
                                            <button class="delete-button">
                                                <span class="icon">&#128465;</span>
                                                - Booking
                                            </button>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }
                        else { ?>
                            <p style="width:400px">No facilities Found.
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    
                                <?php } ?>
                            </p>
                        <?php } ?>
                    </div>
            </main>
        </div>
    </div>
</body>

</html>
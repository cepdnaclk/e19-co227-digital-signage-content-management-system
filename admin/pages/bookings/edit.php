<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php";

$b_id = $_GET['edit_id'];
if (isset($b_id)) {
    $row = getBookingById($b_id);
    
    if (isset($row['error']) && !isset($_GET['error'])) {
        header("Location: ?error={$row['error']}");
    }

    $b_date = $row['b_date'];
    $b_timeslot = $row['b_timeslot'];
    $b_seats = $row['b_seats'];
    $b_for = $row['b_for'];
    $b_contact = $row['b_contact'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/editbooking.css">
    <title>Edit Booking Information Form</title>
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
            sidebar(6, 0);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="edit-booking">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Bookings ></a>Edit Booking</h1>
                            
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/bookings/edit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="b_id" id="b_id" value="<?= $b_id; ?>" required>
                        <br>
                        <label for="b_date">Booking Date:</label>
                        <input type="date" name="b_date" id="b_date" value="<?= $b_date; ?>" required>

                        <label for="b_timeslot">Booking Timeslot:</label>
                            <select name="b_timeslot" id="b_timeslot" value="<?= $b_timeslot; ?>" required>
                            <option value="08:00 - 09:00 AM">08:00 - 09:00 AM</option>
                            <option value="09:00 - 10:00 AM">09:00 - 10:00 AM</option>
                            <option value="10:00 - 11:00 AM">10:00 - 11:00 AM</option>
                            <option value="11:00 - 12:00 PM">11:00 - 12:00 PM</option>
                            <option value="12:00 - 13:00 PM">12:00 - 01:00 PM</option>
                            <option value="13:00 - 14:00 PM">01:00 - 02:00 PM</option>
                            <option value="14:00 - 15:00 PM">02:00 - 03:00 PM</option>
                            <option value="15:00 - 16:00 PM">03:00 - 04:00 PM</option>
                            <option value="16:00 - 17:00 PM">04:00 - 05:00 PM</option>
                            </select>
                        <br>
                        <label for="b_seats">Booked Seats:</label>
                        <input type="number" name="b_seats" id="b_seats" value="<?= $b_seats; ?>" required>
                        <br>
                        <label for="b_for">Booked For:</label>
                        <input type="text" name="b_for" id="b_for" value="<?= $b_for; ?>" required>
                        <br>
                        <label for="b_contact">Contact No:</label>
                        <input type="text" name="b_contact" id="b_contact" value="<?= $b_contact; ?>">
                        <br>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
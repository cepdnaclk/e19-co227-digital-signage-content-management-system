<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>

<?php if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $f_id = $_GET["f_id"];
    $total_seats = $_GET["total_seats"];
    $f_name = $_GET["f_name"];} ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addbooking.css">
    <title>booking Information Form</title>
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
            <div class="add-booking">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Bookings ></a>Add Booking</h1>
                            <p>Add a New Booking to <?php echo $f_name?></p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/bookings/add.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="f_id" value="<?php echo $f_id; ?>">
                        <br>
                        <input type="hidden" name="total_seats" value="<?php echo $total_seats; ?>">
                        <br>
                        <label for="b_date">Booking Date:</label>
                        <input type="date" name="b_date" id="b_date" required>
                        <br>
                        <label for="b_timeslot">Select a time slot:</label>
                            <select name="b_timeslot" required>
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
                        <label for="b_seats">No of seats:</label>
                        
                        <input type="number" name="b_seats"id= "b_seats" required>
                        <br>
                        <label for="b_for">Booked For:</label>
                        <input type="text" name="b_for" id="b_for" required>
                        <br>
                        <label for="b_contact">Contact No:</label>
                        <input type="text" name="b_contact" id="b_contact" required>
                        <br>


                        <input type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
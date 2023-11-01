<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";
//include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php"; // Include the bookings functions file

$facilities = getFacilities();
if (isset($facilities['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$facilities['error']}");

$bookedSeats=0;
$post_f_id=-1;
if (isset($_POST["f_id"]) && isset($_POST["date"]) && isset($_POST["timeslot"])) {
    // Form has been submitted, process the data here
    $f_id = $_POST["f_id"];
    $post_f_id = $f_id;
    $date = $_POST["date"];
    $timeslot = $_POST["timeslot"];
    
    $stmt = $conn->prepare("SELECT * FROM booking WHERE f_id = ? AND b_date = ? AND b_timeslot = ?");
    $stmt->bind_param('iss', $f_id, $date, $timeslot);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Get the result set
    $res = $stmt->get_result();
    
   
    
    if (mysqli_num_rows($res) > 0) {
        while ($row = $res->fetch_assoc()) {
            $bookedSeats += isset($row['b_seats']) ? $row['b_seats'] : 0;
        }
    } else {
        $bookedSeats = 0;
    }
    
    
    
    print_r($bookedSeats);

    
    
}


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
                                        Total Seats: <?= $row["total_seats"] ?>
                                    </p>

                                    <form action="" method="post">
                                        <input type="hidden" name="f_id" value="<?= $row["f_id"] ?>">
                                        <p class='card-description'>
                                            <label for="date">Select a date (YYYY-MM-DD):</label>
                                            <input type="text" name="date" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD" required>

                                        </p>
                                        <p class='card-description'>
                                            <label for="timeslot">Select a time slot:</label>
                                            <select name="timeslot" required>
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
                                        </p>
                                        
                                        <input type="submit" value="Display bookings" style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; hover:brightness(1.2);">
                                        
                                    </form>

                                    <?php if ($post_f_id == $row["f_id"]) { ?>
                                        <p class='card-description'>
                                            Booked Seats: <?= $bookedSeats ?>
                                        </p>
                                    <?php } else { ?>
                                        <p class='card-description'>
                                            Booked Seats: Select a Date and a Time
                                        </p>
                                    <?php } ?>


                                    <?php if ($post_f_id == $row["f_id"]) { ?>
                                        <p class='card-description'>
                                        Available Seats: <?= $row["total_seats"] - $bookedSeats ?>
                                        </p>
                                    <?php } else { ?>
                                        <p class='card-description'>
                                        Available Seats: Select a Date and a Time
                                        </p>
                                    <?php } ?>
                                </div>
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    <div class='card-actions'>
                                        <a href="add.php">
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
                            <p style="width:400px">No facilities Found.</p>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    hasClearence(1, function () {

            // Get form data
            $f_id = $_POST["f_id"];
            $total_seats = $_POST["total_seats"];
            $b_date = $_POST["b_date"];
            $b_timeslot = $_POST["b_timeslot"];
            $b_seats = $_POST['b_seats'];
            $b_for = $_POST['b_for'];
            $b_contact = $_POST['b_contact'];
            $b_by = $_SESSION["user_id"];
            
            //Checking database to see available seats
            global $conn;
            $stmt = $conn->prepare("SELECT * FROM booking WHERE f_id = ? AND b_date = ? AND b_timeslot = ?");
            $stmt->bind_param('iss', $f_id, $b_date, $b_timeslot);
            
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
            //print_r($bookedSeats); debug
            //Getting available seats seats
            $available_seats=$total_seats-$bookedSeats;
            if (!($available_seats<$b_seats)) {
                $result = addBooking($f_id, $b_date, $b_timeslot, $b_seats,$b_for,$b_contact, $b_by);
                    if (isset($result['error'])) {
                        header("Location: /pages/bookings/?error={$result['error']}");
                    } else
                        header("Location: /pages/bookings/?success={$result['message']}");
            }
            else {
                header("Location: /pages/bookings/?error=Not Enough Available Seats!");
            }

    });
}
exit();

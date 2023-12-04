<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $booking_id = $_GET["delete_id"];
        $result = deleteBooking($booking_id);
        if ($result) {
            logUserActivity("delete_booking");
            header("Location: /pages/bookings/?success=successfully deleted the booking");
        } else {
            header("Location: /pages/bookings/?error=$result");
        }
    });
}

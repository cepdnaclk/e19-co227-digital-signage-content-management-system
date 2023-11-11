<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $booking_id = $_GET["delete_id"];
        $result = deleteBooking($booking_id);
        if ($result) {
            header("Location: /pages/bookings/?success=successfully deleted the booking");
        } else {
            header("Location: /pages/bookings/?error=$result");
        }
    });
}

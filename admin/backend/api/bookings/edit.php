<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    hasClearence(1, function () {
        // Get form data
        $b_id = $_POST["b_id"];
        $b_date = $_POST["b_date"];
        $b_timeslot = $_POST["b_timeslot"];
        $b_seats = $_POST['b_seats'];
        $b_for = $_POST['b_for'];
        $b_contact = $_POST["b_contact"];
        $b_by = $_SESSION["user_id"];

        $result = editBooking($b_id, $b_date, $b_timeslot, $b_seats, $b_for, $b_contact, $b_by);
        if (isset($result['error'])) {
            header("Location: /pages/bookings/?error={$result['error']}");
        } else {
            logUserActivity("Edited booking with id: {$result['id']}");
            header("Location: /pages/bookings/?success={$result['message']}");
        }
    });
}
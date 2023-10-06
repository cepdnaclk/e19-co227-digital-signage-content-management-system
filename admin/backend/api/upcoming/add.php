<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/upcomingevents.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (
        isset($_POST["display_from"]) &&
        isset($_POST["display_to"]) &&
        isset($_FILES['e_img'])
    ) {
        // Get form data
        $e_name = $_POST["e_name"];
        $e_date = $_POST["e_date"];
        $e_time = $_POST["e_time"];
        $e_venue = $_POST["e_venue"];
        $file = $_FILES['e_img'];
        $display_from = $_POST["display_from"];
        $display_to = $_POST["display_to"];
        $added_by = $_SESSION["user_id"];

        $result = addUpcomingEvents($e_name, $e_date, $e_time, $e_venue, $file,  $display_from, $display_to, $added_by);
        if (isset($result['error'])) {
            header("Location: /pages/upcoming/?error={$result['error']} {$_SESSION["user_id"]}");
        } else
            header("Location: /pages/upcoming/?success={$result['message']}");
    } else {
        header("Location: /pages/upcoming/?error='event_image,display_from display_to are required fields'");
    }
}
exit();

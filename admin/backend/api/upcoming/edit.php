<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/upcomingevents.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (
        isset($_POST["display_from"]) &&
        isset($_POST["display_to"])
    ) {
        // Get form data
        $e_id = $_POST["e_id"];
        $e_name = $_POST["e_name"];
        $e_date = $_POST["e_date"];
        $e_time = $_POST["e_time"];
        $e_venue = $_POST["e_venue"];
        $file = $_FILES['e_img'];
        $file_path = $_POST['e_img_loc'];
        $display_from = $_POST["display_from"];
        $display_to = $_POST["display_to"];
        $added_by = 1;

        $result = editUpcomingEvents($e_name, $e_date, $e_time, $e_venue, $file, $file_path, $display_from, $display_to, $added_by, $e_id);
        if (isset($result['error'])) {
            header("Location: /pages/upcomingevents.php?error={$result['error']}");
        } else
            header("Location: /pages/upcomingevents.php?success={$result['message']}");
    } else {
        header("Location: /pages/upcomingevents.php?error='event_image,display_from display_to are required fields'");
    }
}
exit();

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivement.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (
        isset($_FILES['e_img'])
    ) {
        // Get form data
        $a_name = $_POST["a_name"];
        $a_desc = $_POST["a_desc"];
        $a_date = $_POST["a_date"];
        $file = $_FILES['a_img'];
        $added_by = $_SESSION["user_id"];
        $published = $_POST["published"] ? 1 : 0;

        $result = addAchivement($a_name, $a_desc, $a_date, $file, $added_by, $published);
        if (isset($result['error'])) {
            header("Location: /pages/upcoming/?error={$result['error']}");
        } else
            header("Location: /pages/upcoming/?success={$result['message']}");
    } else {
        header("Location: /pages/upcoming/?error='event_image,display_from display_to are required fields'");
    }
}
exit();

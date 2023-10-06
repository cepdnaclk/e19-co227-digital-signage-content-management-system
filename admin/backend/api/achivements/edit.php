<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivement.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $a_name = $_POST["a_name"];
    $a_desc = $_POST["a_desc"];
    $a_date = $_POST["a_date"];
    $file = $_FILES['a_img'];
    $file_path = $_POST['e_img_loc'];
    $added_by = $_SESSION["user_id"];
    $a_id = $_POST["a_id"];

    $result = editAchivement($a_name, $a_desc, $a_date, $file, $file_path, $added_by, $a_id);
    if (isset($result['error'])) {
        header("Location: /pages/upcoming/?error={$result['error']}");
    } else
        header("Location: /pages/upcoming/?success={$result['message']}");
} else {
    header("Location: /pages/upcoming/?error='event_image,display_from display_to are required fields'");
}

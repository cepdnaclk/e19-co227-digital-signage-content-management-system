<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
    $c_id = $_GET["c_id"];
    $result = publishCourse($c_id);

    // Execute the update query
    if (isset($result['error'])) {
        header("Location: /pages/course?error={$result['error']}");
    } else
        header("Location: /pages/course?success={$result['message']}");
}

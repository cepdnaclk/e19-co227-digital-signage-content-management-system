<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
    $c_id = $_GET["c_id"];
    $result = publishCourse($c_id);

    // Execute the update query
    if (isset($result['error'])) {
        header("Location: /pages/course?error={$result['error']}");
    } else{
        logUserActivity("publish_course_poster");
        header("Location: /pages/course?success={$result['message']}");
    }
}

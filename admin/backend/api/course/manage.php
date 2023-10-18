<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"||"PUT") {
    // Check if the form fields are set and not empty
    if (
        isset($_POST["coordinator_name"]) &&
        isset($_POST["description"]) &&
        isset($_POST["display_option"]) &&
        isset($_POST["c_id"])
    ) {
        // Get form data
        $c_id = $_POST["c_id"];
        $c_coordinator = $_POST["coordinator_name"];
        $description = $_POST["description"];
        $display_option = $_POST["display_option"];
        $file = $_FILES["image"];
        $file_name = $_POST["image_loc"];
        $duration = $_POST["duration"]; 
        $intake_date = $_POST["intake_date"];
        $course_fee = $_POST["course_fee"];
        $poster_description = $_POST["poster_description"];

        editCourse($c_id, $c_coordinator, $description, $file, $file_name,$duration, $intake_date, $course_fee, $poster_description);


        header("Location: /pages/course");
        exit();
    } else {
        echo "'coordinator_name', 'description', 'display_option', and 'c_id' are required fields";
    }
}
?>
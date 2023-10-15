<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/dashboard.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feature = $_POST['feature'];
    $time = $_POST['time'];
    $timeSlide = $_POST['time_slide'];

    $result = updateTotalTime($feature, $time, $timeSlide);
    if (isset($result['error'])) {
        header("Location: /?error={$result['error']}");
    } else
        header("Location: /?success={$result['message']}");
}

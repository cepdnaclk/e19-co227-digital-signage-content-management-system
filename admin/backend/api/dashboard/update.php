<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/dashboard.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    hasClearence(1, function () {
        $feature = $_POST['feature'];
        $time = $_POST['time'];
        $timeSlide = $_POST['time_slide'];

        $result = updateTotalTime($feature, $time, $timeSlide);
        if (isset($result['error'])) {
            header("Location: /?error={$result['error']}");
        } else {
            logUserActivity("Updated time allocation for feature: $feature");
            header("Location: /?success={$result['message']}");
        }
    });
}

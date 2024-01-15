<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        // Get the event ID from the form submission
        $achivement = $_GET["publish_id"];
        $result = publishAchivement($achivement);
        print_r($result);
        // Execute the update query
        if (isset($result['error'])) {
            header("Location: /pages/achievements/?error={$result['error']}");
        } else {
            logUserActivity("Published achivement with id: $achivement");
            header("Location: /pages/achievements/?success={$result['message']}");
        }
    });
}

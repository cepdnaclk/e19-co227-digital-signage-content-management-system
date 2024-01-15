<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/previousevents.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        // Get the event ID from the form submission
        $event_id = $_GET["publish_id"];
        $result = publishPreviousEvent($event_id);

        // Execute the update query
        if (isset($result['error'])) {
            header("Location: /pages/previous/?error={$result['error']}");
        } else {
            logUserActivity("Published previous event with id: $event_id");
            header("Location: /pages/previous/?success={$result['message']}");
        }
    });
}

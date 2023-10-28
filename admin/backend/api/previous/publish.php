<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/previousevents.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        // Get the event ID from the form submission
        $event_id = $_GET["publish_id"];
        $result = publishPreviousEvent($event_id);

        // Execute the update query
        if (isset($result['error'])) {
            header("Location: /pages/previous/?error={$result['error']}");
        } else
            header("Location: /pages/previous/?success={$result['message']}");
    });
}

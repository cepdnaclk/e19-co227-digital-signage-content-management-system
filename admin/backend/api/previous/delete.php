<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/previousevents.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $event_id = $_GET["delete_id"];
        $result = deletePreviousEvent($event_id);
        if ($result) {
            logUserActivity("delete_previous_event");
            header("Location: /pages/previous/?success=successfully added lab slot=1");
        } else {
            header("Location: /pages/previous/?error=$result");
        }
    });
}

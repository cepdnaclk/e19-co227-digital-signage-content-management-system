<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/upcomingevents.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $event_id = $_GET["delete_id"];
        $result = deleteUpcomingEvent($event_id);
        if ($result) {
            logUserActivity("delete_upcoming_event");
            header("Location: /pages/upcoming/?success=successfully deleted the event");
        } else {
            header("Location: /pages/upcoming/?error=$result");
        }
    });
}

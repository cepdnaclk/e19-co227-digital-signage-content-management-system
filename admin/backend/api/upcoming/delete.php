<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/upcomingevents.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $event_id = $_GET["delete_id"];
        $result = deleteUpcomingEvent($event_id);
        if ($result) {
            header("Location: /pages/upcoming/?success=successfully deleted the event");
        } else {
            header("Location: /pages/upcoming/?error=$result");
        }
    });
}

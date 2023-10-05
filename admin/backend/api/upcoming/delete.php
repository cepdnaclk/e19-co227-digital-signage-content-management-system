<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/upcomingevents.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $event_id = $_GET["delete_id"];
    $result = deleteUpcomingEvent($event_id);
    if ($result) {
        header("Location: /pages/upcomingevents.php?success=1");
    } else {
        header("Location: /pages/upcomingevents.php?error=$result");
    }
}

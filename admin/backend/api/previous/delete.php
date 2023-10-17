<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/previousevents.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $event_id = $_GET["delete_id"];
    $result = deletePreviousEvent($event_id);
    if ($result) {
        header("Location: /pages/previous/?success=successfully added lab slot=1");
    } else {
        header("Location: /pages/previous/?error=$result");
    }
}

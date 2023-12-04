<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $f_id = $_GET["delete_id"];
        $result = deleteFacility($f_id);
        if ($result) {
            logUserActivity("delete_facility(lab,etc..)");
            header("Location: /pages/labinfo/?success=successfully deleted the Lab");
        } else {
            header("Location: /pages/labinfo/?error=$result");
        }
    });
}

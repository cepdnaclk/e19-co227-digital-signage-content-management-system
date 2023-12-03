<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        $f_id = $_GET["delete_id"];
        $result = deleteFacility($f_id);
        if ($result) {
            header("Location: /pages/labinfo/?success=successfully deleted the Lab");
        } else {
            header("Location: /pages/labinfo/?error=$result");
        }
    });
}

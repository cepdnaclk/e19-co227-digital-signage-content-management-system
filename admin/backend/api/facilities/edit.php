<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    hasClearence(1, function () { //adjust clearance only for superadmin to edit
        if (
            isset($_POST["f_id"]) &&
            isset($_POST["f_name"]) &&
            isset($_POST["total_seats"]) &&
            isset($_POST['price']) &&
            isset($_POST['floor']) &&
            isset($_POST['in_charge'])
        ) {
            // Get form data
            $f_id = $_POST["f_id"];
            $f_name = $_POST["f_name"];
            $total_seats = $_POST["total_seats"];
            $price = $_POST["price"];
            $floor = $_POST["floor"];
            $in_charge = $_POST['in_charge'];


            $result = editFacility($f_name, $total_seats, $price, $floor, $in_charge, $f_id);
            if (isset($result['error'])) {
                header("Location: /pages/labinfo/?error={$result['error']}");
            } else{
                logUserActivity("edit facility");
                header("Location: /pages/labinfo/?success={$result['message']}");
            }
        }


    });
}
exit();

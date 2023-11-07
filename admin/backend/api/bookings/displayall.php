<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/bookings.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/facilities.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        // Get form data
        $f_id = $_GET["f_id"];
        $result = displayall($f_id);

        if (isset($result['error'])) {
            header("Location: /pages/bookings/?error={$result['error']}");
        } else {

    // Serialize the $result array into a JSON string
    $result_json = json_encode($result);

    // Encode the JSON string to make it safe for inclusion in the URL
    $result_encoded = urlencode($result_json);

    // Include the encoded JSON string as a query parameter
    header("Location: /pages/bookings/displayall.php?result=$result_encoded");
}
    });
    exit();
} ?>


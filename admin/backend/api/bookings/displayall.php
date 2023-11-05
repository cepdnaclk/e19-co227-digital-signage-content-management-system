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
            $serializedData = serialize($result);
            header("Location: /pages/bookings/displayall.php?data=" . urlencode($serializedData));

            //header("Location: /pages/bookings/displayall.php?$result");// Include the new PHP file
            
            // if (is_array($result)) {
            //     foreach ($result as $row) {
            //         foreach ($row as $key => $value) {
            //             echo "$key: $value<br>";
            //         }
            //         echo "<br>";
            //     }
            // } else {
            //     echo "No results found.";
            // }
            
        }
    });
    exit();
}


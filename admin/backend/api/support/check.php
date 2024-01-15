<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/support.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    hasClearence(1, function () {
        // Check if the form fields are set and not empty
        if (
            isset($_POST["id"])
        ) {
            // Get form data
            $id = $_POST["id"];

            $result = checkMessage($id);
            if (isset($result['error'])) {
                // send json response send code 500 Internal Server Error
                echo json_encode($result);
            } else {
                logUserActivity("Checked message with id: {$id}");
                echo json_encode($result);
            }
        } else {
            echo json_encode("Error: Missing form data");
        }
    });
}
exit();
?>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivement.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
    $achivement = $_GET["publish_id"];
    $result = publishAchivement($achivement);

    // Execute the update query
    if (isset($result['error'])) {
        header("Location: /pages/upcoming/?error={$result['error']}");
    } else
        header("Location: /pages/upcoming/?success={$result['message']}");

    // Close the statement
    $stmt->close();
}

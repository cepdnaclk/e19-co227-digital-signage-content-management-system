<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        // Get the event ID from the form submission
        $achivement = $_GET["publish_id"];
        $result = publishAchivement($achivement);
        print_r($result);
        // Execute the update query
        if (isset($result['error'])) {
            header("Location: /pages/achievements/?error={$result['error']}");
        } else
            header("Location: /pages/achievements/?success={$result['message']}");
    });
}

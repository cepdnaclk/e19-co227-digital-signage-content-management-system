<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/maps.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    hasClearence(1, function () {
        // Get form data
        $m_name = $_POST["m_name"];
        $m_desc = $_POST["m_desc"];
        $m_file = $_FILES['m_file'];
        $m_file_path = $_POST['m_file_path'];
        $added_by = $_SESSION["user_id"];
        $m_id = $_POST["m_id"];

        $result = editMap($m_id, $m_name, $m_desc, $m_file, $m_file_path, $added_by);
        if (isset($result['error'])) {
            header("Location: /pages/maps/?error={$result['error']}");
        } else {
            logUserActivity("Edited map with id: {$result['id']}");
            header("Location: /pages/maps/?success={$result['message']}");
        }
    });
}

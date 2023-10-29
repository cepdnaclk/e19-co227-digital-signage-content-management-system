<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/maps.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    hasClearence(1, function () {
        if (
            isset($_FILES['m_file']) &&
            $_FILES['m_file']['error'] === UPLOAD_ERR_OK
        ) {
            // Get form data
            $m_name = $_POST["m_name"];
            $m_desc = $_POST["m_desc"];
            $m_file = $_FILES['m_file'];
            $added_by = $_SESSION["user_id"];

            $result = addMap($m_name, $m_file, $m_desc, $added_by);
            if (isset($result['error'])) {
                header("Location: /pages/maps/?error={$result['error']}");
            } else {
                header("Location: /pages/maps/?success={$result['message']}");
            }
        } else {
            //echo 'File upload error: ' . $_FILES['m_file']['error'];
            header("Location: /pages/maps/?error='Map video is required field'");
        }
    });
}
exit();

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/support.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (
        isset($_POST["name"]) ||
        isset($_POST["email"]) ||
        isset($_FILES['message'])
    ) {
        // Get form data
        $name = $_POST["name"] == " " ? "Anonymous" : $_POST["name"];
        $email = $_POST["email"] == " " ? "Anonymous" : $_POST["email"];
        $message = $_POST["message"];

        $result = addMessage($name, $email, $message);
        if (isset($result['error'])) {
            header("Location: /pages/contactNsupport/?error={$result['error']}");
        } else {
            logUserActivity("Added new message from {$name}");
            header("Location: /pages/contactNsupport/?success={$result['message']}");
        }
    } else {
        header("Location: /pages/contactNsupport/?error=Missing form data");
    }
}
exit();

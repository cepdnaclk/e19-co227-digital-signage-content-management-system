<?php
include_once "../config.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";

header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods (e.g., GET, POST, OPTIONS)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// Allow specific HTTP headers in requests
header("Access-Control-Allow-Headers: Content-Type");

if (isset($_POST["login"])) {
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];

    // Hash the provided password
    $hashed_password = hash('sha256', $password);

    // Create a prepared statement
    $stmt = $conn->prepare("SELECT u_id, user_name, `password` FROM `user` WHERE `user_name`=?");

    // Bind the parameters and execute
    $stmt->bind_param("s", $user_name);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['password'] == $hashed_password) {
            // Authentication successful
            $_SESSION["user_id"] = $row["u_id"]; // Set user_id in the session
            $_SESSION["user_name"] = $row["user_name"];
            header("Location: /");
            exit();
        } else {
            header("Location: /pages/login.php?error=Password Incorrect");
        }
    } else {
        // Authentication failed
        header("Location: /pages/login.php?error=No user found with $user_name");
        exit();
    }
} else {
    // Redirect to the login page if accessed directly without a POST request
    header("Location: ../pages/login.php");
    exit();
}

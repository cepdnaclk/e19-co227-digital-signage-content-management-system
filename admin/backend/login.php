<?php
include_once "../config.php";
session_start();

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
    $stmt = $conn->prepare("SELECT u_id, user_name, clearense FROM `user` WHERE BINARY `user_name`=? AND `password`=?");

    // Bind the parameters and execute
    $stmt->bind_param("ss", $user_name, $hashed_password);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Authentication successful
        $_SESSION["user_id"] = $row["u_id"]; // Set user_id in the session
        $_SESSION["user_name"] = $row["user_name"];
        $_SESSION["clearense"] = $row["clearense"]; // Store user role in the session
        logUserActivity("Logged in successfully as {$row['user_name']} with clearence {$row['clearense']} from device {$_SERVER['HTTP_USER_AGENT']} ");
        header("Location: /");
        exit();
    } else {
        // Authentication failed
        header("Location: /pages/login.php?error=No user found with this username");
        exit();
    }
} else {
    // Redirect to the login page if accessed directly without a POST request
    header("Location: ../pages/login.php");
    exit();
}

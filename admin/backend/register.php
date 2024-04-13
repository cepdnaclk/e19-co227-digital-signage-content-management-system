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

if (isset($_POST["register"])) {
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $rpassword = $_POST["rpassword"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];

    // Check if the passwords match
    if ($password != $rpassword) {
        header("Location: /pages/register.php?error=Passwords do not match");
        exit();
    }

    // Hash the provided password
    $hashed_password = hash('sha256', $password);

    // Create a prepared statement
    $stmt = $conn->prepare("INSERT INTO `user` (user_name, `password`, email, contact) VALUES (?, ?, ?, ?)");

    // Bind the parameters and execute
    $stmt->bind_param("ssss", $user_name, $hashed_password, $email, $contact);
    if ($stmt->execute()) {
        header("Location: /pages/login.php?message=Registration successful. Please login to continue");
        exit();
    } else {
        header("Location: /pages/register.php?error=" . $stmt->error);
        exit();
    }
} else {
    // Redirect to the login page if accessed directly without a POST request
    header("Location: ../pages/login.php");
    exit();
}

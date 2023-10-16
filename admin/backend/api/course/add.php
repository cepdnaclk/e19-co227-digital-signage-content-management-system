<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $c_code = $_POST["c_code"];
    $c_name = $_POST["c_name"];
    $description = $_POST["description"];

    // Validate and sanitize form data (you can add more validation as needed)
    $c_code = filter_var($c_code, FILTER_SANITIZE_STRING);
    $c_name = filter_var($c_name, FILTER_SANITIZE_STRING);
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    // Perform database insertion
    $stmt = $conn->prepare("INSERT INTO course (c_code, c_name, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $c_code, $c_name, $description);

    if ($stmt->execute()) {
        // Course added successfully
        header("Location: /pages/course?success=1");
        exit();
    } else {
        // Error occurred
        header("Location: /pages/course?error=1");
        exit();
    }
} else {
    // Handle invalid request method
    header("Location: /pages/course");
    exit();
}
?>

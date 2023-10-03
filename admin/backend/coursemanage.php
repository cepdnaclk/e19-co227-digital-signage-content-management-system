<?php
include_once "../config.php";

// Retrieve course ID from query parameter
$c_id = isset($_GET["c_id"]) ? $_GET["c_id"] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $coordinator_name = $_POST["coordinator_name"];
    $description = $_POST["description"];
    $display_option = $_POST["display_option"];

    // Additional form data retrieval and validation goes here

    // Perform database update based on $c_id
    $stmt = $conn->prepare("UPDATE course SET coordinator_name=?, description=?, display_option=? WHERE c_id=?");
    $stmt->bind_param("sssi", $coordinator_name, $description, $display_option, $c_id);

    if ($stmt->execute()) {
        // Course updated successfully
        header("Location: ../pages/course.php?success=1");
        exit();
    } else {
        // Error occurred
        header("Location: ../pages/course.php?error=1");
        exit();
    }
} else {
    // Handle invalid request method
    header("Location: ../pages/course.php");
    exit();
}

?>

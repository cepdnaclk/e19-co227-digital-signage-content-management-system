<?php
// Include your database connection
include_once "../config.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST"||"PUT") {
    // Get the course ID and new publish state from the POST data
    $c_id = isset($_POST["c_id"]) ? $_POST["c_id"] : null;
    $newPublishState = isset($_POST["published"]) ? $_POST["published"] : null;


    if ($c_id !== null && $newPublishState !== null) {
        // Update the course's c_published field in the database
        $query = "UPDATE course SET published = ? WHERE c_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $newPublishState, $c_id);

        if ($stmt->execute()) {
            // Send a JSON response for success
            echo json_encode(["success" => true]);
        } else {
            // Send a JSON response for error
            echo json_encode(["error" => "Failed to update course publish state"]);
        }
    } else {
        // Send a JSON response for missing parameters
        echo json_encode(["error" => "Missing parameters"]);
    }
} else {
    // Send a JSON response for invalid request method
    echo json_encode(["error" => "Invalid request method"]);
}
?>

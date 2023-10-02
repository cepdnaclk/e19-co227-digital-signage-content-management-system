<?php
include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
    $event_id = $_GET["delete_id"];

    // Delete the event from the 'upcoming_event' table
    $sql = "DELETE FROM upcoming_event WHERE e_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the event ID as a parameter
    mysqli_stmt_bind_param($stmt, "i", $event_id);

    if (mysqli_stmt_execute($stmt)) {
        // Event deleted successfully
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../pages/upcomingevents.php?success=true"); // Redirect back to the events page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Redirect to an error page or handle the request accordingly
    header("Location: ../pages/upcomingevents.php?success=true");
    exit();
}
?>

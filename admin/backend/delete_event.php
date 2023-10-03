<?php
include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
    $event_id = $_GET["delete_id"];
        $sql= "SELECT * FROM  upcoming_event WHERE e_id= $event_id";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        
        $event_img = $row['e_img'];  
        //Deleting related image file of the event
        // Check if the file exists before attempting to delete it
        if (file_exists($event_img)) {
            // Attempt to delete the image file
            if (unlink($event_img)) {
                //echo "Image deleted successfully.";
                    
            } else {
                echo "Failed to delete the image.";
            }
        } else {
            echo "Image file does not exist.";
        }

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
    
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>

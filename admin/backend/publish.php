<?php
include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
        $event_id = $_GET["publish_id"];
        $sql = "UPDATE upcoming_event SET published = !published WHERE e_id = ?";
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "i", $event_id);
    
  
            // Execute the update query
            if (mysqli_stmt_execute($stmt)) {

                 header("Location: ../pages/upcomingevents.php?success=true"); // Redirect back to the events page
                 exit();
            } else {
                
                echo "Error: " . mysqli_error($conn);
            }
        
            // Close the statement
            $stmt->close();
        } 
        
        
        $conn->close();

?>
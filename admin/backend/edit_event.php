 
 <?php
     
        include_once "../config.php";
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the form fields are set and not empty
            if (
                isset($_POST["display_from"]) &&
                isset($_POST["display_to"]) &&
                isset($_FILES["e_img"])
            ) {
                // Get form data
                $e_id = $_POST["e_id"];
                $e_name = $_POST["e_name"];
                $e_date = $_POST["e_date"];
                $e_time = $_POST["e_time"];
                $e_venue = $_POST["e_venue"];
                $display_from = $_POST["display_from"];
                $display_to = $_POST["display_to"];
                // Assuming 'added_by' is the user's ID, replace this with the actual user ID
                $added_by = 1; // Change this value as needed

                // File upload handling
                $targetDirectory = "../images/upcoming-event-posters/"; //  store uploaded images
                $targetFile = $targetDirectory . basename($_FILES["e_img"]["name"]);

                // Check if the file is an image
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "Only JPG, JPEG, and PNG files are allowed.";
                } else {
                    if (move_uploaded_file($_FILES["e_img"]["tmp_name"], $targetFile)) {

                        // Prepare and execute the SQL query to insert data into the 'upcoming_event' table
                        $sql = "UPDATE upcoming_event 
                                SET e_name = ?, 
                                    e_date = ?, 
                                    e_time = ?, 
                                    e_venue = ?, 
                                    e_img = ?, 
                                    display_from = ?, 
                                    display_to = ?, 
                                    added_by = ? 
                                WHERE e_id = ?";
                        $stmt = mysqli_prepare($conn, $sql);

                        // Bind parameters
                        mysqli_stmt_bind_param($stmt, "sssssssii", $e_name, $e_date, $e_time, $e_venue, $targetFile, $display_from, $display_to, $added_by, $e_id);

                        if (mysqli_stmt_execute($stmt)) {
                           
                            //echo "Event updated successfully";
                            

                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }

                        // Close the statement and database connection
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                    } else {
                        echo "Error uploading the image.";
                    }
                }
            } else {
                echo "'event_image', 'display_from', and 'display_to' are required fields";
            }
        }
        header("Location: ../pages/upcomingevents.php?success=true");
        exit();
?> 


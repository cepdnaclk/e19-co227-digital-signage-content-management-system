<?php
include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (
        // isset($_POST["display_from"]) &&
        // isset($_POST["display_to"]) &&
        isset($_FILES["p_img"])
    ) {
        // Get form data
        $p_name = $_POST["p_name"];
        $p_desc = $_POST["p_desc"];
        $p_date = $_POST["p_date"];
        // $p_time = $_POST["p_time"];
        // $p_venue = $_POST["p_venue"];
        // $display_from = $_POST["display_from"];
        // $display_to = $_POST["display_to"];

        // Assuming 'added_by' is the user's ID, replace this with the actual user ID
        $added_by = 1; // Change this value as needed

        // File upload handling
        $targetDirectory = "../images/previous-event-posters/"; //  store uploaded images
        $targetFile = $targetDirectory . basename($_FILES["p_img"]["name"]);

        // Check if the file is an image
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Only JPG, JPEG, and PNG files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["p_img"]["tmp_name"], $targetFile)) {

                // Prepare and execute the SQL query to insert data into the 'previous_event' table
                $sql = "INSERT INTO previous_event (p_name, p_desc, p_date, p_img, added_by) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);

                // Bind parameters
                mysqli_stmt_bind_param($stmt, "ssssi", $p_name, $p_desc, $p_date, $targetFile, $added_by);

                if (mysqli_stmt_execute($stmt)) {
                    // Event added successfully, trigger popup
                    echo '<script>alert("Event added successfully");</script>';

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
        echo "'event_image' is a required field";
    }
}
header("Location: ../pages/previousevents.php?success=true");
exit();
?>

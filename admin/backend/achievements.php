<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (
        // isset($_POST["display_from"]) &&
        // isset($_POST["display_to"]) &&
        isset($_FILES["a_img"])
    ) {
        // Get form data
        $a_name = $_POST["a_name"];
        $a_desc = $_POST["a_desc"];
        $a_date = $_POST["a_date"];
        // $a_time = $_POST["a_time"];
        // $a_venue = $_POST["a_venue"];
        // $display_from = $_POST["display_from"];
        // $display_to = $_POST["display_to"];

        // Assuming 'added_by' is the user's ID, replace this with the actual user ID
        $added_by = 1; // Change this value as needed

        // File upload handling
        $targetDirectory = "../images/achievements-posters/"; //  store uploaded images
        $targetFile = $targetDirectory . basename($_FILES["a_img"]["name"]);

        // Check if the file is an image
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Only JPG, JPEG, and PNG files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["a_img"]["tmp_name"], $targetFile)) {

                // Prepare and execute the SQL query to insert data into the 'achievement' table
                $sql = "INSERT INTO achievement (a_name, a_desc, a_date, a_img, added_by) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);

                // Bind parameters
                mysqli_stmt_bind_param($stmt, "ssssi", $a_name, $a_desc, $a_date, $targetFile, $added_by);

                if (mysqli_stmt_execute($stmt)) {
                    // Achievement added successfully, trigger popup
                    echo '<script>alert("Achievement added successfully");</script>';

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
header("Location: ../pages/achievements.php?success=true");
exit();
?>

<?php
include_once "../config.php";
include_once "../backend/functions/course.php";

// Ensure that 'c_id' is provided as a query parameter
if (isset($_GET['c_id'])) {
    $c_id = $_GET['c_id'];
    $course = getCourse($c_id);
    if (!$course)
        header("Location: /pages/course.php");
} else {
    header("Location: /pages/course.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/coursemanage.css">
    <title>Course Management</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(1); // Use an appropriate sidebar item number
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="course-manage">
                <h2>Course Management</h2>
                <div class="form-container">
                    <form action="../backend/coursemanage.php" method="POST" enctype="multipart/form-data">
                        <!-- Section 1: General Info -->
                        <h3>General Info</h3>
                        <label for="coordinator_name">Course Coordinator Name:</label>
                        <input type="text" name="coordinator_name" id="coordinator_name" value="<?= $course['c_coordinator'] ?>" required>
                        <br><br>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" rows="4" required><?= $course['description'] ?></textarea>
                        <br><br>

                        <!-- Section 2: Public Display Info -->
                        <h3>Public Display Info</h3>
                        <label>Choose an option:</label>
                        <input type="radio" name="display_option" id="poster_upload" value="upload">
                        <label for="poster_upload">Option 1: Upload Poster Image</label><br>
                        <input type="radio" name="display_option" id="manual_details" value="manual">
                        <label for="manual_details">Option 2: Enter Poster Details Manually</label><br><br>

                        <!-- Option 1: Upload Poster Image -->
                        <div id="poster_upload_section">
                            <label for="poster_image">Select a Poster Image:</label>
                            <input type="file" name="poster_image" id="poster_image">
                            <br><br>
                        </div>

                        <!-- Option 2: Manual Poster Details -->
                        <div id="manual_details_section">
                            <label for="duration">Duration (in months):</label>
                            <input type="number" name="duration" id="duration" value="<?= $course['duration(months)'] ?>">
                            <br><br>
                            <label for="intake_date">New Batch Intake Date:</label>
                            <input type="date" name="intake_date" id="intake_date" value="<?= $course['new_intake_date'] ?>">
                            <br><br>
                            <label for=" course_fee">Course Fee (Rs.):</label>
                            <input type="number" name="course_fee" id="course_fee" value="<?= $course['total_fee'] ?>">
                            <br><br>
                            <label for="poster_description">Description:</label>
                            <textarea name="poster_description" id="poster_description" rows="4"><?= $course['display_description'] ?></textarea>
                            <br><br>
                        </div>

                        <input type="hidden" name="c_id" value="<?php echo $c_id; ?>"> <!-- Include the course ID here -->

                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // JavaScript code to show/hide sections based on user's choice
        document.addEventListener("DOMContentLoaded", function() {
            const posterUploadSection = document.getElementById("poster_upload_section");
            const manualDetailsSection = document.getElementById("manual_details_section");
            const posterUploadRadio = document.getElementById("poster_upload");
            const manualDetailsRadio = document.getElementById("manual_details");

            // Initially, hide both sections
            posterUploadSection.style.display = "none";
            manualDetailsSection.style.display = "none";

            // Add event listener to show/hide sections based on radio button selection
            posterUploadRadio.addEventListener("change", function() {
                if (this.checked) {
                    posterUploadSection.style.display = "block";
                    manualDetailsSection.style.display = "none";
                }
            });

            manualDetailsRadio.addEventListener("change", function() {
                if (this.checked) {
                    manualDetailsSection.style.display = "block";
                    posterUploadSection.style.display = "none";
                }
            });
        });
    </script>
</body>

</html>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";

// Ensure that 'c_id' is provided as a query parameter
if (isset($_GET['c_id'])) {
    $c_id = $_GET['c_id'];
    $course = getCourse($c_id);
    if (!$course)
        header("Location: /pages/course");
} else {
    header("Location: /pages/course");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/coursemanage.css">
    <title>Course Management</title>
    <style>
        .container {
            padding: 1rem 0;
            background-color: var(--color-1);
            box-shadow: 0 0 0 1000px var(--color-1);
        }

        .container .title {
            filter: invert();
        }

        .container .title a {
            opacity: 1;
            color: black;
        }
    </style>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(1, 0); // Use an appropriate sidebar item number
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="course-manage">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Course ></a>Manage Course</h1>
                            <p>Manage the <?= $course['c_name'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/course/manage.php" method="POST" enctype="multipart/form-data">
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
                        <input type="radio" name="display_option" id="poster_only" value="poster">
                        <label for="poster_only">Option 1: Display Only Poster Image</label><br>
                        <input type="radio" name="display_option" id="manual_only" value="manual">
                        <label for="manual_only">Option 2: Display Only Poster Details Entered Manually</label><br>
                        <input type="radio" name="display_option" id="both" value="both">
                        <label for="both">Option 3: Display Both (Poster Image and Manual Details)</label><br><br>

                        <!-- Option 1: Display Only Poster Image -->
                        <div id="poster_upload_section">
                            <label for="poster_image">Select a Poster Image:</label>
                            <input type="file" name="poster_image" id="poster_image">
                            <input type="text" name="image_loc" value="<?= $course['Poster_img'] ?>">
                            <br><br>
                        </div>

                        <!-- Option 2: Display Only Manual Poster Details -->
                        <div id="manual_details_section">
                            <label for="duration">Duration (in months):</label>
                            <input type="number" name="duration" id="duration" value="<?= $course['duration(months)'] ?>">
                            <br><br>
                            <label for="intake_date">New Batch Intake Date:</label>
                            <input type="date" name="intake_date" id="intake_date" value="<?= $course['new_intake_date'] ?>">
                            <br><br>
                            <label for="course_fee">Course Fee (Rs.):</label>
                            <input type="number" name="course_fee" id="course_fee" value="<?= $course['total_fee'] ?>">
                            <br><br>
                            <label for="poster_description">Description:</label>
                            <textarea name="poster_description" id="poster_description" rows="4"><?= $course['display_description'] ?></textarea>
                            <br><br>
                        </div>

                        <!-- Option 3: Display Both Poster Image and Manual Details -->
                        <div id="both_section">
                            <label for="poster_image_both">Select a Poster Image:</label>
                            <input type="file" name="image" id="poster_image_both">
                            <input type="text" name="image_loc" style="display:none" value="<?= $course['Poster_img'] ?>">
                            <br><br>
                            <label for="duration_both">Duration (in months):</label>
                            <input type="number" name="duration" id="duration_both" value="<?= $course['duration(months)'] ?>">
                            <br><br>
                            <label for="intake_date_both">New Batch Intake Date:</label>
                            <input type="date" name="intake_date" id="intake_date_both" value="<?= $course['new_intake_date'] ?>">
                            <br><br>
                            <label for="course_fee_both">Course Fee (Rs.):</label>
                            <input type="number" name="course_fee" id="course_fee_both" value="<?= $course['total_fee'] ?>">
                            <br><br>
                            <label for="poster_description_both">Description:</label>
                            <textarea name="poster_description" id="poster_description_both" rows="4"><?= $course['display_description'] ?></textarea>
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
        document.addEventListener("DOMContentLoaded", function() {
            const posterUploadSection = document.getElementById("poster_upload_section");
            const manualDetailsSection = document.getElementById("manual_details_section");
            const bothSection = document.getElementById("both_section");
            const posterUploadRadio = document.getElementById("poster_only");
            const manualDetailsRadio = document.getElementById("manual_only");
            const bothRadio = document.getElementById("both");

            // Initially, make sure all sections are hidden
            posterUploadSection.style.display = "none";
            manualDetailsSection.style.display = "none";
            bothSection.style.display = "none";

            // Function to hide all sections
            function hideAllSections() {
                posterUploadSection.style.display = "none";
                manualDetailsSection.style.display = "none";
                bothSection.style.display = "none";
            }

            posterUploadRadio.addEventListener("change", function() {
                hideAllSections();
                posterUploadSection.style.display = "block";
            });

            manualDetailsRadio.addEventListener("change", function() {
                hideAllSections();
                manualDetailsSection.style.display = "block";
            });

            bothRadio.addEventListener("change", function() {
                hideAllSections();
                bothSection.style.display = "block";
            });
        });
    </script>



</body>

</html>
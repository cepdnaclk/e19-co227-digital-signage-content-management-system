<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";

// Ensure that 'c_id' is provided as a query parameter
if (isset($_GET['c_id'])) {
    $c_id = $_GET['c_id'];
    $course = getCourse($c_id);

    if (!$course) {
        header("Location: /pages/course");
    }
} else {
    header("Location: /pages/course");
}

$hasPoster = false;
$hasDetails = false;

// Check conditions and display course preview
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    if ($mode == "img")
        $hasPoster = true;
    else if ($mode == "des")
        $hasDetails = true;
    else {
        $hasPoster = true;
        $hasDetails = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/coursepreview.css">
    <title>Course Preview</title>
    <style>
        /* Add any additional styling for the preview page here */
    </style>
</head>

<body>
    <div class="course-preview">
        <?php if ($hasPoster && $hasDetails) { ?>
            <div class="two-columns">
                <div class="poster">
                    <img id="display_img" src="<?= $course['Poster_img'] ?>" alt="Course Poster">
                </div>
                <div class="details">
                    <h3><?= $course['c_name'] ?></h3>
                    <p><?= $course['c_code'] ?></p>
                    <ul>
                        <li><strong>Duration:</strong> <span id="display_dur"><?= $course['duration(months)'] ?></span> months</li>
                        <li><strong>New Batch Intake Date:</strong><span id="display_int"> <?= date('M d, Y', strtotime($course['new_intake_date'])) ?></span></li>
                        <li><strong>Total Course Fee:</strong> Rs.<span id="display_fee"> <?= $course['total_fee'] ?></span></li>
                        <li><strong>Description:</strong> <span id="display_des"><?= $course['display_description'] ?></span></li>
                    </ul>
                </div>
            </div>
        <?php } elseif ($hasPoster) { ?>
            <div class="centered">
                <img id="display_img" src="<?= $course['Poster_img'] ?>" alt="Course Poster">
            </div>
        <?php } elseif ($hasDetails) { ?>
            <div class="centered">
                <div class="details">
                    <h3><?= $course['c_name'] ?></h3>
                    <p><?= $course['c_code'] ?></p>
                    <ul>
                        <li><strong>Duration:</strong> <span id="display_dur"><?= $course['duration(months)'] ?></span> months</li>
                        <li><strong>New Batch Intake Date:</strong><span id="display_int"> <?= date('M d, Y', strtotime($course['new_intake_date'])) ?></span></li>
                        <li><strong>Total Course Fee:</strong> Rs.<span id="display_fee"> <?= $course['total_fee'] ?></span></li>
                        <li><strong>Description:</strong> <span id="display_des"><?= $course['display_description'] ?></span></li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="save-button">
        <button onclick="saveImage()">Save Image</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function saveImage() {
            const previewSection = document.querySelector('.course-preview');

            // Use html2canvas to capture the preview section
            html2canvas(previewSection).then(function (canvas) {
                // Convert the canvas to a data URL
                var dataURL = canvas.toDataURL("image/png");

                // Create a temporary link element to trigger the download
                var link = document.createElement('a');
                link.href = dataURL;
                link.download = 'course_preview.png';
                document.body.appendChild(link);

                // Trigger the download
                link.click();

                // Remove the temporary link element
                document.body.removeChild(link);
            });
        }
    </script>
</body>

</html>

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

// Check conditions and display course preview
$hasPoster = !empty($course['Poster_img']);
$hasDetails = isset($course['duration(months)']) && isset($course['total_fee']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/coursepreview.css">
    <title>Course Preview</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(1, 0); 
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <h2 class="head">Course Preview</h2>
            <div class="course-preview">
                <h2>Course Preview</h2>

                <?php if ($hasPoster && $hasDetails) { ?>
                    <div class="two-columns">
                        <div class="poster">
                            <img src="/images/course_posters/<?= $course['Poster_img'] ?>" alt="Course Poster">
                        </div>
                        <div class="details">
                            <h3>Course Details</h3>
                            <ul>
                                <li><strong>Duration:</strong> <?= $course['duration(months)'] ?> months</li>
                                <li><strong>New Batch Intake Date:</strong> <?= date('M d, Y', strtotime($course['new_intake_date'])) ?></li>
                                <li><strong>Total Course Fee:</strong> Rs. <?= $course['total_fee'] ?></li>
                                <li><strong>Description:</strong> <?= $course['display_description'] ?></li>
                            </ul>
                        </div>
                    </div>
                <?php } elseif ($hasPoster) { ?>
                    <div class="centered">
                        <img src="/images/course_posters/<?= $course['Poster_img'] ?>" alt="Course Poster">
                    </div>
                <?php } elseif ($hasDetails) { ?>
                    <div class="centered">
                        <div class="details">
                            <h3>Course Details</h3>
                            <ul>
                                <li><strong>Duration:</strong> <?= $course['duration(months)'] ?> months</li>
                                <li><strong>New Batch Intake Date:</strong> <?= date('M d, Y', strtotime($course['new_intake_date'])) ?></li>
                                <li><strong>Total Course Fee:</strong> Rs. <?= $course['total_fee'] ?></li>
                                <li><strong>Description:</strong> <?= $course['display_description'] ?></li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>

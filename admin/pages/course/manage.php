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
    <link rel="stylesheet" href="/css/coursemanage.css">
    <link rel="stylesheet" href="/css/coursepreview.css">
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
                    <form action="/backend/api/course/manage.php" method="POST" enctype="multipart/form-data" id="formUpload">
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
                        <p>Choose an option:</p> <br>
                        <a href="?c_id=<?= $_GET['c_id'] ?>&mode=img">
                            <input type="radio" name="display_option" id="poster_only" <?= ($hasPoster && !$hasDetails) ? "checked" : "" ?>>
                            <span>Option 1: Display Only Poster Image</span><br>
                        </a>
                        <a href="?c_id=<?= $_GET['c_id'] ?>&mode=des">
                            <input type="radio" name="display_option" id="manual_only" <?= (!$hasPoster && $hasDetails) ? "checked" : "" ?>>
                            <span>Option 2: Display Only Poster Details Entered Manually</span><br>
                        </a>
                        <a href="?c_id=<?= $_GET['c_id'] ?>&mode=all">
                            <input type="radio" name="display_option" id="both" <?= ($hasPoster && $hasDetails) ? "checked" : "" ?>>
                            <span>Option 3: Display Both (Poster Image and Manual Details)</span><br><br>
                        </a>

                        <!-- Option 1: Display Only Poster Image -->
                        <?php if ($hasPoster && !$hasDetails) { ?>
                            <div id="poster_upload_section">
                                <label for="poster_image">Select a Poster Image:</label>
                                <input type="file" name="poster_image" id="poster_image">
                                <input type="text" name="image_loc" style="display: none;" value="<?= $course['Poster_img'] ?>">
                                <br><br>
                            </div>
                        <?php } ?>

                        <!-- Option 2: Display Only Manual Poster Details -->
                        <?php if (!$hasPoster && $hasDetails) { ?>
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
<?php } ?>

                    <!-- Option 3: Display Both Poster Image and Manual Details -->
                    <?php if ($hasPoster && $hasDetails) { ?>
                        <div id="both_section">
                            <label for="poster_image">Select a Poster Image:</label>
                            <input type="file" name="image" id="poster_image">
                            <input type="text" name="image_loc" style="display:none" value="<?= $course['Poster_img'] ?>">
                            <br><br>
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
                    <?php } ?>

                    <div class="course-preview" id="course_display">
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
                                        <?php if (!empty($course['new_intake_date'])) { ?>
    <li><strong>New Batch Intake Date:</strong><span id="display_int"> <?= date('M d, Y', strtotime($course['new_intake_date'])) ?></span></li>
<?php } ?>
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
                                        <?php if (!empty($course['new_intake_date'])) { ?>
    <li><strong>New Batch Intake Date:</strong><span id="display_int"> <?= date('M d, Y', strtotime($course['new_intake_date'])) ?></span></li>
<?php } ?>
                                        <li><strong>Total Course Fee:</strong> Rs.<span id="display_fee"> <?= $course['total_fee'] ?></span></li>
                                        <li><strong>Description:</strong> <span id="display_des"><?= $course['display_description'] ?></span></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <input type="hidden" name="c_id" value="<?php echo $c_id; ?>"> <!-- Include the course ID here -->
                    <center><input type="submit" value="Submit"></center>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js" integrity="sha512-emSwuKiMyYedRwflbZB2ghzX8Cw8fmNVgZ6yQNNXXagFzFOaQmbvQ1vmDkddHjm5AITcBIZfC7k4ShQSjgPAmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const imgInput = document.getElementById('poster_image')
    const description = document.getElementById('poster_description')
    const duration = document.getElementById('duration')
    const intakeDate = document.getElementById('intake_date')
    const courseFee = document.getElementById('course_fee')

    const imgDisplay = document.getElementById('display_img')
    const descriptionDis = document.getElementById('display_des')
    const durationDis = document.getElementById('display_dur')
    const intakeDateDis = document.getElementById('display_int')
    const courseFeeDis = document.getElementById('display_fee')

    const handleImgChange = (e) => {
        if (imgDisplay)
            imgDisplay.src = URL.createObjectURL(e.target.files[0])
    }
    const handleDesChange = (e) => {
        if (descriptionDis)
            descriptionDis.textContent = e.target.value
    }
    const handleDurChange = (e) => {
        if (durationDis)
            durationDis.textContent = e.target.value
    }
    const handleIntChange = (e) => {
        if (intakeDateDis)
            intakeDateDis.textContent = e.target.value
    }
    const handleFeeChange = (e) => {
        if (courseFeeDis)
            courseFeeDis.textContent = e.target.value
    }

    if (imgInput)
        imgInput.addEventListener("change", handleImgChange);
    if (description)
        description.addEventListener("input", handleDesChange);
    if (duration)
        duration.addEventListener("input", handleDurChange);
    if (intakeDate)
        intakeDate.addEventListener("input", handleIntChange);
    if (courseFee)
        courseFee.addEventListener("input", handleFeeChange);
</script>

</body>
</html>

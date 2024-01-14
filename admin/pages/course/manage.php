<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";


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
                            <p>Manage the
                                <?= $course['c_name'] ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/course/manage.php" method="POST" enctype="multipart/form-data"
                        id="formUpload">
                        <!-- Section 1: General Info -->
                        <h3>General Info</h3>

                        <label for="courseCoordinator">Select Course Coordinator:</label>
                        <select id="courseCoordinator" name="coordinator_name">
                            <option value="">Select Coordinator</option>
                            <?php
                            $coordinators = get_coordinators(); // Fetch course coordinators using your function
                            foreach ($coordinators as $coordinator) {
                                if ($coordinator == $course['c_coordinator'])
                                    echo "<option value='$coordinator' selected>$coordinator</option>";
                                else
                                    echo "<option value='$coordinator'>$coordinator</option>";
                            }
                            ?>
                        </select>
                        <br><br>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" rows="4"
                            required><?= $course['description'] ?></textarea>
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
                                <input type="file" name="poster_image" id="poster_image" accept="image/png, image/jpg">
                                <input type="text" name="image_loc" style="display: none;"
                                    value="<?= $course['Poster_img'] ?>">
                                <br><br>
                            </div>
                        <?php } ?>

                        <!-- Option 2: Display Only Manual Poster Details -->
                        <?php if (!$hasPoster && $hasDetails) { ?>
                            <div id="manual_details_section">
                                <input type="text" name="image_loc" style="display:none"
                                    value="<?= $course['Poster_img'] ?>">
                                <label for="duration">Duration (in months):</label>
                                <input type="number" name="duration" id="duration"
                                    value="<?= $course['duration(months)'] ?>">
                                <br><br>
                                <label for="intake_date">New Batch Intake Date:</label>
                                <input type="date" name="intake_date" id="intake_date"
                                    value="<?= $course['new_intake_date'] ?>">
                                <br><br>
                                <label for="course_fee">Course Fee (Rs.):</label>
                                <input type="number" name="course_fee" id="course_fee" value="<?= $course['total_fee'] ?>">
                                <br><br>
                                <label for="poster_description">Description:</label>
                                <textarea name="poster_description" id="poster_description"
                                    rows="4"><?= $course['display_description'] ?></textarea>
                                <br><br>
                            </div>
                        <?php } ?>

                        <!-- Option 3: Display Both Poster Image and Manual Details -->
                        <?php if ($hasPoster && $hasDetails) { ?>
                            <div id="both_section">
                                <label for="poster_image">Select a Poster Image:</label>
                                <input type="file" name="poster_image" id="poster_image" accept="image/png, image/jpg">
                                <input type="text" name="image_loc" style="display:none"
                                    value="<?= $course['Poster_img'] ?>">
                                <br><br>
                                <label for="duration">Duration (in months):</label>
                                <input type="number" name="duration" id="duration"
                                    value="<?= $course['duration(months)'] ?>">
                                <br><br>
                                <label for="intake_date">New Batch Intake Date:</label>
                                <input type="date" name="intake_date" id="intake_date"
                                    value="<?= $course['new_intake_date'] ?>">
                                <br><br>
                                <label for="course_fee">Course Fee (Rs.):</label>
                                <input type="number" name="course_fee" id="course_fee" value="<?= $course['total_fee'] ?>">
                                <br><br>
                                <label for="poster_description">Description:</label>
                                <textarea name="poster_description" id="poster_description"
                                    rows="4"><?= $course['display_description'] ?></textarea>
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
                                        <h3>
                                            <?= $course['c_name'] ?>
                                        </h3>
                                        <p>
                                            <?= $course['c_code'] ?>
                                        </p>
                                        <ul>
                                            <li><strong>Duration:</strong> <span id="display_dur">
                                                    <?= $course['duration(months)'] ?>
                                                </span> months</li>
                                            <?php if (!empty($course['new_intake_date'])) { ?>
                                                <li><strong>New Batch Intake Date:</strong><span id="display_int">
                                                        <?= date('M d, Y', strtotime($course['new_intake_date'])) ?>
                                                    </span></li>
                                            <?php } ?>
                                            <li><strong>Total Course Fee:</strong> Rs.<span id="display_fee">
                                                    <?= $course['total_fee'] ?>
                                                </span></li>
                                            <li><strong>Description:</strong> <span id="display_des">
                                                    <?= $course['display_description'] ?>
                                                </span></li>
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
                                        <h3>
                                            <?= $course['c_name'] ?>
                                        </h3>
                                        <p>
                                            <?= $course['c_code'] ?>
                                        </p>
                                        <ul>
                                            <li><strong>Duration:</strong> <span id="display_dur">
                                                    <?= $course['duration(months)'] ?>
                                                </span> months</li>
                                            <?php if (!empty($course['new_intake_date'])) { ?>
                                                <li><strong>New Batch Intake Date:</strong><span id="display_int">
                                                        <?= date('M d, Y', strtotime($course['new_intake_date'])) ?>
                                                    </span></li>
                                            <?php } ?>
                                            <li><strong>Total Course Fee:</strong> Rs.<span id="display_fee">
                                                    <?= $course['total_fee'] ?>
                                                </span></li>
                                            <li><strong>Description:</strong> <span id="display_des">
                                                    <?= $course['display_description'] ?>
                                                </span></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">
                        <!-- Include the course ID here -->
                        <center><input type="submit" value="Submit"></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js"
        integrity="sha512-emSwuKiMyYedRwflbZB2ghzX8Cw8fmNVgZ6yQNNXXagFzFOaQmbvQ1vmDkddHjm5AITcBIZfC7k4ShQSjgPAmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
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

        let imgChange = false

        const handleImgChange = (e) => {
            if (imgDisplay) {
                imgDisplay.src = URL.createObjectURL(e.target.files[0])
                imgChange = true
            }
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

        // Select the form
        var form = document.querySelector('form');

        // Add an event listener for the submit event
        form.addEventListener('submit', function (event) {
            // Prevent the form from being submitted
            event.preventDefault();

            // Select the div you want to capture
            var div = document.getElementById('course_display');

            // Use html2canvas to capture the div
            if (imgChange)
                html2canvas(div, {
                    allowTaint: true,
                    useCors: true
                }).then(canvas => {
                    // Convert the canvas to a Blob object
                    canvas.toBlob(blob => {
                        // Create a new File object from the Blob
                        var file = new File([blob], `image${Date.now()}.png`, { type: "image/png" });

                        // Create a new FormData instance
                        var formData = new FormData();

                        // Append the file object to the FormData instance
                        formData.append('c_id', document.querySelector('input[name="c_id"]').value);
                        formData.append('poster', file);
                        formData.append('poster_path', document.querySelector('input[name="image_loc"]').value);

                        for (var pair of formData.entries()) {
                            console.log(pair[0] + ', ' + pair[1]);
                        }


                        // Send the FormData instance to the server
                        // You can use fetch or axios to do this
                        // This is an example using fetch
                        fetch('/backend/api/course/upload_poster.php', {
                            method: 'POST',
                            body: formData
                        }).then(response => {
                            return response.text();  // Parse the response body as JSON
                        }).then(response => {
                            console.log(response);

                            // After your function has completed, submit the form
                            if (duration)
                                form.submit();
                            else
                                window.location.href = "/pages/course?success=Course Updated Successfully";
                        }).catch(error => {
                            console.error(error);
                        });
                    });
                });
            else
                form.submit();
        });
    </script>

</body>

</html>
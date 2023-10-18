<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

// Fetch the list of course coordinators from the course table
$coordinators = get_coordinators();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data here
    // Retrieve the selected coordinator from $_POST["c_coordinator"]
    $selectedCoordinator = $_POST["c_coordinator"];
    // Rest of your form processing logic
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addcourse.css">
    <title>Add New Course</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(1,0);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-course">
                <h2>Add New Course</h2>
                <div class="form-container">
                    <form action="/backend/api/course/add.php" method="POST">
                        <label for="c_code">Course Code:</label>
                        <input type="text" name="c_code" id="c_code" required>
                        <br><br>
                        <label for="c_name">Course Name:</label>
                        <input type="text" name="c_name" id="c_name" required>
                        <br><br>
                        <label for="c_coordinator">Course Coordinator:</label>
                        <select id="coordinator-dropdown" name="c_coordinator">
                            <option value="">Select a Course Coordinator</option>
                            <?php
                            $coordinators = get_coordinators(); // Fetch course coordinators using your function
                            foreach ($coordinators as $coordinator) {
                                echo "<option value='$coordinator'>$coordinator</option>";
                            }
                            ?>
                        </select>

                        <br><br>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" rows="4" cols="50"></textarea>
                        <br><br>
                        <input type="submit" value="Add Course">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

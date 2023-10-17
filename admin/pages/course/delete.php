<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if (isset($_GET['c_id'])) {
    $courseId = $_GET['c_id'];

    $sql = "SELECT c_code FROM course WHERE c_id = $courseId";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $courseCode = $row['c_code'];
    }
    else {
        exit;
    }
} else {
    echo "Course ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/deletecourse.css">
    <title>Delete Course Confirmation</title>
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
    <div class="overlay" id="overlay"></div>
    <div class="card">
        <h2>Delete Confirmation</h2>
        <p><?php echo $courseCode; ?> and all its details & lab slots will be deleted permanently.</p>

            <a href="/backend/api/course?delete=<?php echo $courseId; ?>"><button type="submit" class="yes">YES</button></a>
            <a href="javascript:history.back();"><button type="button">NO</button></a>
    </div>
    </div>
    <script>
        // JavaScript to show the overlay and modal
        document.addEventListener("DOMContentLoaded", function () {
            const overlay = document.getElementById("overlay");
            const card = document.querySelector(".card"); 

            // Show the overlay and modal
            overlay.style.display = "block";
            card.style.display = "block"; 
        });
    </script>
</body>

</html>

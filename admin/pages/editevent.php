<?php
include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
    $event_id = $_GET["edit_id"];
    $sql= "SELECT * FROM  upcoming_event WHERE e_id= $event_id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    
    $event_name= $row['e_name'];
    $event_date= $row['e_date'];
    $event_time= $row['e_time'];
    $event_venue= $row['e_venue'];
    $event_display_from= $row['display_from'];
    $event_display_to= $row['display_to'];
    $event_img = $row['e_img'];
    if (file_exists($event_img)) {
        // Attempt to delete the image file
        if (unlink($event_img)) {
            //echo "Image deleted successfully.";
                
        } else {
            echo "Failed to delete the image.";
        }
    } else {
        echo "Image file does not exist.";
    }
    //Load the current image. Need debugging
    //$targetDirectory = "../images/upcoming-event-posters/"; // The directory where the images are stored
    //$targetFile = $targetDirectory . basename($event_img); // Full path to the image
    

}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/addnewevent.css">
    <title>Edit Event Information Form</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
             include_once(APP_ROOT . "/includes/sidebar.php");
             sidebar(3);
            ?>
        </div>

        <?php
         include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-events">
                <h2>Edit event information</h2>
                <div class="form-container">
                    <form action="../backend/edit_event.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="e_id" id="e_id" value= "<?php echo $event_id; ?>">
                        <br><br>
                        <label for="e_img">Select an Image:</label>
                        <input type="file" name="e_img" id="e_img"  required> <!--Debug -- Image path not loading to form-->
                        <br><br>
                        <label for="e_name">Name:</label>
                        <input type="text" name="e_name" id="e_name" value= "<?php echo $event_name; ?>">
                        <br><br>
                        <label for="e_date">Date:</label>
                        <input type="date" name="e_date" id="e_date" value= "<?php echo $event_date; ?>">
                        <br><br>
                        <label for="e_time">Time:</label>
                        <input type="time" name="e_time" id="e_time" value= "<?php echo $event_time; ?>">
                        <br><br>
                        <label for="e_venue">Venue:</label>
                        <input type="text" name="e_venue" id="e_venue" value= "<?php echo $event_venue; ?>">
                        <br><br>
                        <label for="display_from">Display from:</label>
                        <input type="date" name="display_from" id="display_from" value= "<?php echo $event_display_from; ?>" required>
                        <br><br>
                        <label for="display_to">Display to:</label>
                        <input type="date" name="display_to" id="display_to" value= "<?php echo $event_display_to; ?>" required>
                        <br><br>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
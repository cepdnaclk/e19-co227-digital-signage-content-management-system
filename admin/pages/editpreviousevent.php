<?php
include_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
    $event_id = $_GET["edit_id"];
    $sql= "SELECT * FROM  previous_event WHERE p_id= $event_id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    
    $event_name= $row['p_name'];
    $event_desc= $row['p_desc'];
    $event_date= $row['p_date'];
    //$event_display_from= $row['display_from'];
    //$event_display_to= $row['display_to'];
    $event_img = $row['p_img'];
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
    //$targetDirectory = "../images/previous-event-posters/"; // The directory where the images are stored
    //$targetFile = $targetDirectory . basename($event_img); // Full path to the image
    

}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/editpreviousevent.css">
    <title>Edit Previous Event Information Form</title>
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
            <div class="edit-previous-event">
                <h2>Edit Previous Event Information</h2>
                <div class="form-container">
                    <form action="../backend/editpreviousevent.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="p_id" id="p_id" value= "<?php echo $event_id; ?>">
                        <br>
                        <label for="p_img">Select an Image:</label>
                        <input type="file" name="p_img" id="p_img"  required> <!--Debug -- Image path not loading to form-->
                        <br>
                        <label for="p_name">Name:</label>
                        <input type="text" name="p_name" id="p_name" value= "<?php echo $event_name; ?>">
                        <br>
                        <label for="p_desc">Description:</label>
                        <textarea name="p_desc" id="p_desc" rows="6" value= "<?php echo $event_desc; ?>"></textarea>
                        <br>
                        <label for="p_date">Date:</label>
                        <input type="date" name="p_date" id="p_date" value= "<?php echo $event_date; ?>">
                        <br>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
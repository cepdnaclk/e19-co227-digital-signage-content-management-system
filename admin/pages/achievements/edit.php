<?php
include_once "/config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get the event ID from the form submission
    $event_id = $_GET["edit_id"];
    $sql= "SELECT * FROM  achievement WHERE a_id= $event_id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    
    $event_name= $row['a_name'];
    $event_desc= $row['a_desc'];
    $event_date= $row['a_date'];
    //$event_display_from= $row['display_from'];
    //$event_display_to= $row['display_to'];
    $event_img = $row['a_img'];
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
    //$targetDirectory = "../images/achievement-posters/"; // The directory where the images are stored
    //$targetFile = $targetDirectory . basename($event_img); // Full path to the image
    

}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/editachievement.css">
    <title>Edit Achievement Information Form</title>
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
            <div class="edit-achievement">
                <h2>Edit Achievement Information</h2>
                <div class="form-container">
                    <form action="/backend/editachievement.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="a_id" id="a_id" value= "<?php echo $event_id; ?>">
                        <br>
                        <label for="a_img">Select an Image:</label>
                        <input type="file" name="a_img" id="a_img"  required> <!--Debug -- Image path not loading to form-->
                        <br>
                        <label for="a_name">Achievement Title:</label>
                        <input type="text" name="a_name" id="a_name" value= "<?php echo $event_name; ?>">
                        <br>
                        <label for="a_desc">Description:</label>
                        <textarea name="a_desc" id="a_desc" rows="6" value= "<?php echo $event_desc; ?>"></textarea>
                        <br>
                        <label for="a_date">Date:</label>
                        <input type="date" name="a_date" id="a_date" value= "<?php echo $event_date; ?>">
                        <br>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";

$a_id = $_GET['edit_id'];
if(isset($a_id)){
    $row = getAchivementById($a_id);
    if(isset($row['error']) && !isset($_GET['error'])){
        header("Location: ?error={$row['error']}");
    }

    $a_name = $row['a_name'];
    $a_date = $row['a_date'];
    $a_desc = $row['a_desc'];
    $a_img = $row['a_img'];
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
                    <form action="/backend/api/achivements/edit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="a_id" id="a_id" value= "<?= $a_id; ?>">
                        <br>
                        <label for="a_img">Select an Image:</label>
                        <input type="file" name="a_img" id="a_img"> <!--Debug -- Image path not loading to form-->
                        <input type="text" name="a_img_loc" style="display:none" value="<?= $a_img ?>">
                        <br>
                        <label for="a_name">Achievement Title:</label>
                        <input type="text" name="a_name" id="a_name" value= "<?= $a_name; ?>">
                        <br>
                        <label for="a_desc">Description:</label>
                        <textarea name="a_desc" id="a_desc" rows="6"><?= $a_desc; ?></textarea>
                        <br>
                        <label for="a_date">Date:</label>
                        <input type="date" name="a_date" id="a_date" value= "<?= $a_date; ?>">
                        <br>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
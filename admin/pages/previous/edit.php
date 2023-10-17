<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/previousevents.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $event_id = $_GET["edit_id"];
    $row = getPreviousEventById($event_id);
    if (isset($row['error']) && !isset($_GET['error']))
        header("Location: ?error={$row['error']}");

    $event_name = $row['e_name'];
    $event_date = $row['e_date'];
    $event_time = $row['e_time'];
    $event_venue = $row['e_venue'];
    $event_display_from = $row['display_from'];
    $event_display_to = $row['display_to'];
    $event_img = $row['e_img'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/addnewevent.css">
    <title>Edit Event Information Form</title>
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
            sidebar(3, 2);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="add-events">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Previous Events ></a>Edit Event</h1>
                            <p>edit the <?php echo $event_name; ?> event</p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/previous/edit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="e_id" id="e_id" value="<?php echo $event_id; ?>">
                        <br><br>
                        <label for="e_img">Select an Image:</label>
                        <input type="file" name="e_img" id="e_img">
                        <input type="text" name="e_img_loc" style="display:none" value="<?= $event_img ?>">
                        <br><br>
                        <label for="e_name">Name:</label>
                        <input type="text" name="e_name" id="e_name" value="<?php echo $event_name; ?>">
                        <br><br>
                        <label for="e_date">Date:</label>
                        <input type="date" name="e_date" id="e_date" value="<?php echo $event_date; ?>">
                        <br><br>
                        <label for="e_time">Time:</label>
                        <input type="time" name="e_time" id="e_time" value="<?php echo $event_time; ?>">
                        <br><br>
                        <label for="e_venue">Venue:</label>
                        <input type="text" name="e_venue" id="e_venue" value="<?php echo $event_venue; ?>">
                        <br><br>
                        <label for="display_from">Display from:</label>
                        <input type="date" name="display_from" id="display_from" value="<?php echo $event_display_from; ?>" required>
                        <br><br>
                        <label for="display_to">Display to:</label>
                        <input type="date" name="display_to" id="display_to" value="<?php echo $event_display_to; ?>" required>
                        <br><br>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
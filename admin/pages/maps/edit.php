<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/maps.php";

$m_id = $_GET['edit_id'];
if (isset($m_id)) {
    $row = getMapById($m_id);
    if (isset($row['error']) && !isset($_GET['error'])) {
        header("Location: ?error={$row['error']}");
    }

    $m_name = $row['m_name'];
    $m_desc = $row['m_desc'];
    $m_file = $row['m_file'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/css/editmap.css">
    <title>Edit Map Details Form</title>
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
            sidebar(5, 1);
            ?>
        </div>

        <?php
        include_once(APP_ROOT . "/includes/header.php");
        ?>
        <div class="right">
            <div class="edit-map">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="./">Maps ></a>Edit Map</h1>
                            <p>Edit <?= $m_name; ?> Map</p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <form action="/backend/api/maps/edit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="m_id" id="m_id" value="<?= $m_id; ?>">
                        <br>
                        <label for="m_file">Select a video:</label>
                        <input type="file" name="m_file" id="m_file"> 
                        <input type="text" name="m_file_path" style="display:none" value="<?= $m_file ?>">
                        <br>
                        <label for="m_name">Map Title:</label>
                        <input type="text" name="m_name" id="m_name" value="<?= $m_name; ?>" required>
                        <br>
                        <label for="m_desc">Description:</label>
                        <textarea name="m_desc" id="m_desc" rows="6"><?= $m_desc; ?></textarea>
                        <br>
                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";

$achivements = getAchivements();
if (isset($achivements['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$achivements['error']}");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/achievements.css">
    <title>IT Center | Achievements</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(3,3);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="achievements">
                <div class="container">
                    <div class="title">
                        <h1>Achievements</h1>
                        <a href="add.php"><img src="/images/Add_round.svg" alt=""> Add Achievement</a>
                    </div>
                    <div class="card-container">
                        <?php if (isset($achivements[0]['a_name']))
                            foreach ($achivements as $key => $row) { ?>
                            <div class='card'>
                                <img src='<?= $row["a_img"] ?>' alt='Add Event Image'>
                                <div class='card-content'>
                                    <h2 class='card-title'>
                                        <?= $row["a_name"] ?>
                                    </h2>
                                    <p class='card-description'>
                                        <?= $row["a_desc"] ?>
                                    </p>
                                    <p class='card-date'>
                                        <?= $row["a_date"] ?>
                                    </p>

                                </div>
                                <div class='card-actions'>
                                    <a href="edit.php?edit_id=<?= $row['a_id'] ?>">
                                        <button class="edit-button">
                                            <span class="icon">&#9998;</span>
                                            Edit
                                        </button>
                                    </a>
                                    <?php if ($row['published'] == 1) { ?>
                                        <a class="unpublish" href="/backend/api/achivements/publish.php?publish_id=<?= $row['a_id'] ?>">
                                            <button class="unpublish-button">
                                                <span class="icon">&#10680;</span>
                                                Unpublish
                                            </button>
                                        </a>
                                    <?php } else { ?>
                                        <a class="publish" href="/backend/api/achivements/publish.php?publish_id=<?= $row['a_id'] ?>">
                                            <button class="publish-button">
                                                <span class="icon">&#10004;</span>
                                                Publish
                                            </button>
                                        </a>
                                    <?php } ?>

                                    <a href="/backend/api/achivements/delete.php?delete_id=<?= $row['a_id'] ?>">
                                        <button class="delete-button">
                                            <span class="icon">&#128465;</span>
                                            Delete
                                        </button>
                                    </a>
                                </div>
                            </div>
                        <?php }
                        else { ?>
                            <p style="width:400px">No Achivements Found.
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    <a style="text-decoration:underline" href="add.php">Add Achievements</a>
                                <?php } ?>
                            </p>
                        <?php } ?>
                    </div>
            </main>
        </div>
    </div>
</body>

</html>
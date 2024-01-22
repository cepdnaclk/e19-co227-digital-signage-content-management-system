<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/upcomingevents.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/previousevents.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";

$uevents = getUpcomingEvents();
if (isset($uevents['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$uevents['error']}");

$pevents = getPreviousEvents();
if (isset($pevents['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$pevents['error']}");

$achivements = getAchivements();
if (isset($achivements['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$achivements['error']}");


$uevents = array_slice($uevents, 0, 4);
$pevents = array_slice($pevents, 0, 4);
$achivements = array_slice($achivements, 0, 4);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/upcomingevents.css">
    <title>IT Center | UpcomingEvents</title>
    <style>
        .card-container {
            margin-bottom: 5rem !important;
        }
    </style>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(3, 0);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="upcomingevents">
                <div class="container">
                    <div class="title">
                        <h1>Upcoming Events</h1>
                        <a href="/pages/upcoming/">See All</a>
                    </div>
                    <div class="card-container">
                        <?php if (!isset($_GET['error']))
                            foreach ($uevents as $key => $row) { ?>
                                <div class='card'>
                                    <img src='<?= $row["e_img"] ?>' alt='Add Event Image'>
                                    <div class='card-content'>
                                        <h2 class='card-title'>
                                            <?= $row["e_name"] ?>
                                        </h2>
                                        <p class='card-date'>
                                            <?= $row["e_date"] ?> at
                                            <?= $row["e_time"] ?>
                                        </p>
                                        <p class='card-venue'>
                                            <?= $row["e_venue"] ?>
                                        </p>
                                        <p><br>Display Duration</p>
                                        <p class='card-duration'>From
                                            <?= $row["display_from"] ?><br>To
                                            <?= $row["display_to"] ?>
                                        </p>
                                    </div>
                                    <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                        <div class='card-actions'>
                                            <a href="/pages/upcoming/edit.php?edit_id=<?= $row['e_id'] ?>">
                                                <button class="edit-button">
                                                    <span class="icon">&#9998;</span>
                                                    Edit
                                                </button>
                                            </a>
                                            <?php if ($row['published'] == 1) { ?>
                                                <a class="unpublish"
                                                    href="/backend/api/upcoming/publish.php?publish_id=<?= $row['e_id'] ?>">
                                                    <button class="unpublish-button">
                                                        <span class="icon">&#10680;</span>
                                                        Unpublish
                                                    </button>
                                                </a>
                                            <?php } else { ?>
                                                <a class="publish"
                                                    href="/backend/api/upcoming/publish.php?publish_id=<?= $row['e_id'] ?>">
                                                    <button class="publish-button">
                                                        <span class="icon">&#10004;</span>
                                                        Publish
                                                    </button>
                                                </a>
                                            <?php } ?>
                                            </button>
                                            <button class="delete-button">
                                                <span class="icon">&#128465;</span>
                                                <a href="/backend/api/upcoming/delete.php?delete_id=<?= $row['e_id'] ?>">Delete</a>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                            <p style="width:400px">No Upcoming Events Found.
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    <a style="text-decoration:underline" href="/pages/upcoming/add.php">Add Upcoming
                                        Events</a>
                                <?php } ?>
                            </p>
                        <?php } ?>
                    </div>
                    <div class="title">
                        <h1>Previous Events</h1>
                        <a href="/pages/previous/">See All</a>
                    </div>
                    <div class="card-container">
                        <?php if (!isset($_GET['error']))
                            foreach ($pevents as $key => $row) { ?>
                                <div class='card'>
                                    <img src='<?= $row["e_img"] ?>' alt='Add Event Image'>
                                    <div class='card-content'>
                                        <h2 class='card-title'>
                                            <?= $row["e_name"] ?>
                                        </h2>
                                        <p class='card-date'>
                                            <?= $row["e_date"] ?> at
                                            <?= $row["e_time"] ?>
                                        </p>
                                        <p class='card-venue'>
                                            <?= $row["e_venue"] ?>
                                        </p>
                                        <p><br>Display Duration</p>
                                        <p class='card-duration'>From
                                            <?= $row["display_from"] ?><br>To
                                            <?= $row["display_to"] ?>
                                        </p>
                                    </div>
                                    <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                        <div class='card-actions'>
                                            <a href="/pages/previous/edit.php?edit_id=<?= $row['e_id'] ?>">
                                                <button class="edit-button">
                                                    <span class="icon">&#9998;</span>
                                                    Edit
                                                </button>
                                            </a>
                                            <?php if ($row['published'] == 1) { ?>
                                                <a class="unpublish"
                                                    href="/backend/api/previous/publish.php?publish_id=<?= $row['e_id'] ?>">
                                                    <button class="unpublish-button">
                                                        <span class="icon">&#10680;</span>
                                                        Unpublish
                                                    </button>
                                                </a>
                                            <?php } else { ?>
                                                <a class="publish"
                                                    href="/backend/api/previous/publish.php?publish_id=<?= $row['e_id'] ?>">
                                                    <button class="publish-button">
                                                        <span class="icon">&#10004;</span>
                                                        Publish
                                                    </button>
                                                </a>
                                            <?php } ?>
                                            </button>
                                            <button class="delete-button">
                                                <span class="icon">&#128465;</span>
                                                <a href="/backend/api/previous/delete.php?delete_id=<?= $row['e_id'] ?>">Delete</a>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                            <p style="width:400px">No Previous Events Found.
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    <a style="text-decoration:underline" href="/pages/previous/add.php">Add Event</a>
                                <?php } ?>
                            </p>
                        <?php } ?>
                    </div>
                    <div class="title">
                        <h1>Achivements</h1>
                        <a href="/pages/achievements/">See All</a>
                    </div>
                    <div class="card-container">
                        <?php if (!isset($_GET['error']))
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
                                    <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                        <div class='card-actions'>
                                            <a href="/pages/achievements/edit.php?edit_id=<?= $row['a_id'] ?>">
                                                <button class="edit-button">
                                                    <span class="icon">&#9998;</span>
                                                    Edit
                                                </button>
                                            </a>
                                            <?php if ($row['published'] == 1) { ?>
                                                <a class="unpublish"
                                                    href="/backend/api/achivements/publish.php?publish_id=<?= $row['a_id'] ?>">
                                                    <button class="unpublish-button">
                                                        <span class="icon">&#10680;</span>
                                                        Unpublish
                                                    </button>
                                                </a>
                                            <?php } else { ?>
                                                <a class="publish"
                                                    href="/backend/api/achivements/publish.php?publish_id=<?= $row['a_id'] ?>">
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
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                            <p style="width:400px">No Achivements Found.
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    <a style="text-decoration:underline" href="/pages/achievements/add.php">Add Achievements</a>
                                <?php } ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
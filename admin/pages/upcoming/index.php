<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/upcomingevents.php";

$events = getUpcomingEvents();
if (isset($events['error']))
    echo $events['error'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/upcomingevents.css">
    <title>IT Center | UpcomingEvents</title>
</head>

<body>
    <?php
    if (isset($_GET['error']))
        echo '<script>alert("' . $_GET['error'] . '")</script>';
    ?>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(3);
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
                        <a href="/pages/addnewevent.php"><img src="../images/Add_round.svg" alt=""> Add Event</a>

                    </div>
                    <div class="card-container">
                        <?php foreach ($events as $key => $row) { ?>
                            <div class='card'>
                                <img src='<?= $row["e_img"] ?>' alt='Add Event Image'>
                                <div class='card-content'>
                                    <h2 class='card-title'><?= $row["e_name"] ?></h2>
                                    <p class='card-date'><?= $row["e_date"] ?> at <?= $row["e_time"] ?></p>
                                    <p class='card-venue'><?= $row["e_venue"] ?></p>
                                    <p><br>Display Duration</p>
                                    <p class='card-duration'>From <?= $row["display_from"] ?><br>To <?= $row["display_to"] ?></p>
                                </div>
                                <div class='card-actions'>
                                    <a href="edit.php?edit_id=<?= $row['e_id'] ?>">
                                        <button class="edit-button">
                                            <span class="icon">&#9998;</span>
                                            Edit
                                        </button>
                                    </a>
                                    <?php if ($row['published'] == 1) { ?>
                                        <a class="unpublish" href="/backend/publish.php?publish_id=<?= $row['e_id'] ?>">
                                            <button class="unpublish-button">
                                                <span class="icon">&#10680;</span>
                                                Unpublish
                                            </button>
                                        </a>
                                    <?php } else { ?>
                                        <a class="publish" href="../backend/publish.php?publish_id=' . $row['e_id'] . '">
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
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
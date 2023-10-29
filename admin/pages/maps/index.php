
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/maps.php";


$maps = getMaps();
if (isset($maps['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$maps['error']}");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/maps.css">
    <title>IT Center | Maps</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(5, 1);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="maps">
                <div class="container">
                    <div class="title">
                        <h1>Maps</h1>
                        <a href="add.php"><img src="/images/Add_round.svg" alt=""> Add New Map</a>
                    </div>
                    <div class="card-container">
                        <?php if (isset($maps[0]['m_name']))
                            foreach ($maps as $key => $row) { ?>
                            <div class='card'>
                                
                                <div class='card-content'>
                                    <h2 class='card-title'>
                                        <?= $row["m_name"] ?>
                                    </h2>
                                    <div class='inner-content'>
                                    <video width="260" height="160" controls>
                                    <source src='<?= $row["m_file"] ?>'  type="video/mp4">
                                    Your browser does not support the video tag.
                                    </video> 
                                    
                                    <p class='card-description'>
                                        <?= $row["m_desc"] ?>
                                    </p>
                                    </div>


                                </div>
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    <div class='card-actions'>
                                        <a href="edit.php?edit_id=<?= $row['m_id'] ?>">
                                            <button class="edit-button">
                                                <span class="icon">&#9998;</span>
                                                Edit
                                            </button>
                                        </a>
                                        

                                        <a href="/backend/api/maps/delete.php?delete_id=<?= $row['m_id'] ?>">
                                            <button class="delete-button">
                                                <span class="icon">&#128465;</span>
                                                Delete
                                            </button>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }
                        else { ?>
                            <p style="width:400px">No Maps Found.
                                <?php if ($clearenceStatus[$_SESSION['clearense']] > 0) { ?>
                                    <a style="text-decoration:underline" href="add.php">Add Maps</a>
                                <?php } ?>
                            </p>
                        <?php } ?>
                    </div>
            </main>
        </div>
    </div>
</body>

</html>
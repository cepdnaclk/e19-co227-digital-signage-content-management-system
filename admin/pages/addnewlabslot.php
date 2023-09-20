<?php include_once "../config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addlabslot.css">
    <title>IT Center | Lab Allocations</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(4);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="addlabslots">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="">Lab Allocation ></a>Add a Lab slot</h1>
                            <p>Create a labslot for a course</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel | manage <?= $_GET['name'] ?> </title>
</head>

<body>
    <div class="container mt-5 py-5">
        <div class="d-flex align-items-center justify-content-between">
            <h3>Manage Board : <?= $_GET['name'] ?></h3>
            <a href="/pages/board.php?id=<?= $_GET['id'] ?>" class="btn btn-primary"><i class="fas fa-pen"></i> Edit Board</a>
        </div>
    </div>
</body>

</html>
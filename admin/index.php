<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/support.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$boards = getBoards();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/index.css">
    <title>Admin Panel</title>
</head>

<body>
    <div class="container mt-5 pt-5">
        <div class="d-flex align-items-center justify-content-between">
            <h3>Your Boards</h3>
            <a href="/pages/board.php" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i> New Board</a>
        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 mt-4">
            <?php
            foreach ($boards as $board) {
            ?>
                <div class="col">
                    <div class="card">
                        <img src="<?= isset($board["theme"]["bg"]) ? $board["theme"]["bg"] : "https://placehold.co/800?text=" . $board['board_name'] . "&font=raleway" ?> " class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $board["board_name"] ?></h5>
                            <p class="card-text"><?= $board["owner"] ?></p>
                            <a href="/pages/manage-board.php?name=<?= $board["board_name"] ?>&id=<?= $board['board_id'] ?>" class="btn btn-success">Manage</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
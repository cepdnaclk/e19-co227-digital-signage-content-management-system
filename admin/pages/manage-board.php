<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/backend/functions/topic.php");

$users = getUsers((int) $_GET['id']);
$topics = getTopics((int) $_GET['id']);

$images = array("timetable_theme", "slider_theme", "image_theme", "video_theme", "qr_theme");
$types = array("timetable","slider","image","video","qr");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/manage-board.css">
    <title>Admin Panel | Manage <?= $_GET['name'] ?> </title>
</head>

<body>
    <div class="manage-board">
        <div class="row">
            <nav id="sidebar" class="navbar navbar-dark bg-dark col-md-3">
                <p class="navbar-brand"><a href="/"><i class="fa-solid fa-circle-left"></i></a> Manage <b><?= $_GET['name'] ?></b></p>
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link" href="#topics">Topics</a>
                    <a class="nav-link" href="#admins">Admins</a>
                </nav>
                <a href="/pages/board.php?id=<?= $_GET['id'] ?>" class="btn btn-success edit"><i class="fas fa-pen"></i> Edit Board</a>
            </nav>

            <div data-bs-spy="scroll" data-bs-target="#sidebar" data-bs-offset="0" tabindex="0" class="col-md-9">
                <div class="container">
                    <div id="topics">
                        <div class="d-flex justify-content-between">
                            <h4>Topics</h4>
                            <a href="/pages/topic.php?id=<?= $_GET['id'] ?>&name=<?= $_GET['name'] ?>" class="btn btn-warning"><i class="fa-solid fa-plus me-2"></i> New Topic</a>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 my-3">
                            <?php foreach ($topics as $key => $topic) { ?>
                                <div class="col">
                                    <div class="card p-3">
                                        <img src="/images/<?= $images[$topic['type']] ?>" alt="">
                                        <h5 class="py-3"><i class="<?= $topic['icon'] ?>"></i> <?= $topic['title'] ?></h5>
                                        <a href="/pages/topics/<?= $types[$topic['type']] ?>.php?id=<?= $_GET['id'] ?>&name=<?= $_GET['name'] ?>&type=<?=$topic['type']?>&topic=<?=$topic['title']?>" class="btn btn-success">Manage</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div id="users">
                        <h4 class="mt-5 mb-3">Admins</h4>
                        <form action="/backend/api/boards/assign_user.php" method="post" class="mb-3 d-flex gap-3">
                            <input type="text" name="user_name" class="form-control" placeholder="Enter username">
                            <input type="text" name="board_name" class="d-none" value="<?= $_GET['name'] ?>">
                            <input type="text" name="board_id" class="d-none" value="<?= $_GET['id'] ?>">
                            <button class="btn btn-success w-25">Add User</button>
                        </form>
                        <ul class="users-list">
                            <li class="titles">
                                <span>Username</span>
                                <span>Email</span>
                                <span>Contact</span>
                                <span>Actions</span>
                            </li>
                            <?php foreach ($users as $key => $user) { ?>
                                <li>
                                    <span><?= $user['user_name'] ?></span>
                                    <span><?= $user['email'] ?></span>
                                    <span><?= $user['contact'] ?></span>
                                    <span>
                                        <a href="/backend/api/boards/kick_user.php?user_name=<?= $user['user_name'] ?>&board_id=<?= $_GET['id'] ?>&board_name=<?= $_GET['name'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
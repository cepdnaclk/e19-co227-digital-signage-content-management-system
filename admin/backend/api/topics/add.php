<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/topic.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $icon = $_POST['icon'];
    $theme = $_POST['theme'];
    $board_id = $_POST['board_id'];
    $board_name = $_POST['board_name'];

    $topic = addTopic($board_id, $title, $icon, $theme);
    if ($topic['error']) {
        header("Location: /pages/manage-board.php?id=$board_id&name=$board_name&error=" . $topic['error']);
    } else {
        header("Location: /pages/manage-board.php?id=$board_id&name=$board_name&success=" . $topic['message']);
    }
}

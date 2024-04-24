<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/topic.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $icon = $_POST['icon'];
    $theme = $_POST['theme'];
    $board_id = $_POST['board_id'];

    $topic = addTopic($board_id, $title, $icon, $theme);
    if ($topic['error']) {
        header("Location: /pages/manage-board.php?board_id=$board_id&error=" . $topic['error']);
    } else {
        header("Location: /pages/manage-board.php?board_id=$board_id&success=" . $topic['message']);
    }
}

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $board_id = $_GET['board_id'];
    $user_name = $_GET['user_name'];
    $board_name = $_GET['board_name'];

    $result = kickUser($board_id, $user_name);
    if ($result['message']) {
        header('Location: /pages/manage-board.php?id=' . $board_id . '&name=' . $board_name . '&success=' . $result['message']);
    } else {
        header('Location: /pages/manage-board.php?id=' . $board_id . '&name=' . $board_name . '&error=' . $result['error']);
    }
}

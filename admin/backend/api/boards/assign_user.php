<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/boards.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $board_id = $_POST['board_id'];
    $user_name = $_POST['user_name'];
    $board_name = $_POST['board_name'];

    $result = assignBoard($board_id, $user_name);
    if ($result) {
        header('Location: /pages/manage-board.php?id=' . $board_id . '&name=' . $board_name . '&success=' . $result['message']);
    } else {
        header('Location: /pages/manage-board.php?id=' . $board_id . '&name=' . $board_name . '&error=' . $result['error']);
    }
}

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php"; // Include your database connection
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions/topic.php';

// boards(board_id,board_name,theme)

// check is owner of a board
function isOwnerBoard(int $board_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM clearence WHERE board_id = ? AND user_id = ? AND `level` = 1");
    $stmt->bind_param('ii', $board_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        return true;
    } else {
        return false;
    }
}

// check is admin of a board
function isAdminBoard(int $board_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM clearence WHERE board_id = ? AND user_id = ?");
    $stmt->bind_param('ii', $board_id, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        return true;
    } else {
        return false;
    }
}

function getBoard(int $board_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM boards WHERE board_id = ?");
    $stmt->bind_param('i',  $board_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $row = $result->fetch_assoc();
    if ($row) {
        return array(
            "board_id" => $row['board_id'],
            "board_name" => $row['board_name'],
            "theme" => json_decode($row['theme'], true)
        );
    } else {
        return array("error" => "Board not found");
    }
}

function getBoards()
{
    global $conn;

    $stmt = $conn->prepare("SELECT b.*, u.user_name AS `owner` FROM boards b LEFT JOIN clearence c ON b.board_id = c.board_id LEFT JOIN user u ON c.user_id = u.u_id WHERE c.level = 1 AND c.board_id IN (SELECT board_id FROM clearence WHERE user_id = ?)");

    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $boards = array();
    while ($row = $result->fetch_assoc()) {
        $boards[] = array(
            "board_id" => $row['board_id'],
            "board_name" => $row['board_name'],
            "owner" => $row['owner'],
            "theme" => json_decode($row['theme'], true)
        );
    }

    return $boards;
}

function createBoard(string $board_name, string $theme)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO boards (board_name, theme) VALUES (?, ?)");
    $stmt->bind_param('ss', $board_name, $theme);
    $stmt->execute();
    $stmt->close();

    $board_id = $conn->insert_id;

    $stmt = $conn->prepare("INSERT INTO clearence (user_id, board_id, `level`) VALUES (?, ?, 1)");
    $stmt->bind_param('ii', $_SESSION['user_id'], $board_id);
    if ($stmt->execute()) {
        return array("message" => "Board created successfully");
    } else {
        return array("error" => "Failed to create board");
    }
}

function manageBoard(string $board_name, string $theme, int $board_id)
{
    if (isAdminBoard($board_id)) {
        global $conn;

        $stmt = $conn->prepare("UPDATE boards SET board_name = ?, theme = ? WHERE board_id = ?");
        $stmt->bind_param('ssi', $board_name, $theme, $board_id);
        if ($stmt->execute()) {
            return array("message" => "Board updated successfully");
        } else {
            return array("error" => "Failed to update board");
        }
    } else {
        return array("error" => "You are not the owner of this board");
    }
}

function deleteBoard(int $board_id)
{
    if (isOwnerBoard($board_id)) {
        deleteTopicsBoard($board_id);

        global $conn;

        $stmt = $conn->prepare("DELETE FROM boards WHERE board_id = ?");
        $stmt->bind_param('i', $board_id);
        if ($stmt->execute()) {
            return array("message" => "Board deleted successfully");
        } else {
            return array("error" => "Failed to delete board");
        }
    } else {
        return array("error" => "You are not the owner of this board");
    }
}

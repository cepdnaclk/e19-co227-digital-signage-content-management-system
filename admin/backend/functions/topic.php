<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php"; // Include your database connection
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions/boards.php';

function isAdminTopic(int $topic_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM topics WHERE topic_id = ? AND board_id IN (SELECT board_id FROM clearence WHERE user_id = ?)");
    $stmt->bind_param('ii', $topic_id, $_SESSION['user_id']);
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

function getTopics(int $board_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM topics WHERE board_id = ?");

    $stmt->bind_param('i', $board_id);

    $stmt->execute();

    $result = $stmt->get_result();

    $topics = array();
    while ($row = $result->fetch_assoc()) {
        $topics[] = $row;
    }

    $stmt->close();

    return $topics;
}

function getTopicCount(int $board_id)
{
    if (isAdminBoard($board_id)) {
        $topics = getTopics($board_id);
        return count($topics);
    }
    return array("error" => "You are not admin of this board");
}

function getTopicBoard(int $topic_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT board_id FROM topics WHERE topic_id = ?");

    $stmt->bind_param('i', $topic_id);

    $stmt->execute();

    $result = $stmt->get_result();

    $topic = $result->fetch_assoc();

    $stmt->close();

    return $topic;
}

function addTopic(int $board_id, string $title, string $icon)
{
    if (isAdminBoard($board_id)) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO topics (board_id, title, icon) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $board_id, $title, $icon);

        if (!$stmt->execute())
            return array("error" => $stmt->error);
        else
            return array("message" => "Add Topic Succesfully");
    }

    return array("error" => "You are not admin of this board");
}

function editTopic(int $topic_id, string $title, string $icon)
{
    if (isAdminTopic($topic_id)) {
        global $conn;

        $stmt = $conn->prepare("UPDATE topics SET title = ?, icon = ? WHERE topic_id = ?");
        $stmt->bind_param('ssi', $title, $icon, $topic_id);

        if (!$stmt->execute())
            return array("error" => $stmt->error);
        else
            return array("message" => "Edit Topic Succesfully");
    }

    return array("error" => "You are not admin of this board");
}

function deleteTopic(int $topic_id)
{
    if (isAdminTopic($topic_id)) {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM topics WHERE topic_id = ?");
        $stmt->bind_param('i', $topic_id);

        if (!$stmt->execute())
            return array("error" => $stmt->error);
        else
            return array("message" => "Delete Topic Succesfully");
    }

    return array("error" => "You are not admin of this board");
}

function deleteTopicsBoard(int $board_id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM topics WHERE board_id = ?");
    $stmt->bind_param('i', $board_id);

    if (!$stmt->execute())
        return array("error" => $stmt->error);
    else
        return array("message" => "Delete Topics Succesfully");
}

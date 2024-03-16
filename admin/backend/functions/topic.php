<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

function getTopics()
{
    global $conn;

    $topics = array();

    $result = $conn->query("SELECT topics FROM topics");

    while ($row = $result->fetch_assoc()) {
        $topics[] = $row;
    }

    return $topics;
}

function getTopicCount()
{
    $topics = getTopics();
    return count($topics);
}

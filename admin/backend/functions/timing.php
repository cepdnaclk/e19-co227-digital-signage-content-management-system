<?php
// timing(timing_Id,topic,per_page,per_slide)

include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/backend/functions/topic.php';

function getTimes()
{
    global $conn;

    $timing = array();

    $result = $conn->query("SELECT topics.topic, timing.* FROM topics JOIN timing ON topics.Id = timing.topic");

    while ($row = $result->fetch_assoc()) {
        $timing[$row['topic']] = $row;
    }

    return $timing;
}

function getTiming($topic)
{
    $timing = getTimes();

    return $timing[$topic];
}

function addTiming($topic, $per_page, $per_slide)
{
    if (isAdminTopic($topic)) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO timing (topic, per_page, per_slide) VALUES (?, ?, ?)");
        $stmt->bind_param('sii', $topic, $per_page, $per_slide);
        if ($stmt->execute()) {
            return array("message" => "Timing added");
        } else {
            return array("error" => "Error adding timing");
        }
    } else {
        return array("error" => "You are not admin of this topic");
    }
}

function removeTimings(){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM timing");
    $stmt->execute();
    $stmt->close();
}

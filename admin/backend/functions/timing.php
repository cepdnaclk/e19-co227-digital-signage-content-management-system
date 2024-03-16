<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

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

// Function to update the "Total Time" field in the database
function updateTotalTime($id, $totalTime, $slideTime)
{
    global $conn;
    $result = array();

    $totalTime = (int) $totalTime;

    // Check if $slideTime is null, and set the appropriate placeholder
    if ($slideTime === null) {
        $sql = "UPDATE `timing` SET `per_page` = ?, `per_slide` = NULL WHERE `Id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $totalTime, $id);
    } else {
        $slideTime = (int) $slideTime;
        $sql = "UPDATE `timing` SET `per_page` = ?, `per_slide` = ? WHERE `Id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $totalTime, $slideTime, $id);
    }

    if ($stmt->execute()) {
        $result = array('message' => "Data updated Successfully");
    } else {
        $result = array('error' => $stmt->error);
    }

    $stmt->close();

    return $result;
}

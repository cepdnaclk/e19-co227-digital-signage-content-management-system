<?php
include_once "../config.php";

// Function to add a new previous event
function addPreviousEvent($eventName, $eventImage, $displayFrom, $displayTo, $addedBy)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO previous_event (p_name, p_img, display_from, display_to, added_by) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $eventName, $eventImage, $displayFrom, $displayTo, $addedBy);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to get a list of previous events
function getPreviousEvents()
{
    global $conn;
    $result = [];
    $query = "SELECT * FROM previous_event";
    $res = $conn->query($query);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
    }
    return $result;
}

// Handle adding a new previous event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_event"])) {
    $eventName = $_POST["event_name"];
    $eventImage = $_POST["event_image"]; // You can handle file upload here
    $displayFrom = $_POST["display_from"];
    $displayTo = $_POST["display_to"];
    $addedBy = $_SESSION["userId"];

    if (addPreviousEvent($eventName, $eventImage, $displayFrom, $displayTo, $addedBy)) {
        header("Location: previousevents.php?success=1");
    } else {
        header("Location: previousevents.php?error=1");
    }
}

// Get a list of previous events
$previousEvents = getPreviousEvents();
?>

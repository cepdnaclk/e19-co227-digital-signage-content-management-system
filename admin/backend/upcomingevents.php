<?php
include_once "../config.php";

// Function to add a new upcoming event
function addUpcomingEvent($eventName, $eventDate, $eventTime, $eventVenue, $eventImage, $displayFrom, $displayTo, $addedBy)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO upcoming_event (e_name, e_date, e_time, e_venue, e_img, display_from, display_to, added_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $eventName, $eventDate, $eventTime, $eventVenue, $eventImage, $displayFrom, $displayTo, $addedBy);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to get a list of upcoming events
function getUpcomingEvents()
{
    global $conn;
    $result = [];
    $query = "SELECT * FROM upcoming_event";
    $res = $conn->query($query);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
    }
    return $result;
}

// Handle adding a new upcoming event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_event"])) {
    $eventName = $_POST["event_name"];
    $eventDate = $_POST["event_date"];
    $eventTime = $_POST["event_time"];
    $eventVenue = $_POST["event_venue"];
    $eventImage = $_POST["event_image"]; // You can handle file upload here
    $displayFrom = $_POST["display_from"];
    $displayTo = $_POST["display_to"];
    $addedBy = $_SESSION["userId"];

    if (addUpcomingEvent($eventName, $eventDate, $eventTime, $eventVenue, $eventImage, $displayFrom, $displayTo, $addedBy)) {
        header("Location: upcomingevents.php?success=1");
    } else {
        header("Location: upcomingevents.php?error=1");
    }
}

// Get a list of upcoming events
$upcomingEvents = getUpcomingEvents();
?>

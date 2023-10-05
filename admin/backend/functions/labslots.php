<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/helpers/datetime.php";

function getLabSlots($lab, $monday, $sunday)
{
    global $conn;

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM labslot WHERE lab = ? AND (oneday IS NULL OR (oneday BETWEEN ? AND ?))");
    $stmt->bind_param('sss', $lab, $monday, $sunday);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch and return the data
    $labSlots = array();
    while ($row = $result->fetch_assoc()) {
        $labSlots[] = $row;
    }

    // Close the statement
    $stmt->close();

    return $labSlots;
}

function getLabSlotsToday($today, $day)
{
    global $conn;

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM labslot WHERE date = ? OR oneday = ?");
    $day = date("Y-m-d");
    $stmt->bind_param('is', $today, $day);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch and return the data
    $labSlots = array();
    while ($row = $result->fetch_assoc()) {
        $labSlots[] = $row;
    }
    // Close the statement
    $stmt->close();

    return $labSlots;
}

function getLabSlotsAll()
{
    global $conn;

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM labslot");

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch and return the data
    $labSlots = array();
    while ($row = $result->fetch_assoc()) {
        $labType = $row['lab'];

        // Create an array for the lab type if it doesn't exist
        if (!isset($labSlots[$labType])) {
            $labSlots[$labType] = array();
        }

        // Add the lab slot information to the lab type array
        $labSlots[$labType][] = $row;
    }
    // Close the statement
    $stmt->close();

    return $labSlots;
}


// Function to add a new lab slot
function addLabSlot($lab, $course, $start, $end, $date, $isoneday, $oneday)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO labslot (lab, course, start, end, date, oneday) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$isoneday)
        $oneday = null;
    $stmt->bind_param("ssssis", $lab, $course, $start, $end, $date, $oneday);
    if ($stmt->execute()) {
        return true;
    } else {
        return $stmt->error;
    }
}

function editLabSlot($id, $course, $start, $end, $date, $isoneday, $oneday)
{
    global $conn;
    if (!$isoneday) {
        $stmt = $conn->prepare("UPDATE labslot SET course = ?, start = ?, end = ?, date = ?, oneday = NULL WHERE slot_id = ?");
        $stmt->bind_param("ssssi", $course, $start, $end, $date, $id);
    } else {
        $stmt = $conn->prepare("UPDATE labslot SET course = ?, start = ?, end = ?, date = ?, oneday = ? WHERE slot_id = ?");
        $stmt->bind_param("sssssi", $course, $start, $end, $date, $oneday, $id);
    }
    if ($stmt->execute()) {
        return true;
    } else {
        return $stmt->error;
    }
}


// Function to delete a lab slot
function deleteLabSlot($slotID)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM labslot WHERE slot_id = ?");
    $stmt->bind_param("i", $slotID);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

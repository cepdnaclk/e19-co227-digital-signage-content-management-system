<?php
include_once "../config.php";

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
function addLabSlot($courseCode, $facilityId, $lectureDay, $lectureTime)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO timetable (c_code, f_id, lec_day, lec_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $courseCode, $facilityId, $lectureDay, $lectureTime);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to edit a lab slot
function editLabSlot($courseCode, $facilityId, $lectureDay, $lectureTime)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE timetable SET lec_day=?, lec_time=? WHERE c_code=? AND f_id=?");
    $stmt->bind_param("sssi", $lectureDay, $lectureTime, $courseCode, $facilityId);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a lab slot
function deleteLabSlot($courseCode, $facilityId)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM timetable WHERE c_code=? AND f_id=?");
    $stmt->bind_param("si", $courseCode, $facilityId);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo ($_POST['course']);
}

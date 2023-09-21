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

// Add or edit lab slot based on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addLabSlot"])) {
        $courseCode = $_POST["courseCode"];
        $facilityId = $_POST["facilityId"];
        $lectureDay = $_POST["lectureDay"];
        $lectureTime = $_POST["lectureTime"];
        if (addLabSlot($courseCode, $facilityId, $lectureDay, $lectureTime)) {
            header("Location: labslots.php?success=1");
        } else {
            header("Location: labslots.php?error=1");
        }
    } elseif (isset($_POST["editLabSlot"])) {
        $courseCode = $_POST["courseCode"];
        $facilityId = $_POST["facilityId"];
        $lectureDay = $_POST["lectureDay"];
        $lectureTime = $_POST["lectureTime"];
        if (editLabSlot($courseCode, $facilityId, $lectureDay, $lectureTime)) {
            header("Location: labslots.php?success=2");
        } else {
            header("Location: labslots.php?error=2");
        }
    }
}

// Handle lab slot deletion
if (isset($_GET["delete"])) {
    $courseCode = $_GET["delete"];
    $facilityId = $_GET["facilityId"];
    if (deleteLabSlot($courseCode, $facilityId)) {
        header("Location: labslots.php?success=3");
    } else {
        header("Location: labslots.php?error=3");
    }
}

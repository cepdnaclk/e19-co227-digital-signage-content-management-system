<?php
include_once "../config.php";

header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods (e.g., GET, POST, OPTIONS)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// Allow specific HTTP headers in requests
header("Access-Control-Allow-Headers: Content-Type");

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

function getLabSlotsToday($today)
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['updateid'] == '') {
        $result = addLabSlot($_POST['lab'], $_POST['course'], $_POST['stime'], $_POST['etime'], $_POST['date'], $_POST['isoneday'], $_POST['oneday']);
        if ($result === true)
            header("Location: ../pages/labslots.php?success=1");
        else
            header("Location: ../pages/addnewlabslot.php?error=$result&lab={$_POST['lab']}");
    } else {
        $result = editLabSlot($_POST['updateid'], $_POST['course'], $_POST['stime'], $_POST['etime'], $_POST['date'], $_POST['isoneday'], $_POST['oneday']);
        if ($result === true)
            header("Location: ../pages/labslots.php?success=2");
        else
            header("Location: ../pages/addnewlabslot.php?error=$result&lab={$_POST['lab']}");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['delete_id'])) {
        $result = deleteLabSlot($_GET['delete_id']);
        if ($result === true)
            header("Location: ../pages/labslots.php?success=1");
        else
            header("Location: ../pages/labslots.php?error=$result");
    } else if (isset($_GET['today'])) {
        $result = getLabSlotsToday($_GET['today']);

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}

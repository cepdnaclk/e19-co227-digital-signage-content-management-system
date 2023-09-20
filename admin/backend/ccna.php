<?php
include_once "../config.php";

// Function to add a new CCNA course offering
function addCCNACourseOffering($courseCode, $courseId, $coordinatorId, $startDate, $displayInfo)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO course_offering (c_code, c_id, coordinator_id, starting_date, display_info) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiss", $courseCode, $courseId, $coordinatorId, $startDate, $displayInfo);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to edit a CCNA course offering
function editCCNACourseOffering($courseCode, $courseId, $coordinatorId, $startDate, $displayInfo)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE course_offering SET c_id=?, coordinator_id=?, starting_date=?, display_info=? WHERE c_code=?");
    $stmt->bind_param("iisss", $courseId, $coordinatorId, $startDate, $displayInfo, $courseCode);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a CCNA course offering
function deleteCCNACourseOffering($courseCode)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM course_offering WHERE c_code=?");
    $stmt->bind_param("s", $courseCode);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Add or edit CCNA course offering based on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addCCNACourseOffering"])) {
        $courseCode = $_POST["courseCode"];
        $courseId = $_POST["courseId"];
        $coordinatorId = $_POST["coordinatorId"];
        $startDate = $_POST["startDate"];
        $displayInfo = $_POST["displayInfo"];
        if (addCCNACourseOffering($courseCode, $courseId, $coordinatorId, $startDate, $displayInfo)) {
            header("Location: ccna.php?success=1");
        } else {
            header("Location: ccna.php?error=1");
        }
    } elseif (isset($_POST["editCCNACourseOffering"])) {
        $courseCode = $_POST["courseCode"];
        $courseId = $_POST["courseId"];
        $coordinatorId = $_POST["coordinatorId"];
        $startDate = $_POST["startDate"];
        $displayInfo = $_POST["displayInfo"];
        if (editCCNACourseOffering($courseCode, $courseId, $coordinatorId, $startDate, $displayInfo)) {
            header("Location: ccna.php?success=2");
        } else {
            header("Location: ccna.php?error=2");
        }
    }
}

// Handle CCNA course offering deletion
if (isset($_GET["delete"])) {
    $courseCode = $_GET["delete"];
    if (deleteCCNACourseOffering($courseCode)) {
        header("Location: ccna.php?success=3");
    } else {
        header("Location: ccna.php?error=3");
    }
}
?>

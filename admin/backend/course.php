<?php
include_once "../config.php";

// Function to add a new course
function addCourse($name, $details)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO course (c_name, details) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $details);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to edit a course
function editCourse($id, $name, $details)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE course SET c_name=?, details=? WHERE c_id=?");
    $stmt->bind_param("ssi", $name, $details, $id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a course
function deleteCourse($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM course WHERE c_id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Add or edit course based on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addCourse"])) {
        $courseName = $_POST["courseName"];
        $courseDetails = $_POST["courseDetails"];
        if (addCourse($courseName, $courseDetails)) {
            header("Location: courses.php?success=1");
        } else {
            header("Location: courses.php?error=1");
        }
    } elseif (isset($_POST["editCourse"])) {
        $courseId = $_POST["courseId"];
        $courseName = $_POST["courseName"];
        $courseDetails = $_POST["courseDetails"];
        if (editCourse($courseId, $courseName, $courseDetails)) {
            header("Location: courses.php?success=2");
        } else {
            header("Location: courses.php?error=2");
        }
    }
}

// Handle course deletion
if (isset($_GET["delete"])) {
    $courseId = $_GET["delete"];
    if (deleteCourse($courseId)) {
        header("Location: courses.php?success=3");
    } else {
        header("Location: courses.php?error=3");
    }
}
?>

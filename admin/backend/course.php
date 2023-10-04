<?php
include_once "../config.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Function to add a new course
function addCourse($conn, $c_code, $c_name)
{
    $stmt = $conn->prepare("INSERT INTO course (c_code, c_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $c_code, $c_name);
    if ($stmt->execute()) {
        return true; // Success
    } else {
        return false; // Error
    }
}

// Function to edit an existing course
function editCourse($conn, $c_id, $c_code, $c_name)
{
    $stmt = $conn->prepare("UPDATE course SET c_code = ?, c_name = ? WHERE c_id = ?");
    $stmt->bind_param("ssi", $c_code, $c_name, $c_id);
    if ($stmt->execute()) {
        return true; // Success
    } else {
        return false; // Error
    }
}

// Function to delete a course
function deleteCourse($conn, $c_id)
{
    $stmt = $conn->prepare("DELETE FROM course WHERE c_id = ?");
    $stmt->bind_param("i", $c_id);
    if ($stmt->execute()) {
        return true; // Success
    } else {
        return false; // Error
    }
}

// Function to retrieve all courses
function getCourses($conn)
{
    $result = $conn->query("SELECT c_id, c_code, c_name FROM course");
    if ($result === false) {
        return false; // Error in query execution
    }
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
    return $courses;
}

function getCourse($conn, $c_id)
{
    $result = $conn->query("SELECT * FROM course WHERE c_id=$c_id");
    if ($result === false) {
        return false; // Error in query execution
    }
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    if (sizeof($courses) > 0)
        return $courses[0];
}

// Main code to handle requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Add, Edit, and Delete requests
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        $c_id = isset($_POST["c_id"]) ? $_POST["c_id"] : null;
        $c_code = isset($_POST["c_code"]) ? $_POST["c_code"] : null;
        $c_name = isset($_POST["c_name"]) ? $_POST["c_name"] : null;

        if ($action == "add") {
            $result = addCourse($conn, $c_code, $c_name);
        } elseif ($action == "edit" && $c_id !== null) {
            $result = editCourse($conn, $c_id, $c_code, $c_name);
        } elseif ($action == "delete" && $c_id !== null) {
            $result = deleteCourse($conn, $c_id);
        }

        if ($result) {
            // Send a JSON response for success
            echo json_encode(["success" => true]);
        } else {
            // Send a JSON response for error
            echo json_encode(["error" => "Operation failed"]);
        }
    }
}

// Handle the initial load and retrieve all courses
if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_GET['c_id'])) {
    $courses = getCourses($conn);
    if ($courses !== false) {
        // Send a JSON response for courses
        header("Content-Type: application/json"); // Set the Content-Type header to JSON
        echo json_encode($courses);
    } else {
        // Send a JSON response for error
        echo json_encode(["error" => "Failed to retrieve courses"]);
    }
}

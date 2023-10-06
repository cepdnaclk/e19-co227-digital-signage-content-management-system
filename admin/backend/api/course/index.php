<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";

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
            // This block will be used for deleting a course
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
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["delete"])) {
        $c_id = $_GET["delete"];
        $result = deleteCourse($c_id);

        if ($result) {
            // Send a JSON response for success
            header("Location: /pages/course.php?success={$result['message']}");
        } else {
            // Send a JSON response for error
            header("Location: /pages/course.php?error={$result['error']}");
        }
    } else if (isset($_GET['c_id'])) {
        // If 'c_id' is provided in the query parameters, retrieve a single course
        $c_id = $_GET['c_id'];
        $course = getCourse($c_id);

        if ($course !== false) {
            // Send a JSON response for the retrieved course
            header("Content-Type: application/json"); // Set the Content-Type header to JSON
            echo json_encode($course);
        } else {
            // Send a JSON response for error
            echo json_encode(["error" => "Failed to retrieve the course"]);
        }
    } else {
        // If 'c_id' is not provided, retrieve all courses
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
}

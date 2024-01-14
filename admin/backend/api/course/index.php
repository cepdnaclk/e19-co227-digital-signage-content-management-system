<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";

// Handle the initial load and retrieve all courses
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["delete"])) {
        $c_id = $_GET["delete"];
        $result = deleteCourse($c_id);

        if ($result) {
            // Send a JSON response for success
            header("Location: /pages/course?success={$result['message']}");
        } else {
            // Send a JSON response for error
            header("Location: /pages/course?error={$result['error']}");
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
        if ($_SESSION['clearense'] == "course_c")
            $courses = getCoursesCo($_SESSION['user_name']);
        else
            $courses = getCourses();

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

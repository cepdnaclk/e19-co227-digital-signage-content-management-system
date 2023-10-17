<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  "/config.php";

// Function to add a new course
function addCourse($c_code, $c_name)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO course (c_code, c_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $c_code, $c_name);
    if ($stmt->execute()) {
        return true; // Success
    } else {
        return false; // Error
    }
}

// Function to edit an existing course
function editCourse($c_id, $c_code, $c_name)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE course SET c_code = ?, c_name = ? WHERE c_id = ?");
    $stmt->bind_param("ssi", $c_code, $c_name, $c_id);
    if ($stmt->execute()) {
        return true; // Success
    } else {
        return false; // Error
    }
}

// Function to delete a course
function deleteCourse($c_id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM course WHERE c_id = ?");
    $stmt->bind_param("i", $c_id);
    if ($stmt->execute()) {
        return true; // Success
    } else {
        return false; // Error
    }
}

// Function to retrieve all courses
function getCourses()
{
    global $conn;

    $result = $conn->query("SELECT * FROM course");
    if ($result === false) {
        return false; // Error in query execution
    }
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
    return $courses;
}

function getCoursesDisplay()
{
    global $conn;

    $result = $conn->query("SELECT c_id, c_code, c_name FROM course WHERE published = 1");
    if ($result === false) {
        return false; // Error in query execution
    }
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
    return $courses;
}

function getCoursesCo(string $user)
{
    global $conn;

    $result = $conn->query("SELECT * FROM course WHERE c_coordinator = " . $user);
    if ($result === false) {
        return false; // Error in query execution
    }
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
    return $courses;
}

function getCourse($c_id)
{
    global $conn;

    $result = $conn->query("SELECT * FROM course WHERE c_id=$c_id");
    if ($result === false) {
        return false; // Error in query execution
    }
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    if (sizeof($courses) > 0)
        return $courses[0];
}

function getCoursesIdle()
{
    global $conn;

    $result = $conn->query("SELECT c_id, c_code, c_name FROM course WHERE c_coordinator = null");
    if ($result === false) {
        return false; // Error in query execution
    }
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
    return $courses;
}


function publishCourse(int $c_id)
{
    global $conn;

    $sql = "UPDATE course SET published = !published WHERE c_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $c_id);

    $result = array();
    // Execute the update query
    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "published succesfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    // Close the statement
    $stmt->close();
    return $result;
}

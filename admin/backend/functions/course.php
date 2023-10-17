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
function editCourse($c_id, $c_coordinator, $description, $file, $file_name, $duration, $intake_date, $course_fee, $poster_description)
{
    global $conn;

    $targetFile = $file_name;
        // Check if a file was uploaded
        if (!empty($file['name'])) {
            $targetDirectory = "/images/course-posters/";
            $targetFile = $targetDirectory . basename($file["name"]);
    
            // Check if the file is an image
            $allowedExtensions = ["jpg", "jpeg", "png"];
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
            if (!in_array($imageFileType, $allowedExtensions)) {
                $result = array('error' => "Only JPG, JPEG, and PNG files are allowed.");
                return $result;
            }
    
            // Move the uploaded file to the target directory
            if (move_uploaded_file($file["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
                // File uploaded successfully
            } else {
                $result = array('error' => "Error uploading the image.");
                return $result;
            }
        }
        else if ($file['name']) {
        if (isset($file_path)) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $file_name)) {
                if (!unlink($_SERVER['DOCUMENT_ROOT'] . $file_name)) {
                    $result = array('error' => "Error uploading the image. Couldn't delete old one" . $_SERVER['DOCUMENT_ROOT'] . $file_name);
                    return $result;
                }
            }
        }

        $targetDirectory = "/images/course-posters/";
        $targetFile = $targetDirectory . basename($file["name"]);

        // Check if the file is an image
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $result = array('error' => "Only JPG, JPEG, and PNG files are allowed." . $file['name']);
            return $result;
        } else {
            if (move_uploaded_file($file["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
            } else {
                $result = array('error' => "Error uploading the image.");
                return $result;
            }
        }
    }
    $stmt = $conn->prepare("UPDATE course SET c_coordinator = ?, 
    `description` = ?,
    Poster_img = ?,
    `duration(months)` = ?,
    new_intake_date = ?,
    total_fee = ?,
    display_description = ?
    WHERE c_id = ?");

    $stmt->bind_param("sssisisi",  $c_coordinator, $description, $targetFile, 
    $duration, $intake_date, $course_fee, $poster_description, $c_id);

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

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

function getUpcomingEvents()
{
    global $conn;

    $sql = "SELECT * FROM upcoming_event";
    $res = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    return $result;
}

function getUpcomingEventById(int $eventId)
{
    global $conn;

    $sql = "SELECT * FROM  upcoming_event WHERE e_id= $eventId";
    $res = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $result = $row;
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    return $result;
}


function getUpcomingEventsDisplay()
{
    global $conn;

    // Validate and format the date to prevent SQL injection
    $formattedToday = date("Y:m:d");

    $sql = "SELECT * FROM upcoming_event WHERE published = 1 AND ? >= display_from AND ? <= display_to";

    // Use prepared statements to safely bind the parameters
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $formattedToday, $formattedToday);

    $result = array();

    if (mysqli_stmt_execute($stmt)) {
        $res = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}

function addUpcomingEvents($e_name, $e_date, $e_time, $e_venue, $file, $display_from, $display_to, $added_by, $published)
{
    global $conn;
    $result = array();

    // Check if a file was uploaded
    if (!empty($file['name'])) {
        $targetDirectory = "/images/upcoming-event-posters/";
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
    } else {
        $result = array('error' => "Select an image.");
        return $result;
    }

    // Prepare and execute the SQL query to insert data into the 'upcoming_event' table
    $sql = "INSERT INTO upcoming_event 
            (e_name, e_date, e_time, e_venue, e_img, display_from, display_to, added_by, published)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssii", $e_name, $e_date, $e_time, $e_venue, $targetFile, $display_from, $display_to, $added_by, $published);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Upcoming Event Added Successfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}


function editUpcomingEvents($e_name, $e_date, $e_time, $e_venue, $file, $file_path, $display_from, $display_to, $added_by, $e_id)
{
    global $conn;
    $result = array();
    $targetFile = $file_path;

    if ($file['name']) {
        if (isset($file_path)) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $file_path)) {
                if (!unlink($_SERVER['DOCUMENT_ROOT'] . $file_path)) {
                    $result = array('error' => "Error uploading the image. Couldn't delete old one" . $_SERVER['DOCUMENT_ROOT'] . $file_path);
                    return $result;
                }
            }
        }

        $targetDirectory = "/images/upcoming-event-posters/";
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

    // Prepare and execute the SQL query to insert data into the 'upcoming_event' table
    $sql = "UPDATE upcoming_event 
            SET e_name = ?, 
                e_date = ?, 
                e_time = ?, 
                e_venue = ?, 
                e_img = ?, 
                display_from = ?, 
                display_to = ?, 
                added_by = ? 
            WHERE e_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssii", $e_name, $e_date, $e_time, $e_venue, $targetFile, $display_from, $display_to, $added_by, $e_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Upcoming Event Updated");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

function deleteUpcomingEvent(int $eventId)
{
    global $conn;

    $sql = "SELECT * FROM  upcoming_event WHERE e_id= $eventId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $event_img = $_SERVER['DOCUMENT_ROOT'] . $row['e_img'];
    if (file_exists($event_img)) {
        if (!unlink($event_img)) {
            echo "Failed to delete the image.";
        }
    } else {
        echo "Image file does not exist.";
    }


    $sql = "DELETE FROM upcoming_event WHERE e_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $eventId);

    $result = 0;

    if (mysqli_stmt_execute($stmt)) {
        $result = true;
    } else {
        $result =  array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

function publishUpcomingEvent(int $event_id)
{
    global $conn;

    $sql = "UPDATE upcoming_event SET published = !published WHERE e_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $event_id);

    $result = array();
    // Execute the update query
    if (mysqli_stmt_execute($stmt)) {
        $result = array('success' => "published succesfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    // Close the statement
    $stmt->close();
    return $result;
}

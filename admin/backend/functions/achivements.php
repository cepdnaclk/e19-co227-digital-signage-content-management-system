<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

function getAchivements()
{
    global $conn;

    $sql = "SELECT * FROM achievement";
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

function getAchivementById(int $a_id)
{
    global $conn;

    $sql = "SELECT * FROM achievement WHERE a_id= $a_id";
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


function getAchivementDisplay()
{
    global $conn;

    $sql = "SELECT * FROM achievement WHERE published = 1";

    // Use prepared statements to safely bind the parameters
    $stmt = mysqli_prepare($conn, $sql);

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

function addAchivement($a_name, $a_desc, $a_date, $file, $added_by, $published)
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
    $sql = "INSERT INTO achievement
            (a_name, a_desc, a_date, a_img, added_by, published)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssii", $a_name, $a_desc, $a_date, $targetFile, $added_by, $published);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Achivement Added Successfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}


function editAchivement($a_name, $a_desc, $a_date, $file, $file_path, $added_by, $a_id)
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
    $sql = "UPDATE achievement
            SET a_name = ?, 
                a_desc = ?, 
                a_date = ?, 
                a_img = ?, 
                added_by = ?
            WHERE a_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssii", $a_name, $a_desc, $a_date, $targetFile, $added_by, $a_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Upcoming Event Updated");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

function deleteAchivement(int $a_id)
{
    global $conn;

    $sql = "SELECT * FROM achievement WHERE a_id= $a_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $event_img = $_SERVER['DOCUMENT_ROOT'] . $row['a_img'];
    if (file_exists($event_img)) {
        if (!unlink($event_img)) {
            echo "Failed to delete the image.";
        }
    } else {
        echo "Image file does not exist.";
    }


    $sql = "DELETE FROM achievement WHERE a_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $a_id);

    $result = 0;

    if (mysqli_stmt_execute($stmt)) {
        $result = true;
    } else {
        $result =  array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

function publishAchivement(int $a_id)
{
    global $conn;

    $sql = "UPDATE achievement SET published = !published WHERE a_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $a_id);

    $result = array();
    // Execute the update query
    if (mysqli_stmt_execute($stmt)) {
        $publishedState = getPublishedState($a_id);

        if ($publishedState) {
            $result = array('message' => 'Achievement has been published successfully.');
        } else {
            $result = array('message' => 'Achievement has been unpublished successfully.');
        }
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    // Close the statement
    $stmt->close();
    return $result;
}

function getPublishedState(int $a_id)
{
    global $conn;

    // Query the current state of the 'published' column for the given achievement
    $sql = "SELECT published FROM achievement WHERE a_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $a_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $published);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Close the statement
    $stmt->close();

    return (bool)$published; // Convert the result to a boolean (true if published, false if not)
}

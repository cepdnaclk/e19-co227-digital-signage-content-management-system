<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

function getMaps()
{
    global $conn;

    $sql = "SELECT * FROM map";
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

function getMapById(int $m_id)
{
    global $conn;

    $sql = "SELECT * FROM map WHERE m_id= $m_id";
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



function addMap($m_name, $m_file, $m_desc, $added_by)
{
    global $conn;
    $result = array();

    // Check if a file was uploaded
    if (!empty($m_file['name'])) {
        $targetDirectory = "/images/maps/";
        $targetFile = $targetDirectory . basename($m_file["name"]);

        // Check if the file is an image
        $allowedExtensions = ["mp4"];
        $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (!in_array($videoFileType, $allowedExtensions)) {
            $result = array('error' => "Only mp4 files are allowed.");
            return $result;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($m_file["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
            // File uploaded successfully
        } else {
            $result = array('error' => "Error uploading the video.");
            return $result;
        }
    } else {
        $result = array('error' => "Select a video.");
        return $result;
    }

    // Prepare and execute the SQL query to insert data into the 'upcoming_event' table
    $sql = "INSERT INTO map
            (m_name, m_file, m_desc, added_by)
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssi", $m_name, $targetFile, $m_desc, $added_by);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Map Added Successfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}


function editMap($m_id, $m_name,$m_desc, $m_file,$m_file_path,$added_by )
{
    global $conn;
    $result = array();
    $targetFile = $m_file_path;

    if ($m_file['name']) {
        if (isset($m_file_path)) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $m_file_path)) {
                if (!unlink($_SERVER['DOCUMENT_ROOT'] . $m_file_path)) {
                    $result = array('error' => "Error uploading the video. Couldn't delete old one" . $_SERVER['DOCUMENT_ROOT'] . $m_file_path);
                    return $result;
                }
            }
        }

        $targetDirectory = "/images/maps/";
        $targetFile = $targetDirectory . basename($m_file["name"]);

        // Check if the file is an image
        $Filetype = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($Filetype != "mp4") {
            $result = array('error' => "Only mp4 files are allowed." . $m_file['name']);
            return $result;
        } else {
            if (move_uploaded_file($m_file["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $targetFile)) {
            } else {
                $result = array('error' => "Error uploading the video.");
                return $result;
            }
        }
    }

    // Prepare and execute the SQL query to insert data into the 'upcoming_event' table
    $sql = "UPDATE map
            SET m_name = ?, 
                m_desc = ?,
                m_file = ?, 
                added_by = ?
            WHERE m_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssii", $m_name, $m_desc, $targetFile, $added_by, $m_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Map Updated");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

function deleteMap(int $m_id)
{
    global $conn;

    $sql = "SELECT * FROM map WHERE m_id= $m_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $m_file = $_SERVER['DOCUMENT_ROOT'] . $row['m_file'];
    if (file_exists($m_file)) {
        if (!unlink($m_file)) {
            echo "Failed to delete the video.";
        }
    } else {
        echo "Video file does not exist.";
    }


    $sql = "DELETE FROM map WHERE m_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $m_id);

    $result = 0;

    if (mysqli_stmt_execute($stmt)) {
        $result = true;
    } else {
        $result =  array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}




<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";


function getFacilities()
{
    global $conn;

    $sql = "SELECT * FROM facility";
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


function deleteFacility($f_id)
{
    global $conn;
    $sql = "DELETE FROM facility WHERE f_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $f_id);

    $result = 0;

    if (mysqli_stmt_execute($stmt)) {
        $result = true;
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

function addFacility($f_name, $total_seats, $price, $floor, $in_charge)
{
    global $conn;
    $sql = "INSERT INTO facility
    (f_name, total_seats, price, floor, in_charge)
    VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "siiss", $f_name, $total_seats, $price, $floor, $in_charge);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Lab Added Successfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

function getFacilityById(int $f_id)
{
    global $conn;

    $sql = "SELECT * FROM facility WHERE f_id= $f_id";
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

function editFacility($f_name, $total_seats, $price, $floor, $in_charge, $f_id)
{
    global $conn;
    $sql = "UPDATE facility
            SET f_name = ?, 
                total_seats = ?,
                price = ?, 
                floor = ?,
                in_charge = ?
            WHERE f_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "siissi", $f_name, $total_seats, $price, $floor, $in_charge, $f_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Lab Info Updated Successfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

function addBooking($f_id, $b_date, $b_timeslot, $b_seats,$b_for,$b_contact, $b_by){
    global $conn;
    if(!is_numeric($f_id) || !is_numeric($b_seats) || !is_numeric($b_by) ){
        return false;
    }
    else{
    $result = array();

    $sql = "INSERT INTO booking (f_id, b_date, b_timeslot, b_seats, b_for, b_contact, b_by) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ississi", $f_id, $b_date, $b_timeslot, $b_seats,$b_for,$b_contact, $b_by);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Booking Added Successfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);

    return $result;
}
}



function displayall(int $f_id)
{
    global $conn;

    $sql = "SELECT * FROM booking WHERE f_id= ? ORDER BY b_date ASC, b_timeslot ASC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $f_id);
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

function getBookingById(int $b_id) {
    global $conn;

    $sql = 'SELECT * FROM booking WHERE b_id = ?';
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return array('error' => mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'i', $b_id);

    
    mysqli_stmt_execute($stmt);

    
    $res = mysqli_stmt_get_result($stmt);

    $result = array();

    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $result = $row;
        } else {
            $result = array('error' => 'No booking found with the given ID');
        }
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}


function editBooking($b_id, $b_date, $b_timeslot, $b_seats,$b_for,$b_contact, $b_by){
    global $conn;
    if(!is_numeric($b_seats) || !is_numeric($b_by) ){
        return false;
    }
    else{
    $result = array();


    $sql = "UPDATE booking SET b_date= ?, b_timeslot = ?, b_seats = ?, b_for = ? ,b_contact = ?, b_by = ? WHERE b_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssissii", $b_date, $b_timeslot, $b_seats,$b_for,$b_contact, $b_by,$b_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Booking Updated Successfully");
    } else {
        $result = array('error' => mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);

    return $result;
}
}
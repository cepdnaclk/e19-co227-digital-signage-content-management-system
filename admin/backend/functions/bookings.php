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
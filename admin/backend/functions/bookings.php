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
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

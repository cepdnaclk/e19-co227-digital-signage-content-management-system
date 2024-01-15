<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

function getMessages()
{
    global $conn;

    $query = "SELECT * FROM `contactsupport` where checked is null";
    $result = mysqli_query($conn, $query);

    $array = array();

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
        }
    } else {
        $array = array('error' => mysqli_error($conn));
    }

    return $array;
}

function checkMessage($id)
{
    global $conn;
    $result = array();

    $sql = "UPDATE contactsupport
            SET checked = true
            WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $result = array('message' => "Message Checked");
    } else {
        $result = array('error' => mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);

    return $result;
}

?>
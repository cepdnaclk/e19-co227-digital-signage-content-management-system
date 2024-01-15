<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";
// Include the session details logger
include $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/log.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    hasClearence(1, function () {
        global $clearenceStatus;

        if (isset($_GET['delete'])) {
            $user = getUser($_GET['delete']);
            if ($user == false) {
                header('Location: /pages/users/');
                exit();
            }
            if ($clearenceStatus[$user['clearense']] < $clearenceStatus[$_SESSION['clearense']]) {
                if (deleteUser($_GET['delete'])) {
                    logUserActivity("Deleted user with id: {$_GET['delete']}");
                    header('Location: /pages/users/?success=succesfully deleted the user');
                } else {
                    header('Location: /pages/users/?error=Unable to delete the user');
                }
            }
        }
    });
}

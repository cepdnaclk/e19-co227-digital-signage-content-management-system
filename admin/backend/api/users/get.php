<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/users.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['delete'])) {
        $user = getUser($_GET['delete']);
        if ($user == false) {
            header('Location: /pages/users.php');
            exit();
        }
        if ($clearenceStatus[$user['clearense']] < $clearenceStatus[$_SESSION['clearense']]) {
            if (deleteUser($_GET['delete'])) {
                header('Location: /pages/users.php?success=1');
            } else {
                header('Location: /pages/users.php?error=1');
            }
        }
    }
}

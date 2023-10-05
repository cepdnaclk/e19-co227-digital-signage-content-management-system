<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (
        isset($_POST["coordinator_name"]) &&
        isset($_POST["description"]) &&
        isset($_POST["display_option"]) &&
        isset($_POST["c_id"])
    ) {
        // Get form data
        $c_id = $_POST["c_id"];
        $coordinator_name = $_POST["coordinator_name"];
        $description = $_POST["description"];
        $display_option = $_POST["display_option"];


        header("Location: success_page.php");
        exit();
    } else {
        echo "'coordinator_name', 'description', 'display_option', and 'c_id' are required fields";
    }
}

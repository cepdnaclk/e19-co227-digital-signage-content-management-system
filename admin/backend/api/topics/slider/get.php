<?
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

// Function to fetch images from directory
function getImages($directory) {
    $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    return $images;
}
?>
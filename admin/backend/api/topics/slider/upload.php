<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Retrieve topic information from POST data
    $topic_id = $_POST['topic_id'];
    $board_name = $_POST['board_name'];
    $topic_type = $_POST['topic_type'];
    $topic_title = $_POST['topic_title'];

    // Check if the upload directory exists, if not, create it
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/images/$board_name/$topic_title/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Loop through uploaded files
    $upload_files = $_FILES['files'];
    $num_files = count($upload_files['name']);

    // Maximum allowed images
    $max_images = 10;

    // Counter for uploaded images
    $uploaded_images = 0;

    // Process each file
    for ($i = 0; $i < $num_files; $i++) {
        $filename = $upload_files['name'][$i];
        $file_tmp = $upload_files['tmp_name'][$i];
        $file_type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Generate unique filename to prevent overwriting
        $unique_filename = uniqid('img_') . ".$file_type";

        // Check if the file is an image
        if (getimagesize($file_tmp)) {
            // Check if maximum number of images exceeded
            if ($uploaded_images < $max_images) {
                // Move uploaded file to destination directory
                $destination = $upload_dir . $unique_filename;
                move_uploaded_file($file_tmp, $destination);
                $uploaded_images++;
            } else {
                echo "Maximum number of images exceeded!";
                break;
            }
        } else {
            echo "$filename is not a valid image file!";
        }
    }

    // Output success message
    echo "Successfully uploaded $uploaded_images images.";
} else {
    echo "Invalid request method.";
}
?>

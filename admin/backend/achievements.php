<?php
include_once "../config.php";

// Function to add a new achievement
function addAchievement($achievementName, $imagePath, $displayFrom, $displayTo, $addedBy)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO achievement (a_name, a_img, display_from, display_to, added_by) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $achievementName, $imagePath, $displayFrom, $displayTo, $addedBy);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to retrieve all achievements
// function getAllAchievements()
// {
//     global $conn;
//     $achievements = array();

//     $stmt = $conn->prepare("SELECT a_id, a_name, a_img, display_from, display_to FROM achievement");
//     $stmt->execute();
//     $stmt->bind_result($achievementId, $achievementName, $imagePath, $displayFrom, $displayTo);

//     while ($stmt->fetch()) {
//         $achievements[] = array(
//             'id' => $achievementId,
//             'name' => $achievementName,
//             'image' => $imagePath,
//             'display_from' => $displayFrom,
//             'display_to' => $displayTo
//         );
//     }

//     return $achievements;
// }

// Handle adding a new achievement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addAchievement"])) {
    $achievementName = $_POST["achievementName"];
    $imagePath = $_POST["imagePath"]; // You should handle image uploads securely
    $displayFrom = $_POST["displayFrom"];
    $displayTo = $_POST["displayTo"];
    $addedBy = $_POST["addedBy"];

    if (addAchievement($achievementName, $imagePath, $displayFrom, $displayTo, $addedBy)) {
        header("Location: achievements.php?success=1");
    } else {
        header("Location: achievements.php?error=1");
    }
}
?>

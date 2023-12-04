<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/previousevents.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/upcomingevents.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/achivements.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/maps.php";

function getTimes()
{
    global $conn;

    $dashboardData = array();

    $result = $conn->query("SELECT * FROM `dashboard`");

    while ($row = $result->fetch_assoc()) {
        $dashboardData[$row['feature']] = $row;
    }

    return $dashboardData;
}

// Function to update the "Total Time" field in the database
function updateTotalTime($feature, $totalTime, $slideTime)
{
    global $conn;
    $result = array();

    $totalTime = (int) $totalTime;

    // Check if $slideTime is null, and set the appropriate placeholder
    if ($slideTime === null) {
        $sql = "UPDATE `dashboard` SET `time` = ?, `time_slide` = NULL WHERE `feature` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $totalTime, $feature);
    } else {
        $slideTime = (int) $slideTime;
        $sql = "UPDATE `dashboard` SET `time` = ?, `time_slide` = ? WHERE `feature` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $totalTime, $slideTime, $feature);
    }

    if ($stmt->execute()) {
        $result = array('message' => "Data updated Successfully");
    } else {
        $result = array('error' => $stmt->error);
    }

    $stmt->close();

    return $result;
}


function getDashboardData()
{
    $upcomingRows = sizeof(getUpcomingEvents());
    $previousRows = sizeof(getPreviousEvents());
    $achivementRows = sizeof(getAchivements());
    $courseRows = sizeof(getCourses());
    $mapsRows = sizeof(getMaps());

    $upcomingPRows = sizeof(getUpcomingEventsDisplay());
    $previousPRows = sizeof(getPreviousEventsDisplay());
    $achivementPRows = sizeof(getAchivementDisplay());
    $coursePRows = sizeof(getCoursesDisplay());
    $mapsPRows = sizeof(getMaps());

    $result = getTimes();
    $totalPages = 1 + $upcomingRows + $previousRows + $achivementRows + $courseRows + $mapsRows;
    $totalPagesP = 1 + $upcomingPRows + $previousPRows + $achivementPRows + $coursePRows + $mapsPRows;
    $totalTime = 0;
    $pages = array(
        'Lab Slots' => 1,
        'Course Offerings' => $courseRows,
        'Upcoming Events' => $upcomingRows,
        'Previous Events' => $previousRows,
        'Achievements' => $achivementRows,
        'Maps' => $mapsRows,
    );

    $pagesP = array(
        'Lab Slots' => 1,
        'Course Offerings' => $coursePRows,
        'Upcoming Events' => $upcomingPRows,
        'Previous Events' => $previousPRows,
        'Achievements' => $achivementPRows,
        'Maps' => $mapsPRows,
    );

    foreach ($result as $key => $time) {
        if ($time['feature'] == 'Lab Slots') {
            $totalTime += (4 * $time['time']);
        } else {
            $totalTime += $time['time'];
        }
    }

    $data = array(
        'total' => array(
            'time' => $totalTime,
            'pages' => $totalPages,
            'pagesP' => $totalPagesP
        )
    );

    foreach ($result as $key => $feature) {
        $data['features'][$feature['feature']] = array(
            'time' => $feature['time'],
            'time_slide' => $feature['time_slide'],
            'pages' => $pages[$feature['feature']],
            'pagesP' => $pagesP[$feature['feature']]
        );
    }

    return $data;
}

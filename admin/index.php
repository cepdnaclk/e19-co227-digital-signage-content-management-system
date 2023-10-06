<?php
include_once("./config.php");
include_once(APP_ROOT . "/includes/header.php");

// Function to fetch data from the database
function fetchDashboardData($conn) {
    $dashboardData = array();

    $result = $conn->query("SELECT * FROM `dashboard`");
    if ($result === false) {
        return $dashboardData;
    }

    while ($row = $result->fetch_assoc()) {
        $dashboardData[$row['feature']] = $row;
    }

    return $dashboardData;
}

// Function to update the "Total Time" field in the database
function updateTotalTime($conn, $feature, $totalTime) {
    $totalTime = (int)$totalTime; // Convert to integer for security

    $sql = "UPDATE `dashboard` SET `total_time` = ? WHERE `feature` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $totalTime, $feature);
    $stmt->execute();
}

$dashboardData = fetchDashboardData($conn);

// Calculate the total values
$totalPages = 0;
$totalPublished = 0;
$totalTime = 0;

foreach ($dashboardData as $feature => $data) {
    // Skip the "total" feature
    if ($feature === 'total') {
        continue;
    }

    // Calculate Allocated Time Per Page
    if ($data['published_pages'] > 0) {
        $allocatedTimePerPage = number_format($data['total_time'] / $data['published_pages'], 2) . 's';
    } else {
        $allocatedTimePerPage = 'N/A';
    }

    // Update the total values
    $totalPages += $data['total_pages'];
    $totalPublished += $data['published_pages'];
    $totalTime += $data['total_time'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Admin Panel</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(0);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Summary Widget -->
                <div class="widget elegant-widget" id="overview-widget">
                    <h2 class="widget-title">Overview</h2>
                    <p class="widget-info" id="total-pages">Total Pages: <?php echo $totalPages; ?></p>
                    <p class="widget-info" id="total-published-pages">Total Published Pages: <?php echo $totalPublished; ?></p>
                    <p class="widget-info" id="total-time-for-cycle">Total Time for One Cycle: <?php echo $totalTime; ?>s</p>
                    <div class="widget-buttons">
                        <button class="preview-button">Preview</button>
                        &emsp;
                        <button class="manage-button">Manage</button>
                    </div>
                </div>

                <!-- Widgets -->
                <div class="dashboard-widgets">
                    <?php
                    foreach ($dashboardData as $feature => $data) {
                        // Skip the "total" feature
                        if ($feature === 'total') {
                            continue;
                        }

                        // Calculate Allocated Time Per Page
                        if ($data['published_pages'] > 0) {
                            $allocatedTimePerPage = number_format($data['total_time'] / $data['published_pages'], 2) . 's';
                        } else {
                            $allocatedTimePerPage = 'N/A';
                        }
                    ?>
                        <div class="widget">
                            <h2 class="widget-title"><?php echo $feature; ?></h2>
                            <p class="widget-info">Total Pages: <?php echo $data['total_pages']; ?></p>
                            <p class="widget-info">Published: <?php echo $data['published_pages']; ?></p>
                            <form method="POST">
                                <input type="hidden" name="feature" value="<?php echo $feature; ?>">
                                <p class="widget-info">
                                    Allocated Time:
                                    <input type="number" name="total_time" value="<?php echo $data['total_time']; ?>" class="allocated-time-input">
                                    <span class="time-unit">s</span>
                                </p>
                                <p class="widget-info">Allocated Time Per Page: <?php echo $allocatedTimePerPage; ?></p>
                                <div class="widget-buttons">
                                    <button class="preview-button">Preview</button>
                                    <button class="manage-button">Manage</button>
                                    <button type="submit" class="update-button">Update</button>
                                </div>
                            </form>
                        </div>
                    <?php
                    }
                    ?>
                       </div>
                    </div>
                            <div class="contact-support">
                            <?php
        // Query to fetch data from the supports table
        $query = "SELECT * FROM `contactsupport`";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            echo "<h2><i><center>Complaints and Messages From Other CMS Handlers<center></i></h2>
                    <center><table border='1'>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>";

            // Loop through the rows of data
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "</tr>";
            }

            echo "</center></table>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
                            ?>
                            </div>  
             
    </div>
    <script src="./js/dashboard.js"></script>

</body>

</html>

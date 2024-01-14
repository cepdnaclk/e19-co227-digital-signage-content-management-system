<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/dashboard.php";

$data = getDashboardData();
if (isset($data['error']))
    if (!isset($_GET['error']))
        header("Location: ?error={$data['error']}");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/dashboard.css">
    <title>Admin Panel</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(0, 0);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>

            <!-- Dashboard Content -->
            <?php
            if ($clearenceStatus[$_SESSION['clearense']] > 0) {
                ?>
                <div class="dashboard-content">
                    <img src="/images/PublicDisplayBackground.svg" alt="" class="bg">
                    <!-- Summary Widget -->
                    <div class="elegant-widget" id="overview-widget">
                        <h2 class="widget-title">Welcome
                            <?= $_SESSION['user_name'] ?>
                            <span>
                                <?= $_SESSION['clearense'] ?>
                            </span>
                        </h2>
                    </div>

                    <!-- Widgets -->
                    <div class="elegant-widget">
                        <h2>
                            Overview
                            <div class="widget-buttons">
                                <a href="/pages/preview"><button class="preview-button">Public View &nbsp; >> </button></a>
                            </div>
                        </h2>
                        <div class="row">
                            <p class="widget-info" id="total-pages"><span>
                                    <i class="fa-regular fa-note-sticky"></i>
                                    <?= $data['total']['pages'] ?>
                                </span> Total Pages </p>
                            <p class="widget-info" id="total-published-pages">
                                <span>
                                    <i class="fa-regular fa-note-sticky"></i>
                                    <?= $data['total']['pagesP'] ?>
                                </span>
                                Total Published Pages
                            </p>
                            <p class="widget-info" id="total-time-for-cycle">
                                <span>
                                    <i class="fa-regular fa-clock"></i>
                                    <?= $data['total']['time'] ?>s
                                </span>
                                Total Time per Cycle
                            </p>
                        </div>
                    </div>
                    <div class="dashboard-widgets">
                        <?php
                        foreach ($data['features'] as $key => $feature) {
                            ?>
                            <div class="widget">
                                <h2 class="widget-title">
                                    <?= $key ?>
                                </h2>
                                <p class="widget-info">Total Pages:
                                    <?= $feature['pages'] ?>
                                </p>
                                <?php if ($key != 'Lab Slots') { ?>
                                    <p class="widget-info">Published:
                                        <?= $feature['pagesP'] ?>
                                    </p>
                                <?php } ?>
                                <form method="POST" action="/backend/api/dashboard/update.php">
                                    <input type="hidden" name="feature" value="<?php echo $key; ?>">
                                    <p class="widget-info">
                                        Allocated Time per Cycle:
                                        <input type="number" name="time" value="<?= $feature['time'] ?>"
                                            class="allocated-time-input">
                                        <span class="time-unit">s</span>
                                    </p>
                                    <?php if ($key != 'Lab Slots') { ?>
                                        <p class="widget-info">
                                            Allocated Time Per Page:
                                            <input type="number" name="time_slide" min="1" value="<?= $feature['time_slide'] ?>"
                                                class="allocated-time-input">
                                            <span class="time-unit">s</span>
                                        </p>
                                    <?php } ?>
                                    <div class="widget-buttons">
                                        <!-- <button class="manage-button">Manage</button> -->
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
                        echo '<script>';
                        echo 'function reorderRow(element) {';
                        echo '  $(element).appendTo(".custom-large-card");';
                        echo '}';
                        echo '</script>';
                        echo '<div class="custom-large-card">';
                        echo "<h2><i>Complaints and Messages From Other CMS Handlers</i></h2>";

                        // Loop through the rows of data
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="custom-card">';
                            echo '<div class="name-email">';
                            echo '<h3>' . $row['name'] . '</h3>';
                            echo '<h5>' . $row['email'] . '</h5>';
                            echo '</div>';
                            echo '<p>' . $row['message'] . '</p>';
                            echo '<div class="checkbox">';
                            echo '<label for="checked_' . $row['id'] . '">Checked</label>';

                            // Set the initial state of the checkbox based on the 'checked' field value
                            $isChecked = $row['checked'] == 1 ? 'checked' : '';

                            echo '<input type="checkbox" id="checked_' . $row['id'] . '" name="checked" ' . $isChecked . '>';
                            echo '</div>';

                            echo '</div>';
                        }

                        echo '</div>'; // Close the large card
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="course">
                    <img src="/images/PublicDisplayBackground.svg" alt="">
                    <div class="container">
                        <h1>Welcome
                            <?= $_SESSION['user_name'] ?>
                        </h1>
                        <p>Manage Your Courses and labslots</p>
                        <a href="/pages/course/"> My Courses >></a>
                        <br />
                        <a href="/pages/preview"> Prview Public Display >></a>
                    </div>
                </div>

            <?php } ?>
            <div class="dashboard-widget" id="log-history-widget">
                <div>
                    <h2 class="widget-title">&nbsp;Recent User Log History</h2>
                    <br>
                    <a href="/logs/user_activity.log">&emsp;View Full Log History &#128462;</a>
                </div>
                <br>
                <div class="log-history-content" id="log-content">
                    <?php
                    // Function to read last 15 lines from the log file
                    function readLastLines($file, $lines)
                    {
                        $content = file($file);
                        $start = max(0, count($content) - $lines);
                        $output = array_slice($content, $start);
                        $reversedOutput = array_reverse($output);
                        return implode("<br>", $reversedOutput);
                    }

                    $logFile = $_SERVER['DOCUMENT_ROOT'] . "\logs\user_activity.log";
                    $logEntries = readLastLines($logFile, 15);

                    echo "<p>{$logEntries}</p>";
                    ?>
                </div>
            </div>

        </div>
        <script src="./js/dashboard.js"></script>

</body>

</html>
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
            sidebar(0,0);
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
                    <p class="widget-info" id="total-pages">Total Pages:
                        <?= $data['total']['pages'] ?>
                    </p>
                    <p class="widget-info" id="total-published-pages">Total Published Pages:
                        <?= $data['total']['pagesP'] ?>
                    </p>
                    <p class="widget-info" id="total-time-for-cycle">Total Time for One Cycle:
                        <?= $data['total']['time'] ?>s
                    </p>
                    <div class="widget-buttons">
                        <a href="/pages/preview"><button class="preview-button">Preview</button></a>
                        &emsp;
                        <button class="manage-button">Manage</button>
                    </div>
                </div>

                <!-- Widgets -->
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
                                    <input type="number" name="time" value="<?= $feature['time'] ?>" class="allocated-time-input">
                                    <span class="time-unit">s</span>
                                </p>
                                <?php if ($key != 'Lab Slots') { ?>
                                    <p class="widget-info">
                                        Allocated Time Per Page:
                                        <input type="number" name="time_slide" min="1" value="<?= $feature['time_slide'] ?>" class="allocated-time-input">
                                        <span class="time-unit">s</span>
                                    </p>
                                <?php } ?>
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
                        echo '<label for="checked">Checked</label>';
                        echo '<input type="checkbox" id="checked" name="checked">';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>'; // Close the large card
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
            </div>

        </div>
        <script src="./js/dashboard.js"></script>

</body>

</html>
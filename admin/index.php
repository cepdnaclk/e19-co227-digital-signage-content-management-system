<?php include_once("./config.php") ?>
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
            <div class="widget elegant-widget">
                <h2 class="widget-title">Overview</h2>
                <p class="widget-info">Total Pages: 53</p>
                <p class="widget-info">Total Published Pages: 21</p>
                <p class="widget-info">Total Time for One Cycle: 4.30 min</p>
                <div class="widget-buttons">
                    <button class="preview-button">Preview</button>
                    &emsp;
                    <button class="manage-button">Manage</button>
                </div>
            </div>

                <!-- Widgets -->
                <div class="dashboard-widgets">
                    <?php
                    // ToDO: from the backend => Include necessary logic to fetch data from the database
                    // Replace the placeholders with actual data
                    $widgets = [
                        [
                            'title' => 'Lab Slots',
                            'total_pages' => 5,
                            'published' => 1,
                            'allocated_total_time' => '30s',
                            'allocated_time_per_page' => '30s',
                        ],
                        [
                            'title' => 'Course Offerings',
                            'total_pages' => 5,
                            'published' => 1,
                            'allocated_total_time' => '30s',
                            'allocated_time_per_page' => '30s',
                        ],
                        [
                            'title' => 'Upcoming Events',
                            'total_pages' => 5,
                            'published' => 1,
                            'allocated_total_time' => '30s',
                            'allocated_time_per_page' => '30s',
                        ],
                        [
                            'title' => 'Previous Events',
                            'total_pages' => 5,
                            'published' => 1,
                            'allocated_total_time' => '30s',
                            'allocated_time_per_page' => '30s',
                        ],
                        [
                            'title' => 'Achievements',
                            'total_pages' => 5,
                            'published' => 1,
                            'allocated_total_time' => '30s',
                            'allocated_time_per_page' => '30s',
                        ],
                    ];
                    

                    foreach ($widgets as $widget) {
                    ?>
                        <div class="widget">
                            <h2 class="widget-title"><?php echo $widget['title']; ?></h2>
                            <p class="widget-info">Total Pages: <?php echo $widget['total_pages']; ?></p>
                            <p class="widget-info">Published: <?php echo $widget['published']; ?></p>
                            <p class="widget-info">Allocated Total Time: <?php echo $widget['allocated_total_time']; ?></p>
                            <p class="widget-info">Allocated Time Per Page: <?php echo $widget['allocated_time_per_page']; ?></p>
                            <div class="widget-buttons">
                                <button class="preview-button">Preview</button>
                                <button class="manage-button">Manage</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

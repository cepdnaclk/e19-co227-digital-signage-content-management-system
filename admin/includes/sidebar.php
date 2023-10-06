<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/sidebar.css">
</head>

<body>
    <?php function sidebar(int $index)
    {
    ?>
        <div class="side">
            <div class="logo">
                <img src="/images/ITCenterLogo.svg" alt="IT Center Logo" />
                <span>Information Technology Center CMS</span>
            </div>
            <div class="links">
                <a href="/" class="link <?php echo $index == 0 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/darhboard_alt.svg" alt="">
                        <p>Dashboard</p>
                    </div>
                </a>
                <a href="/pages/course.php" class="link <?php echo $index == 1 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/Mortarboard.svg" alt="">
                        <p>Courses</p>
                    </div>
                </a>
                <a href="/pages/users.php" class="link <?php echo $index == 2 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/User_alt.svg" alt="">
                        <p>Users</p>
                    </div>
                </a>
                <div>
                    <a href="/pages/eventsandachivements.php" class="link <?php echo $index == 3 ? 'active' : '' ?>">
                        <div class="link-main">
                            <img src="/images/Star.svg" alt="">
                            <p>Events & Achievements</p>
                        </div>
                    </a>
                    <ul>
                        <li><a href="/pages/upcoming/" class="link <?php echo $index == 3 ? 'active' : '' ?>">Upcoming Events</a></li>
                        <li><a href="/pages/previousevents.php" class="link <?php echo $index == 3 ? 'active' : '' ?>">Previous Events</a></li>
                        <li><a href="/pages/achievements.php" class="link <?php echo $index == 3 ? 'active' : '' ?>">Achievements</a></li>
                    </ul>
                </div>
                <a href="/pages/labslots.php" class="link <?php echo $index == 4 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/calendar.svg" alt="">
                        <p>Lab Allocations</p>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
</body>

</html>
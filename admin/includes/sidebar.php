<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/sidebar.css">
</head>

<body>
    <?php function sidebar(int $index)
    {
    ?>
        <div class="side">
            <div class="logo">
                <img src="../images/ITCenterLogo.svg" alt="IT Center Logo" />
                <span>Information Technology Center</span>
            </div>
            <div class="links">
                <a href="" class="link <?php echo $index == 0 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="../images/darhboard_alt.svg" alt="">
                        <p>Dashboard</p>
                    </div>
                </a>
                <a href="" class="link <?php echo $index == 1 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="../images/Mortarboard.svg" alt="">
                        <p>Courses</p>
                    </div>
                </a>
                <a href="" class="link <?php echo $index == 2 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="../images/User_alt.svg" alt="">
                        <p>Users</p>
                    </div>
                </a>
                <a href="" class="link <?php echo $index == 3 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="../images/Star.svg" alt="">
                        <p>Events & Achievements</p>
                    </div>
                    <ul class="dropdown-menu">
                        <li>Upcoming Events</li>
                        <li>Previous Events</li>
                        <li>Achievements</li>
                    </ul>
                </a>
            </div>
        </div>
    <?php } ?>
</body>

</html>
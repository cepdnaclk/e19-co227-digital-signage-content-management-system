<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/sidebar.css">
</head>

<body>
    <?php function sidebar(int $index, int $subindex)
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
                <a href="/pages/course/" class="link <?php echo $index == 1 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/Mortarboard.svg" alt="">
                        <p>Courses</p>
                    </div>
                </a>
                <a href="/pages/users/" class="link <?php echo $index == 2 ? 'active' : '' ?>">
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
                    <li>
                        <a href="/pages/upcoming/" class="link <?php echo $index == 3 ? 'active' : '' ?>">
                            Upcoming Events<?php echo $index == 3 && $subindex == 1 ? ' <b>|</b>' : '' ?>
                        </a>
                    </li>
                    <li>
                        <a href="/pages/previous/" class="link <?php echo $index == 3 ? 'active' : '' ?>">
                            Previous Events<?php echo $index == 3 && $subindex == 2? ' <b>|</b>' : '' ?>
                        </a>
                    </li>
                    <li>
                        <a href="/pages/achievements/" class="link <?php echo $index == 3 ? 'active' : '' ?>">
                            Achievements<?php echo $index == 3 && $subindex == 3 ? ' <b>|</b>' : '' ?>
                        </a>
                    </li>
                </ul>
            </div>

                <a href="/pages/labslots/" class="link <?php echo $index == 4 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/calendar.svg" alt="">
                        <p>Lab Allocations</p>
                    </div>
                </a>

                <a href="/pages/general.php" class="link <?php echo $index == 5 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/info.svg" alt="">
                        <p>General Info</p>
                    </div>
                </a>
                <ul>
                    <li>
                        <a href="/pages/maps/" class="link <?php echo $index == 5 ? 'active' : '' ?>">
                            Maps<?php echo $index == 5 && $subindex == 1 ? ' <b>|</b>' : '' ?>
                        </a>
                    </li>
                    <li>
                        <a href="/pages/labcapacity/" class="link <?php echo $index == 5 ? 'active' : '' ?>">
                            Lab Capacity<?php echo $index == 5 && $subindex == 2? ' <b>|</b>' : '' ?>
                        </a>
                    </li>
                </ul>

                <a href="/pages/bookings/" class="link <?php echo $index == 6 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/book.svg" alt="">
                        <p>Lab Bookings</p>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
</body>

</html>
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
                <a href="/pages/users/" class="link <?php echo $index == 2 ? 'active' : '' ?>">
                    <div class="link-main">
                        <img src="/images/User_alt.svg" alt="">
                        <p>Users</p>
                    </div>
                </a>

                <a href="/pages/labslots/" class="link <?php echo $index == 4 ? 'active' : '' ?>">
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
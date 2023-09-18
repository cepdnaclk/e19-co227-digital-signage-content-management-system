<?php include "../includes/header_core.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../css/header.css">
</head>

<body>
  <header>
    <div class="container">
      <div class="logo">
        <img src="../images/ITCenterLogo.svg" alt="IT Center Logo" />
      </div>
      <div class="title">
        <span>Information Technology Center - CMS</span>
      </div>
      <div class="menu">
        <ul>
          <li>Dashboard</li>
          <li class="selected">Course Offerings</li>
          <li >Lab Schedule</li>
          <li>Users</li>
          <li class="dropdown">
            Events & Achievements
            <ul class="dropdown-menu">
              <a href="upcomingevents.php">
                <li >Upcoming Events</li>
              </a>

              <li>Previous Events</li>
              <li>Achievements</li>
            </ul>
          </li>
        </ul>
        <div class="menu-button"></div>
      </div>
      <div class="profile">
        <img src="../images/sample-pro-pic.png" alt="Profile Picture" />
      </div>
    </div>
  </header>
  <script src="../js/header.js"></script>
</body>

</html>
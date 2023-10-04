<?php include_once "../config.php" ;
include (APP_ROOT . "/includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/contactNsupport.css">
    <title>IT Center | Contact & Support</title>
    
    <script> //display relevent data on hovering
       
        document.addEventListener("DOMContentLoaded", function () {
            const superAdminRole = document.getElementById("super-admin-role");
            const adminRole = document.getElementById("admin-role");
            const coordinatorRole = document.getElementById("coordinator-role");
            const allUsers = document.querySelector(".all-users");

            superAdminRole.addEventListener("mouseenter", function () {
            // Hide all user data except Super Admin
            document.querySelector(".super-admin").style.display = "block";
            document.querySelector(".admins").style.display = "none";
            document.querySelector(".coordinators").style.display = "none";
            });

        adminRole.addEventListener("mouseenter", function () {
            // Hide all user data except Admins
            document.querySelector(".super-admin").style.display = "none";
            document.querySelector(".admins").style.display = "block";
            document.querySelector(".coordinators").style.display = "none";
            });

        coordinatorRole.addEventListener("mouseenter", function () {
            // Hide all user data except Coordinators
            document.querySelector(".super-admin").style.display = "none";
            document.querySelector(".admins").style.display = "none";
            document.querySelector(".coordinators").style.display = "block";
            });
        });
    </script>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(2);
            ?>
        </div>
        <div class="right">
            
            <main class="contact-support">
    <div class="container">
        <h1>Contact and Support</h1>
        <p>If you have any questions or need assistance, please feel free to get in touch with us.</p>

        <!-- Contact Form -->
        <form action="#" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message/Complaint:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <input type="submit" value="Send Message">
        </form>

        <!-- Contact Details Grid -->
        <h2>Contact Details</h2>
        <div class="contact-details-grid">
            <div class="contact-address">
                <h3>Contact Address</h3>
                <address>
                    <p>Information Technology Center</p>
                    <p>University of Peradeniya</p>
                    <p>Peradeniya</p>
                    <p>Sri Lanka</p>
                </address>
            </div>
            <div class="tele-no">
                <div class="tele-icon">
                    <h3>Telephone</h3>
                    <img src="../images/tele.svg" alt="Telephone Icon">
                </div>
                <ul>
                    <li>+94 123 123 123</li>
                    <li>+94 456 456 456</li>
                    <li>+94 789 789 789</li>
                </ul>
            </div>

            <div class="email">
                <div class="email-icon">
                    <h3>Email</h3>
                    <img src="../images/email.svg" alt="Email Icon">
                </div>
                <p class="email">info@cert.pdn.ac.lk</p>
            </div>
            <div class="web">
                <div class="web-icon">
                    <h3>Website</h3>
                    <img src="../images/web.svg" alt="Website Icon">
                    </div>
            <p class="link"><a href="https://www.ceit.pdn.ac.lk">www.ceit.pdn.ac.lk</a></p>
            </div>
        </div>
    </div>
</main>

        </div>
    </div>
   
</body>

</html>

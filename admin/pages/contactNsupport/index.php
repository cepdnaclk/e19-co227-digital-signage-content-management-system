<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include(APP_ROOT . "/includes/header_contactNSupport.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/contactNsupport.css">
    <title>IT Center | Contact & Support</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(2, 0);
            ?>
        </div>
        <div class="right">

            <main class="contact-support">
                <div class="container">
                    <h1>Contact and Support</h1>

                    <p>If you have any questions or need assistance, please feel free to get in touch with the Director
                        or admins at the IT Center.</p>


                    <!-- Contact Form -->
                    <form action="/backend/api/support/send.php" method="post">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" placeholder="Leave It Anonymous">

                        <label for="email">Your Email:</label>
                        <input type="email" id="email" name="email" placeholder="Leave It Anonymous">

                        <label for="message">Your Message/Complaint:</label>
                        <textarea id="message" name="message" rows="4" required></textarea>

                        <input type="submit" value="Send Message">
                    </form>
                    
                    <!-- Redirect to User Manual -->
                    <div class="manual">
                    <h2>Admin's and Coordinator's User Manual</h2>
                    </br>
                    <center>
                    <?php
                        // Set the default URL
                        $userManualUrl = "/pages/contactNsupport/coordinator.php";
                        
                        // Check the user's role and update the URL accordingly
                        if ($role === "admin") {
                            $userManualUrl = "/pages/contactNsupport/admin.php";
                        } elseif ($role === "super_admin") {
                            $userManualUrl = "/pages/contactNsupport/super_admin.php";
                        }

                        // Output the link with the dynamically determined URL
                        echo "<a href=\"$userManualUrl\">Go To User Manual</a>";
                    ?>

                    </center>
                    </br>
                    </div>



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
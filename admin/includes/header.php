<?php
// Start the session before any output is sent
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// var_dump($_SESSION);

// Include the core header
include $_SERVER['DOCUMENT_ROOT'] . "/includes/header_core.php";


// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  // Fetch user information from the database based on the user_id
  $user_id = $_SESSION['user_id'];


  // Use your database connection and query to fetch user data
  // Replace 'your_query_here' with the actual SQL query to fetch user data
  $sql = "SELECT user_name FROM user WHERE u_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    // User data found, retrieve information
    $username = $row['user_name'];
  }
}
if (!isset($_SESSION['user_id'])) {
  // User is not logged in, redirect them to the login page
  header("Location: /pages/login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="/css/header.css">
</head>

<body>
  <header>
    <div class="logo">
      <img src="/images/signage.png" alt="">
      <h3>DIGISIGNAGE</h3>
    </div>
    <div class="menu">
      <ul>
        <li><a href="/pages/contactNsupport">Contact & Support</a></li>
      </ul>
    </div>
    <div class="profile">
      <div class="img">
        <?php echo isset($username) ? strtoupper(substr($username, 0, 1)) : 'G'; ?>
      </div>
      <h5>
        <?php echo isset($username) ? $username : 'Guest'; ?>
      </h5>
      <p>
        <a class="btn btn-danger logout" href="/backend/logout.php">Log out</a>
      </p>
    </div>
  </header>
  <?php if (isset($_GET['error']) && $_GET['error'] != "") { ?>
    <div class="alert error">
      <h4>Error :</h4>
      <p>
        <?= $_GET['error'] ?>
      </p>
    </div>
  <?php } ?>
  <?php if (isset($_GET['success']) && $_GET['success'] != "") { ?>
    <div class="alert success">
      <h4>Success :</h4>
      <p>
        <?= $_GET['success'] ?>
      </p>
    </div>
  <?php } ?>
</body>

</html>
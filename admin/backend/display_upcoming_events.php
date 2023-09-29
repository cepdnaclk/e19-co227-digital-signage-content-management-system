<?php
include_once "../config.php";


// Select events from the 'upcoming_event' table
$sql = "SELECT * FROM upcoming_event";
$result = mysqli_query($conn, $sql);

// Check if there are any rows in the result

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Display event information (you can customize the display as needed)
        echo "<div class='card'>";
        echo "<img src='" . $row["e_img"] . "' alt='Add Event Image'>";
        echo "<div class='card-content'>";
        echo "<h2 class='card-title'>" . $row["e_name"] . "</h2>";
        echo "<p class='card-date'>" . $row["e_date"] . " at " . $row["e_time"] . "</p>";
        echo "<p class='card-venue'>" . $row["e_venue"] . "</p>";
        echo "<p><br>Display Duration</p>";
        echo "<p class='card-duration'>From " . $row["display_from"] . "<br>To " . $row["display_to"] . "</p>";
        echo "</div>";
        // Card actions with icons
        echo "<div class='card-actions'>";
        echo "<button class='edit-button'><span class='icon'>&#9998;</span>Edit</button>";
        echo "<button class='delete-button'><span class='icon'>&#128465;</span>Delete</button>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No events found.";
}

// Close the database connection
mysqli_close($conn);
?>

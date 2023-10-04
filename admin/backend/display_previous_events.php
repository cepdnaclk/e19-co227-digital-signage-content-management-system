<?php
include_once "../config.php";


// Select events from the 'previous_event' table
$sql = "SELECT * FROM previous_event";
$result = mysqli_query($conn, $sql);

// Check if there are any rows in the result

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Display event information (you can customize the display as needed)
        echo "<div class='card'>";
        echo "<img src='" . $row["p_img"] . "' alt='Add Event Image'>";
        echo "<div class='card-content'>";
        echo "<h2 class='card-title'>" . $row["p_name"] . "</h2>";
        echo "<p class='card-description'>" . $row["p_desc"] . "</p>";
        echo "<p class='card-date'>" . $row["p_date"] . "</p>";
        //echo "<p class='card-duration'>From " . $row["display_from"] . "<br>To " . $row["display_to"] . "</p>";
        echo "</div>";

        // Card actions with icons
        echo "<div class='card-actions'>";
        echo '<a href="editpreviousevent.php?edit_id=' . $row['p_id'] . '"><button class="edit-button"><span class="icon">&#9998;</span>Edit</button></a>';
        
        
        if ($row['published'] == 1) {
            echo '<a class="unpublish" href="../backend/publish.php?publish_id=' . $row['p_id'] . '"><button class="unpublish-button" ><span class="icon">&#10680;</span>Unpublish</button></a>';
            //echo '<button class="unpublish-button" >';
            //echo '<span class="icon">&#10680;</span><a class="unpublish" href="../backend/publish.php?publish_id=' . $row['e_id'] . '">Unpublish</a>';
        } else {
            echo '<a class="publish" href="../backend/publish.php?publish_id=' . $row['p_id'] . '"><button class="publish-button" ><span class="icon">&#10004;</span>Publish</button></a>';
            //echo '<button class="publish-button" >';
            //echo '<span class="icon">&#10004;</span><a class= "publish" href="../backend/publish.php?publish_id=' . $row['e_id'] . '">Publish</a>';
        }
        //echo '</button>';

        echo  '<button class="delete-button"><span class="icon">&#128465;</span><a href="../backend/deletepreviousevent.php?delete_id=' . $row['p_id'] . '">Delete</a></button>';
        //Add confirm delete message
        
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No events found.";
}

// Close the database connection
mysqli_close($conn);
?>

<!-- <html>
    <head>

    </head>

    <body>
        <div class='confirm-delete'>
        <script>
            function confirmDelete(button) {
                if (confirm("Are you sure you want to delete this event?")) {
                    // Get the form that the button is inside of
                    const form = button.closest("form");

                    // Submit the form
                    form.submit();
                   
                } else {
                // If the user cancels, do nothing
                }
            }
        </script>
        </div>
    </body>
</html> -->

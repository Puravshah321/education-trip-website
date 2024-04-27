<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "project");

// Check if activity ID is provided
if (isset($_GET['id'])) {
    // Fetch activity details from the database
    $activityId = $_GET['id'];
    $sql = "SELECT * FROM activity WHERE activity_id = $activityId";
    $result = mysqli_query($conn, $sql);

    // Check if activity exists
    if (mysqli_num_rows($result) > 0) {
        // Output data of the activity
        $row = mysqli_fetch_assoc($result);
        echo "<h4>" . $row["activity_id"] . "</h4>";
        echo "<p>" . $row["activity_name"] . "</p>";
        // Output other activity details as needed
    } else {
        echo "Activity not found";
    }
} else {
    echo "Invalid request";
}

mysqli_close($conn);
?>

<?php
// Establish database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if package_id is set and not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $package_id = $_GET['id'];

  // Construct SQL query to delete package
  $sql = "DELETE FROM package WHERE package_id = '$package_id'";

  // Execute the delete query
  if ($conn->query($sql) === TRUE) {
    echo "Package deleted successfully.";
  } else {
    echo "Error deleting package: " . $conn->error;
  }
} else {
  echo "Package ID not specified.";
}

// Close the database connection
$conn->close();

// Redirect to view journeys page
header("Location: adminviewjourneys.php");
exit();
?>

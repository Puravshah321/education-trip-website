<?php
// Start session
session_start();

// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the package_id from the query string
$package_id = isset($_GET['id']) ? $_GET['id'] : '';

if ($package_id) {
  // Prepare SQL statement to delete the package
  $sql = "DELETE FROM package WHERE package_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $package_id);
  $success = mysqli_stmt_execute($stmt);

  if ($success) {
    echo "<script>alert('Package deleted successfully.')</script>";
  } else {
    echo "<script>alert('Error deleting package.')</script>";
  }

  mysqli_stmt_close($stmt);
}

// Close database connection
mysqli_close($conn);

// Redirect back to the main page
echo "<script>window.location = 'adminviewjourneys.php';</script>";
?>
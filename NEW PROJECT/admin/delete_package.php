<?php
// Establish database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
  $package_id = $_GET['id'];
  $sql = "DELETE FROM package WHERE package_id=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $package_id);
  if (mysqli_stmt_execute($stmt)) {
    echo "Package deleted successfully.";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
  mysqli_stmt_close($stmt);
}

// Redirect to view journeys page
header("Location: admin_view_journeys.php");
exit();
?>

<?php
// Start session to use session variables
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

// Define variables for pagination (adjust as needed)
$results_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate offset for pagination
$start = ($page - 1) * $results_per_page;

// Securely prepare SQL query to prevent injection attacks
$sql = "SELECT package_id, package_type, filter_category, filter_state, filter_grade, filter_month, package_name, package_duration, package_date1, package_date2, package_date3, package_price FROM package LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $start, $results_per_page);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

// Check for errors during query execution
if (!$result) {
  die("Error retrieving packages: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - View Journeys</title>
  <style>
    /* Simple aesthetic styling */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      width: 95%;
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      padding: 15px 0;
      margin-bottom: 20px;
      border-bottom: 2px solid #dddddd;
    }

    .header h1 {
      margin: 0;
      font-size: 24px;
      color: #333333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #dddddd;
    }

    th {
      background-color: #f4f4f9;
      color: #555555;
    }

    tr:nth-child(even) td {
      background-color: #f9f9f9;
    }

    .actions a {
      display: inline-block;
      padding: 8px 12px;
      margin: 0 4px;
      border-radius: 5px;
      text-decoration: none;
      color: #ffffff;
      transition: background-color 0.3s;
    }

    .actions a.edit {
      background-color: #007bff;
    }

    .actions a.edit:hover {
      background-color: #0056b3;
    }

    .actions a.delete {
      background-color: #dc3545;
    }

    .actions a.delete:hover {
      background-color: #c82333;
    }

    .pagination {
      display: flex;
      justify-content: center;
      list-style: none;
      padding: 0;
      margin-top: 20px;
    }

    .pagination li {
      margin: 0 5px;
    }

    .pagination li a {
      display: block;
      padding: 8px 12px;
      text-decoration: none;
      border: 1px solid #dddddd;
      border-radius: 5px;
      color: #333333;
      transition: background-color 0.3s, color 0.3s;
    }

    .pagination li a:hover {
      background-color: #007bff;
      color: #ffffff;
    }

    .pagination li.active a {
      background-color: #007bff;
      color: #ffffff;
    }

    .form-container {
      width: 100%;
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
      margin-bottom: 20px;
      text-align: center;
      color: #333333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="date"] {
      width: 100%;
      padding: 12px;
      border-radius: 5px;
      border: 1px solid #cccccc;
      box-sizing: border-box;
    }

    .form-group button[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-group button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>Admin - View Journeys</h1>
  </div>
  <table>
    <tr>
      <th>Package Name</th>
      <th>Filter Category</th>
      <th>Filter State</th>
      <th>Filter Grade</th>
      <th>Filter Month</th>
      <th>Package Type</th>
      <th>Package Duration</th>
      <th>Package Price</th>
      <th>Package Date 1</th>
      <th>Package Date 2</th>
      <th>Package Date 3</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?php echo $row['package_name']; ?></td>
        <td><?php echo $row['filter_category']; ?></td>
        <td><?php echo $row['filter_state']; ?></td>
        <td><?php echo $row['filter_grade']; ?></td>
        <td><?php echo $row['filter_month']; ?></td>
        <td><?php echo $row['package_type']; ?></td>
        <td><?php echo $row['package_duration']; ?></td>
        <td><?php echo $row['package_price']; ?></td>
        <td><?php echo $row['package_date1']; ?></td>
        <td><?php echo $row['package_date2']; ?></td>
        <td><?php echo $row['package_date3']; ?></td>
        <td class="actions">
          <a href="edit_package.php?id=<?php echo $row['package_id']; ?>" class="edit">Edit</a>
          <a href="delete_package.php?id=<?php echo $row['package_id']; ?>" onclick="return confirm('Are you sure you want to delete this package?')" class="delete">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
  
  <?php
  // Release results and close connection
  mysqli_free_result($result);
  mysqli_stmt_close($stmt);

  // Pagination logic (adjust as needed)
  $sql_total = "SELECT COUNT(*) FROM package";
  $stmt_total = mysqli_prepare($conn, $sql_total);
  mysqli_stmt_execute($stmt_total);
  $result_total = mysqli_stmt_get_result($stmt_total);
  $total_packages = mysqli_fetch_array($result_total)[0];
  mysqli_free_result($result_total);
  mysqli_stmt_close($stmt_total);

  $total_pages = ceil($total_packages / $results_per_page);

  if ($total_pages > 1) {
    echo "<ul class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
      $active_class = ($i == $page) ? "active" : "";
      echo "<li class='$active_class'><a href='?page=$i'>$i</a></li>";
    }
    echo "</ul>";
  }
  ?>
  
  <div class="form-container">
    <h2>Add New Package</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?page=<?php echo $page; ?>">
      <div class="form-group">
        <label for="package_name">Package Name</label>
        <input type="text" id="package_name" name="package_name" required>
      </div>
      <div class="form-group">
        <label for="filter_category">Filter Category</label>
        <input type="text" id="filter_category" name="filter_category" required>
      </div>
      <div class="form-group">
        <label for="filter_state">Filter State</label>
        <input type="text" id="filter_state" name="filter_state" required>
      </div>
      <div class="form-group">
        <label for="filter_grade">Filter Grade</label>
        <input type="text" id="filter_grade" name="filter_grade" required>
      </div>
      <div class="form-group">
        <label for="filter_month">Filter Month</label>
        <input type="text" id="filter_month" name="filter_month" required>
      </div>
      <div class="form-group">
        <label for="package_type">Package Type</label>
        <input type="text" id="package_type" name="package_type" required>
      </div>
      <div class="form-group">
        <label for="package_duration">Package Duration</label>
        <input type="text" id="package_duration" name="package_duration" required>
      </div>
      <div class="form-group">
        <label for="package_price">Package Price</label>
        <input type="number" id="package_price" name="package_price" required>
      </div>
      <div class="form-group">
        <label for="package_date1">Package Date 1</label>
        <input type="date" id="package_date1" name="package_date1" required>
      </div>
      <div class="form-group">
        <label for="package_date2">Package Date 2</label>
        <input type="date" id="package_date2" name="package_date2" required>
      </div>
      <div class="form-group">
        <label for="package_date3">Package Date 3</label>
        <input type="date" id="package_date3" name="package_date3" required>
      </div>
      <div class="form-group">
        <button type="submit" name="submit">Add Package</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
  // Get form data
  $package_name = $_POST['package_name'];
  $filter_category = $_POST['filter_category'];
  $filter_state = $_POST['filter_state'];
  $filter_grade = $_POST['filter_grade'];
  $filter_month = $_POST['filter_month'];
  $package_type = $_POST['package_type'];
  $package_duration = $_POST['package_duration'];
  $package_price = $_POST['package_price'];
  $package_date1 = $_POST['package_date1'];
  $package_date2 = $_POST['package_date2'];
  $package_date3 = $_POST['package_date3'];

  // Securely insert data into the database
  $sql_insert = "INSERT INTO package (package_name, filter_category, filter_state, filter_grade, filter_month, package_type, package_duration, package_price, package_date1, package_date2, package_date3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt_insert = mysqli_prepare($conn, $sql_insert);
  mysqli_stmt_bind_param($stmt_insert, "ssssssssdss", $package_name, $filter_category, $filter_state, $filter_grade, $filter_month, $package_type, $package_duration, $package_price, $package_date1, $package_date2, $package_date3);

  if (mysqli_stmt_execute($stmt_insert)) {
    echo "<script>alert('Package added successfully!'); window.location.href='?page=$page';</script>";
  } else {
    echo "Error: " . mysqli_stmt_error($stmt_insert);
  }

  mysqli_stmt_close($stmt_insert);
}

// Close the database connection
mysqli_close($conn);
?>

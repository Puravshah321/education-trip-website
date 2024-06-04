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

// Fetch package details if package_id is provided
if (isset($_GET['id'])) {
  $package_id = $_GET['id'];
  $sql = "SELECT * FROM package WHERE package_id=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $package_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  
  // Check if the package exists
  if (!$row) {
    // If no package found, redirect to adminviewjourneys.php
    header("Location: adminviewjourneys.php");
    exit();
  }
} else {
  // If no package_id provided, redirect to adminviewjourneys.php
  header("Location: adminviewjourneys.php");
  exit();
}

// Update data into database when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['package_name']) && !empty($_POST['package_type']) && !empty($_POST['filter_category']) && !empty($_POST['filter_state']) && !empty($_POST['filter_grade']) && !empty($_POST['filter_month']) && !empty($_POST['package_duration']) && !empty($_POST['package_price']) && !empty($_POST['package_date1']) && !empty($_POST['package_date2']) && !empty($_POST['package_date3'])) {
    $p_id = $_GET["package_id"];
    $package_name = $_POST['package_name'];
    $package_type = $_POST['package_type'];
    $filter_category = $_POST['filter_category'];
    $filter_state = $_POST['filter_state'];
    $filter_grade = $_POST['filter_grade'];
    $filter_month = $_POST['filter_month'];
    $package_duration = $_POST['package_duration'];
    $package_price = $_POST['package_price'];
    $package_date1 = $_POST['package_date1'];
    $package_date2 = $_POST['package_date2'];
    $package_date3 = $_POST['package_date3'];

    // Update data into database
    $sql = "UPDATE package SET package_name=$package_name,
     package_type=$package_type, filter_category=$filter_category, filter_state=$filter_state, 
     filter_grade=$filter_grade, filter_month=$filter_month, package_duration=$package_duration,
      package_price=$package_price, package_date1=$package_date1, package_date2=$package_date2, 
      package_date3=$package_date3 WHERE package_id=$p_id";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssssi", $package_name, $package_type, $filter_category, $filter_state, $filter_grade, $filter_month, $package_duration, $package_price, $package_date1, $package_date2, $package_date3, $package_id);
    if (mysqli_stmt_execute($stmt)) {
      // Redirect to view journeys page after successful update
      header("Location: adminviewjourneys.php?success=1");
      exit();
    } else {
      echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
  } else {
    echo "Please fill in all the fields.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Package</title>
  <style>
    /* Basic styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form label {
      display: block;
      margin-bottom: 5px;
    }

    form input[type="text"],
    form input[type="number"],
    form input[type="date"] {
      width: calc(100% - 10px);
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }

    form button[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    form button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Edit Package</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $package_id); ?>" method="post">
    <input type="hidden" name="package_id" value="<?php echo $row['package_id']; ?>">
    
    <label for="package_name">Package Name:</label>
    <input type="text" id="package_name" name="package_name" value="<?php echo $row['package_name']; ?>" required>
    
    <label for="package_type">Package Type:</label>
    <input type="text" id="package_type" name="package_type" value="<?php echo $row['package_type']; ?>" required>
    
    <label for="filter_category">Filter Category:</label>
    <input type="text" id="filter_category" name="filter_category" value="<?php echo $row['filter_category']; ?>" required>
    
    <label for="filter_state">Filter State:</label>
    <input type="text" id="filter_state" name="filter_state" value="<?php echo $row['filter_state']; ?>" required>
    
    <label for="filter_grade">Filter Grade:</label>
    <input type="text" id="filter_grade" name="filter_grade" value="<?php echo $row['filter_grade']; ?>" required>
    
    <label for="filter_month">Filter Month:</label>
    <input type="text" id="filter_month" name="filter_month" value="<?php echo $row['filter_month']; ?>" required>
    
    <label for="package_duration">Package Duration:</label>
    <input type="text" id="package_duration" name="package_duration" value="<?php echo $row['package_duration']; ?>" required>
    
    <label for="package_price">Package Price:</label>
    <input type="number" id="package_price" name="package_price" value="<?php echo $row['package_price']; ?>" required>
    
    <label for="package_date1">Package Date 1:</label>
    <input type="date" id="package_date1" name="package_date1" value="<?php echo $row['package_date1']; ?>" required>
    
    <label for="package_date2">Package Date 2:</label>
    <input type="date" id="package_date2" name="package_date2" value="<?php echo $row['package_date2']; ?>" required>
    
    <label for="package_date3">Package Date 3:</label>
    <input type="date" id="package_date3" name="package_date3" value="<?php echo $row['package_date3']; ?>" required>
    
    <button type="submit">Update Package</button>
  </form>
</div>

</body>
</html>

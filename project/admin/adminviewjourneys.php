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

// Define variables for pagination (adjust as needed)
$results_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate offset for pagination
$start = ($page - 1) * $results_per_page;

// Securely prepare SQL query to prevent injection attacks
$sql = "SELECT package_id, package_type, filter_category, filter_state, filter_grade, filter_month, package_name, package_duration,  package_date1,  package_date2 ,  package_date3 , package_price FROM package LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $start, $results_per_page);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

// Check for errors during query execution
if (!$result) {
  die("Error retrieving packages: " . mysqli_error($conn));
}

// Handle form submission for adding a new package
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate form data for the main package
  if (!empty($_POST['package_type']) && !empty($_POST['filter_category']) && !empty($_POST['filter_state']) && !empty($_POST['filter_grade']) && !empty($_POST['filter_month']) && !empty($_POST['package_name']) && !empty($_POST['package_duration']) && !empty($_POST['package_price']) && !empty($_POST['package_date1']) && !empty($_POST['package_date2']) && !empty($_POST['package_date3'])) {
    
    $package_type = $_POST['package_type'];
    $filter_category = $_POST['filter_category'];
    $filter_state = $_POST['filter_state'];
    $filter_grade = $_POST['filter_grade'];
    $filter_month = $_POST['filter_month'];
    $package_name = $_POST['package_name'];
    $package_duration = $_POST['package_duration'];
    $package_price = $_POST['package_price'];
    $package_date1 = $_POST['package_date1'];
    $package_date2 = $_POST['package_date2'];
    $package_date3 = $_POST['package_date3'];

    // Insert data into package table
    $sql = "INSERT INTO package (package_type, filter_category, filter_state, filter_grade, filter_month, package_name, package_duration, package_price, package_date1, package_date2, package_date3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssss", $package_type, $filter_category, $filter_state, $filter_grade, $filter_month, $package_name, $package_duration, $package_price, $package_date1, $package_date2, $package_date3);
    
    if (mysqli_stmt_execute($stmt)) {
      // Retrieve the inserted package_id
      $package_id = mysqli_insert_id($conn);

      // Loop through day-wise itinerary fields
      for ($i = 1; $i <= $package_duration; $i++) {
        $itinerary_id = $_POST['itinerary_id_' . $i];// Adjust this based on your logic
        $day = $i;
        $location = $_POST['location_' . $i];
        $distance = $_POST['distance_' . $i];
        $description = $_POST['description_' . $i];
        $hotel_id = $_POST['hotel_id_' . $i];

        // Insert into itinerary table with package_id
        $sql_itinerary = "INSERT INTO itinerary (package_id, itinerary_id, day, location, distance, description, hotel_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_itinerary = mysqli_prepare($conn, $sql_itinerary);
        mysqli_stmt_bind_param($stmt_itinerary, "ssisdss", $package_id, $itinerary_id,$day, $location, $distance, $description, $hotel_id);
        
        if (mysqli_stmt_execute($stmt_itinerary)) {
            // Successfully inserted itinerary details
        } else {
            // Error handling
            echo "Error inserting itinerary: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt_itinerary);
      }
      
      echo "New package and itinerary added successfully.";
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
  <title>Admin - View Journeys</title>
  <style>
    /* Basic table styling */
    /* Basic table styling */
    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 2rem;
    }

    th, td {
      padding: 1rem;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    /* Aesthetic improvements */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .header {
      background-color: #333;
      color: #fff;
      padding: 2rem 0;
      text-align: center;
    }

    .header h1 {
      margin: 0;
      font-size: 2rem;
    }

    .sub-heading {
      margin-top: 2rem;
      color: #333;
    }

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #333;
      color: #fff;
    }

    /* Pagination styles */
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
      border: 1px solid #ddd;
      border-radius: 5px;
      color: #333;
      transition: background-color 0.3s, color 0.3s;
    }

    .pagination li a:hover {
      background-color: #eee;
      color: #000;
    }

    .pagination li.active a {
      background-color: #333;
      color: #fff;
    }

    /* Form styles */
    form {
      margin-top: 20px;
      max-width: 800px; /* Increased width */
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
    }

    form label {
      display: block;
      margin-bottom: 5px;
    }

    form input[type="text"],
    form input[type="number"],
    form input[type="date"],
    form input[type="file"],
    form select {
      width: calc(50% - 6px); /* Adjusted width */
      padding: 8px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    form button {
      width: 100%;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    form button:hover {
      background-color: #555;
    }

    /* Edit and delete button styles */
    .actions {
      display: flex;
      justify-content: center;
    }

    .actions a {
      padding: 8px 16px;
      margin: 0 4px;
      border-radius: 5px;
      text-decoration: none;
      color: #fff;
      background-color: #007bff; /* Colorful edit button */
      transition: background-color 0.3s;
    }

    .actions a:hover {
      background-color: #0056b3; /* Darker color on hover */
    }

    .actions a.delete {
      background-color: #dc3545; /* Colorful delete button */
    }

    .actions a.delete:hover {
      background-color: #c82333; /* Darker color on hover */
    }

    /* New package form styles */
    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input,
    .form-group select {
      width: calc(100% - 10px);
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .form-group input[type="file"] {
      padding-top: 15px;
    }

    .form-group button[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-group button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }

            /* Go back link */
            .go-back {
            position: fixed;
            top: 20px;
            left: 20px;
        }

        .go-back a {
            color: #007bff;
            text-decoration: none;
        }

        .go-back a:hover {
            text-decoration: underline;
        }

  </style>
</head>
<body>

<div class="go-back">
    <a href="admindashboard.php">&laquo; Go Back</a>
</div>
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
        <a href="edit_package.php?id=<?php echo $row['package_id']; ?>">Edit</a>
        <a href="delete_package.php?id=<?php echo $row['package_id']; ?>" onclick="return confirm('Are you sure you want to delete this package?')" class="delete">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<?php
// Release results and close connection
mysqli_free_result($result);
//mysqli_stmt_close($stmt);

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

<h2 class="sub-heading">Add New Package</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
  <label for="package_name">Package Name:</label>
  <input type="text" id="package_name" name="package_name" required><br><br>

  <label for="package_type">Package Type:</label>
  <select id="package_type" name="package_type" required>
    <option value="">Select Package Type</option>
    <option value="standard">Standard</option>
    <option value="economic">Economic</option>
    <option value="premium">Premium</option>
  </select><br><br>

  <label for="filter_category">Filter Category:</label>
  <select id="filter_category" name="filter_category" required>
    <option value="">Select Filter Category</option>
    <option value="heritage">Heritage</option>
    <option value="industrial">Industrial</option>
    <option value="wildlife">Wildlife</option>
    <option value="cultural">Cultural</option>
    <option value="historical">Historical</option>
  </select><br><br>

  <label for="filter_state">Filter State:</label>
  <select id="filter_state" name="filter_state" required>
    <option value="">Select Filter State</option>
                  <option value="all">All</option>
                  <option value="andhra-pradesh">Andhra Pradesh</option>
                  <option value="arunachal-pradesh">Arunachal Pradesh</option>
                  <option value="assam">Assam</option>
                  <option value="bihar">Bihar</option>
                  <option value="chhattisgarh">Chhattisgarh</option>
                  <option value="goa">Goa</option>
                  <option value="gujarat">Gujarat</option>
                  <option value="haryana">Haryana</option>
                  <option value="himachal-pradesh">Himachal Pradesh</option>
                  <option value="jammu-kashmir">Jammu and Kashmir</option>
                  <option value="jharkhand">Jharkhand</option>
                  <option value="karnataka">Karnataka</option>
                  <option value="kerala">Kerala</option>
                  <option value="madhya-pradesh">Madhya Pradesh</option>
                  <option value="maharashtra">Maharashtra</option>
                  <option value="manipur">Manipur</option>
                  <option value="meghalaya">Meghalaya</option>
                  <option value="mizoram">Mizoram</option>
                  <option value="nagaland">Nagaland</option>
                  <option value="odisha">Odisha</option>
                  <option value="punjab">Punjab</option>
                  <option value="rajasthan">Rajasthan</option>
                  <option value="sikkim">Sikkim</option>
                  <option value="tamil-nadu">Tamil Nadu</option>
                  <option value="telangana">Telangana</option>
                  <option value="tripura">Tripura</option>
                  <option value="uttar-pradesh">Uttar Pradesh</option>
                  <option value="uttarakhand">Uttarakhand</option>
                  <option value="west-bengal">West Bengal</option>
               </select>
<br><br>

  <label for="filter_grade">Filter Grade:</label>
  <select id="filter_grade" name="filter_grade" required>
    <option value="">Select Filter Grade</option>
    <option value="Primary">Primary</option>
    <option value="Secondary">Secondary</option>
    <option value="Higher Secondary">Higher Secondary</option>
  </select><br><br>

  <label for="filter_month">Filter Month:</label>
  <select id="filter_month" name="filter_month" required>
    <option value="">Select Filter Month</option>
    <option value="summer">Summer</option>
    <option value="winter">Winter</option>
    <option value="monsoon">Monsoon</option>
    <option value="spring">Spring</option>
  </select><br><br>

  <label for="package_duration">Package Duration:</label>
  <input type="number" id="package_duration" name="package_duration" min="1"  required><br><br>
    
  <!-- New section for day-wise itinerary -->
  <div id="day-wise-itinerary"></div>

  <label for="package_price">Package Price:</label>
  <input type="number" id="package_price" name="package_price" required><br><br>

  <label for="package_date1">Package Date 1:</label>
  <input type="date" id="package_date1" name="package_date1" required><br><br>

  <label for="package_date2">Package Date 2:</label>
  <input type="date" id="package_date2" name="package_date2" required><br><br>

  <label for="package_date3">Package Date 3:</label>
  <input type="date" id="package_date3" name="package_date3" required><br><br>

  <button type="submit">Add Package</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Function to add day-wise itinerary fields dynamically
      function addDayWiseItineraryFields(numDurations) {
        let html = '';
        for (let i = 1; i <= numDurations; i++) {
          html += `
            <div class="form-group">
              <label for="itinerary_id_${i}">Itinerary ID:</label>
              <input type="text" id="itinerary_id_${i}" name="itinerary_id_${i}" required>
            </div>
            <div class="form-group">
              <label for="package_id_${i}">Package ID:</label>
              <input type="text" id="package_id_${i}" name="package_id_${i}" required>
            </div>
            <div class="form-group">
              <label for="day_${i}">Day ${i}:</label>
              <input type="number" id="day_${i}" name="day_${i}" value="${i}" readonly>
            </div>
            <div class="form-group">
              <label for="location_${i}">Location:</label>
              <input type="text" id="location_${i}" name="location_${i}" required>
            </div>
            <div class="form-group">
              <label for="distance_${i}">Distance (km):</label>
              <input type="number" id="distance_${i}" name="distance_${i}" step="0.1" required>
            </div>
            <div class="form-group">
              <label for="description_${i}">Description:</label>
              <textarea id="description_${i}" name="description_${i}" rows="4" required></textarea>
            </div>
            <div class="form-group">
              <label for="hotel_id_${i}">Hotel ID:</label>
              <input type="text" id="hotel_id_${i}" name="hotel_id_${i}" required>
            </div>
            <hr>
          `;
        }
        document.getElementById('day-wise-itinerary').innerHTML = html;
      }

      // Event listener to trigger the addition of day-wise itinerary fields
      document.getElementById('package_duration').addEventListener('change', function() {
        let numDurations = parseInt(this.value);
        if (numDurations > 0) {
          addDayWiseItineraryFields(numDurations);
        } else {
          document.getElementById('day-wise-itinerary').innerHTML = ''; // Clear if no valid input
        }
      });
    });
  </script>
</body>
</html>



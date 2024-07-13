<?php
session_start();
if (!isset($_SESSION['institute_name'])) {
   header("Location: home.php"); // Redirect to home.php
   exit; // Stop further execution
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle cancellation request
if (isset($_GET['action']) && $_GET['action'] === 'cancel' && isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Perform deletion query
    // Ensure to use prepared statement to prevent SQL injection
    $sql_delete = "DELETE FROM booking WHERE booking_id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("s", $booking_id); // "s" indicates the type of $booking_id is string

    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Booking cancelled successfully.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error cancelling booking: ' . $conn->error . '</div>';
    }

    $stmt->close();
}

// Retrieve user's bookings with package details
$institution_name = $_SESSION['institute_name'];
$sql = "SELECT b.booking_id, p.package_name, b.arrival_date, b.number_of_student, b.total_payment
        FROM booking b
        INNER JOIN package p ON b.package_id = p.package_id
        WHERE b.institution_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $institution_name);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Profile</title>
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* Custom CSS for login and register buttons */
      .navbar {
         display: flex;
         align-items: center;
      }

      .navbar a {
         margin-right: 20px;
         text-decoration: none;
         color: #fff;
      }

      /* Custom styles for table */
      .table {
         width: 100%;
         margin-bottom: 1rem;
         color: #212529;
         border-collapse: collapse;
         font-size: 16px; /* Increase font size */
      }

      .table th,
      .table td {
         padding: 12px; /* Increase padding for better spacing */
         vertical-align: middle;
         border-top: 1px solid #dee2e6;
      }

      .table thead th {
         vertical-align: middle;
         border-bottom: 2px solid #dee2e6;
         background-color: #f8f9fa;
         color: #6c757d;
      }

      .table tbody + tbody {
         border-top: 2px solid #dee2e6;
      }

      .table .btn {
         padding: .5rem .75rem; /* Adjust button padding */
         font-size: .875rem;
         line-height: 1.5;
         border-radius: .25rem;
      }

      .table-striped tbody tr:nth-of-type(odd) {
         background-color: rgba(0, 0, 0, 0.05);
      }

      /* Custom style for user name */
      .user-name {
         font-size: 24px; /* Larger font size */
         color: #BF40BF; /* Custom color */
      }

   </style>
   
   
</head>
<body>

<section class="header">
   <a href="index.php" class="logo" style="text-decoration:none;color:#279e8c;">Edu Trip</a>
   <nav class="navbar">
      <a href="index.php" style="text-decoration:none">home</a>
      <a href="about.php" style="text-decoration:none">about</a>
      <a href="package.php" style="text-decoration:none">package</a>
      <a href="faq.php" style="text-decoration:none">FAQ</a>
      
   </nav>
</section>

<section class="content">
   <div class="container mt-5">
      <div class="row">
         <div class="col-md-12">
            <h2>Your Bookings</h2>
            <h3 class="user-name">Welcome, <?php echo $_SESSION['institute_name']; ?></h3>
            <table class="table table-striped mt-4">
               <thead>
                  <tr>
                     <th>Booking ID</th>
                     <th>Trip Name</th>
                     <th>Date Booked</th>
                     <th>Number of Students</th>
                     <th>Total Amount</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $row['booking_id'] . "</td>";
                          echo "<td>" . $row['package_name'] . "</td>";
                          echo "<td>" . $row['arrival_date'] . "</td>";
                          echo "<td>" . $row['number_of_student'] . "</td>";
                          echo "<td>" . $row['total_payment'] . "</td>";
                          echo "<td><a href='profile.php?action=cancel&id=" . $row['booking_id'] . "' class='btn btn-danger'>Cancel</a></td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='6'>No bookings found.</td></tr>";
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>

<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="index.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="faq.php"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +91 9898305040 </a>
         <a href="#"> <i class="fas fa-phone"></i> +91 8160662390 </a>
         <a href="#"> <i class="fas fa-envelope"></i> edutrip@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> Ahmedabad, india - 382350 </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

<!--   <div class="credit"> created by <span>colledge students</span> | all rights reserved! </div>-->

</section>

<!-- footer section ends -->

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
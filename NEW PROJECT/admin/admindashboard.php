<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['AdminLoginId'])) {
    // Redirect to login page if not logged in
    header("Location: adminlogin.php");
    exit(); // Prevent further execution
}

// Fetch admin name from the session
$admin_name = $_SESSION['AdminLoginId'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from registration table
$registration_sql = "SELECT COUNT(*) as total FROM registration";
$registration_result = $conn->query($registration_sql);
$registration_row = $registration_result->fetch_assoc();
$total_users = $registration_row['total'];

// Fetch data from admin_login table
$admin_sql = "SELECT COUNT(*) as total FROM admin_login";
$admin_result = $conn->query($admin_sql);
$admin_row = $admin_result->fetch_assoc();
$total_admins = $admin_row['total'];

// Calculate guests (assuming guests are users who haven't registered)
$total_guests = $total_users + $total_admins;

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./css/admindashboard.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #3f51b5;
            color: #fff;
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .navigation {
            margin-top: 20px;
        }
        .nav-menu {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        .nav-menu li {
            margin: 0 15px;
        }
        .nav-menu li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 10px 15px; /* Add padding to create space between menu items */
            border-radius: 5px; /* Add rounded corners */
        }
        .nav-menu li a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Add background color on hover */
        }
        .content {
            flex: 1;
            display: flex;
            padding: 20px;
            justify-content: center;
            align-items: center;
        }
        .dashboard-widget {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            min-width: 300px;
        }
        .dashboard-widget h2 {
            margin-top: 0;
            color: #3f51b5;
            text-align: center;
        }
        .dashboard-widget canvas {
            width: 100%;
            height: auto;
        }
        .admin-name p {
            margin: 0; /* Remove default margin */
            transition: color 0.3s ease; /* Add transition effect */
        }
        .admin-name p:hover {
            color: #ffea00; /* Change text color on hover */
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Admin Panel</h1>
        </div>
        <div class="navigation">
            <ul class="nav-menu">
                <li><a href="adminviewjourneys.php">View all Journeys</a></li>
                <li><a href="adminviewusers.php">View Users</a></li>
                <li><a href="adminusers.php">View Admins</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="adminlogout.php">Logout</a></li> <!-- Logout button -->
            </ul>
        </div>
        <div class="admin-name">
            <p>Welcome, <?php echo $admin_name; ?></p>
        </div>
    </header>

    <div class="container">
        <div class="content">
            <div class="dashboard-widget">
                <h2>User Distribution</h2>
                <canvas id="userPieChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // JavaScript code for pie chart rendering
        var userPieData = {
            labels: ['Admins', 'Regular Users', 'Total Users'],
            datasets: [{
                data: [<?php echo $total_admins; ?>, <?php echo $total_users; ?>, <?php echo $total_guests; ?>],
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384']
            }]
        };

        var userPieCanvas = document.getElementById("userPieChart");
        var userPieChart = new Chart(userPieCanvas, {
            type: 'pie',
            data: userPieData
        });
    </script>
</body>
</html>
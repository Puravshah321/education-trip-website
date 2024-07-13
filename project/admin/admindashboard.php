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

// Fetch feedback data from feedback table
$feedback_sql = "SELECT feedback_rating FROM feedback";
$feedback_result = $conn->query($feedback_sql);

// Initialize an array to store feedback ratings
$feedback_ratings = [];

// Fetch all ratings and store in array
if ($feedback_result->num_rows > 0) {
    while ($row = $feedback_result->fetch_assoc()) {
        $feedback_ratings[] = $row['feedback_rating'];
    }
}

// Calculate average feedback rating
$average_rating = 0;
if (!empty($feedback_ratings)) {
    $average_rating = array_sum($feedback_ratings) / count($feedback_ratings);
}

// Fetch most booked packages data
$most_booked_sql = "
    SELECT package.package_name, COUNT(booking.package_id) as booking_count
    FROM booking
    JOIN package ON booking.package_id = package.package_id
    GROUP BY booking.package_id
    ORDER BY booking_count DESC
    LIMIT 5";
$most_booked_result = $conn->query($most_booked_sql);

// Initialize arrays to store package names and booking counts
$package_names = [];
$booking_counts = [];

// Fetch all data and store in arrays
if ($most_booked_result->num_rows > 0) {
    while ($row = $most_booked_result->fetch_assoc()) {
        $package_names[] = $row['package_name'];
        $booking_counts[] = $row['booking_count'];
    }
}

// Calculate rating distribution for feedback ratings
$feedback_rating_counts = array_count_values($feedback_ratings);

// Prepare data for pie chart
$pie_labels = [];
$pie_data = [];

// Define colors in order of star ratings
$star_colors = [
    '#FF6384', // 1 star
    '#36A2EB', // 2 star
    '#FFCE56', // 3 star
    '#4BC0C0', // 4 star
    '#9966FF'  // 5 star
];

foreach ($feedback_rating_counts as $rating => $count) {
    $pie_labels[] = "$rating star";
    $pie_data[] = $count;
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <style>
        /* Global Styles */
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
        .header {
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
            padding: 10px 15px;
            border-radius: 5px;
        }
        .nav-menu li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .content {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }
        .dashboard-widget {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            min-width: 300px;
            margin: 10px;
            flex: 1 1 300px; /* Responsive flexbox sizing */
        }
        .dashboard-widget h2 {
            margin-top: 0;
            color: #3f51b5;
            text-align: center;
            margin-bottom: 15px;
        }
        .dashboard-widget canvas {
            width: 100%;
            height: auto;
            max-width: 400px; /* Responsive max width for charts */
            margin: 0 auto; /* Center align */
        }
        .admin-name p {
            margin: 0;
            transition: color 0.3s ease;
            text-align: center;
            margin-bottom: 15px;
        }
        .admin-name p:hover {
            color: #ffea00;
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
                <!-- <li><a href="adminviewadmins.php">View Admins</a></li> -->
                <li><a href="#">Settings</a></li>
                <li><a href="adminlogout.php">Logout</a></li>
            </ul>
        </div>
        <div class="admin-name">
            <p>Welcome, <?php echo $admin_name; ?></p>
        </div>
    </header>

    <div class="container">
        <div class="dashboard-widget">
            <h2>Most Booked Packages</h2>
            <canvas id="mostBookedPackagesChart" width="400" height="200"></canvas>
        </div>

        <div class="dashboard-widget">
            <h2>Feedback Ratings Distribution</h2>
            <canvas id="feedbackRatingsChart" width="400" height="200"></canvas>
            <p style="text-align: center; font-size: 24px;">Average Feedback Rating: <?php echo number_format($average_rating, 2); ?></p>
        </div>

        
            
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // JavaScript for most booked packages chart
        var mostBookedData = {
            labels: <?php echo json_encode($package_names); ?>,
            datasets: [{
                label: 'Bookings',
                data: <?php echo json_encode($booking_counts); ?>,
                backgroundColor: '#ff6384',
                borderColor: '#ff6384',
                borderWidth: 1
            }]
        };

        var mostBookedCanvas = document.getElementById("mostBookedPackagesChart");
        var mostBookedChart = new Chart(mostBookedCanvas, {
            type: 'bar',
            data: mostBookedData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });

        // JavaScript for feedback ratings pie chart
        var feedbackData = {
            labels: <?php echo json_encode($pie_labels); ?>,
            datasets: [{
                data: <?php echo json_encode($pie_data); ?>,
                backgroundColor: [
                    '<?php echo $star_colors[0]; ?>', // 1 star
                    '<?php echo $star_colors[1]; ?>', // 2 star
                    '<?php echo $star_colors[2]; ?>', // 3 star
                    '<?php echo $star_colors[3]; ?>', // 4 star
                    '<?php echo $star_colors[4]; ?>'  // 5 star
                ],
                hoverBackgroundColor: [
                    '<?php echo $star_colors[0]; ?>',
                    '<?php echo $star_colors[1]; ?>',
                    '<?php echo $star_colors[2]; ?>',
                    '<?php echo $star_colors[3]; ?>',
                    '<?php echo $star_colors[4]; ?>'
                ]
            }]
        };

        var feedbackCanvas = document.getElementById("feedbackRatingsChart");
        var feedbackChart = new Chart(feedbackCanvas, {
            type: 'pie',
            data: feedbackData,
            options: {}
        });
    </script>
</body>
</html>
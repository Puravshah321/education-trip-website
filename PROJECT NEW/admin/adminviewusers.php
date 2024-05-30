<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database
$sql = "SELECT * FROM registration";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ffffff, #e0e0e0); /* Brighter gradient background color */
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: #333; /* Dark text color */
        }

        table {
            width: 80%; /* Adjusted width */
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff; /* White table background color */
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #333; /* Dark text color */
        }

        th {
            background-color: #f2f2f2; /* Light gray header background color */
        }

        tr:hover {
            background-color: #f4f4f4; /* Light gray hover background color */
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

        /* Decorative elements */
        .decorative-element {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .decorative-element::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.3;
        }
    </style>
</head>
<body>

<h1>User Database</h1>

<div class="go-back">
    <a href="admindashboard.php">&laquo; Go Back</a>
</div>

<table>
    <thead>
        <tr>
            <th>Institute ID</th>
            <th>Institute Name</th>
            <th>Institute Email</th>
            <th>Institute Address</th>
            <th>Phone Number</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['institute_id']; ?></td>
                <td><?php echo $row['institute_name']; ?></td>
                <td><?php echo $row['institute_email']; ?></td>
                <td><?php echo $row['institute_address']; ?></td>
                <td><?php echo $row['institute_phone_number']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Decorative elements -->
<div class="decorative-element"></div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>

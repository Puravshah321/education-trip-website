<?php
   session_start();

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
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Itinerary</title>
    <link rel="stylesheet" href="styles.css">


	<style>

.user-icon {
   color: #8a2be2; /* Darker purple color for the user icon */
   font-size: 24px;
   text-decoration: none;
   transition: color 0.3s ease; /* Smooth transition for color change */
}

.user-icon:hover {
   color: #6a0dad; /* Lighter purple color on hover */
}

.dropdown-menu {
   min-width: 160px;
   padding: 10px 0; /* Padding inside the dropdown menu */
   border-radius: 5px; /* Rounded corners for the dropdown */
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a slight elevation */
   background-color: #fff; /* White background color */
   position: absolute;
   top: 50px; /* Adjust this value to position the dropdown vertically */
   right: 0; /* Adjust this value to position the dropdown horizontally */
   z-index: 1; /* Ensure the dropdown appears above other elements */
}

.dropdown-item {
   color: #333; /* Text color for dropdown items */
   font-size: 14px;
   text-decoration: none;
   display: block;
   padding: 8px 16px; /* Padding inside each dropdown item */
   transition: background-color 0.3s ease; /* Smooth transition for background color */
}

.dropdown-item:hover {
   background-color: #f0f0f0; /* Light grey background color on hover */
   color: #6a0dad; /* Change text color on hover */
}

.dropdown-divider {
   margin: 5px 0; /* Margin for the divider line */
   border-top: 1px solid #ccc; /* Divider line color */
}

.dropdown-item-text {
   font-size: 14px;
   color: #8a2be2; /* Purplish color for user name */
   font-weight: bold; /* Bold font weight for user name */
}

.dropdown-menu .dropdown-item {
   white-space: nowrap; /* Prevent text wrapping */
}

.dropdown-menu a {
   display: block;
   padding: 8px 16px;
   color: #333;
   text-decoration: none;
   transition: background-color 0.3s ease;
}

.dropdown-menu a:hover {
   background-color: #f0f0f0;
   color: #6a0dad;
}

.dropdown-menu .dropdown-item-text {
   color: #8a2be2;
}
body {
    background-color: bisque;
    margin: 0;
    padding: 0;
}

.itinerary-container {
    max-width: 1800px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
   <-- box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);-->
}

h1, h2, h3 {
    color: #333;
}

.day {
    margin-bottom: 30px;
}

.activities {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.activity {
    width: calc(50% - 20px); /* Set width to half of the container */
    margin-bottom: 20px;
    box-sizing: border-box; /* Ensure padding and border are included in the width */
    float: left; /* Float the activities left */
}


.day::after {
    content: "";
    display: table;
    clear: both;
}

.image-container {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    height: 400px; /* Set a fixed height for the image container */
    width: 700px;
}

.image-container img {
    width: 100%;
    height: 100%; /* Ensure the image fills the container */
    object-fit: cover; /* Cover the container with the image */
    transition: transform 0.3s ease;
}

.image-container:hover img {
    transform: scale(1.1); /* Scale up the image on hover */
}

.details {
    padding: 20px;
}

.details h3 {
    margin-top: 0;
}

.details p {
    margin-bottom: 0;
}

.navbar {
         display: flex;
         align-items: center;
      }

      .navbar a {
         margin-right: 20px;
         text-decoration: none;
         color: #fff;
      }

.heading h1{
    animation: fadeInUp 1s ease;
}

    @keyframes fadeInUp{
        from{
            opacity:0;
            transform:translateY(20px);
        }
        to{
            opacity:1;
            transform:translateY(0px);

        }
    }

	</style>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>	
<body>

<section class="header">
   <a href="index.php" class="logo" style="text-decoration:none;color:#279e8c;">Edu Trip</a>
   <nav class="navbar">
      <a href="index.php" style="text-decoration:none">home</a>
      <a href="about.php" style="text-decoration:none">about</a>
      <a href="package.php" style="text-decoration:none">package</a>
     
      <a href="faq.php" style="text-decoration:none">FAQ</a>
      <!-- <a href="#" style="text-decoration:none">Feedback</a> -->
      <div class="user-dropdown">
            <a href="#" class="user-icon" id="userDropdown" role="button" data-bs-toggle="dropdown"
               aria-expanded="false">
               <i class="fas fa-user" style="color:purple;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
               <li><span class="dropdown-item-text">Hello, <?php echo $_SESSION['institute_name']; ?></span></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="#">Profile</a></li>
               <li><a class="dropdown-item" href="#">Settings</a></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
         </div>
      <div class="login-register">
      </div>
   </nav>
   

   
</section>

<div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
   <h1>Tour Itinerary</h1>
</div>


    <div class="itinerary-container">
        <h1><center>ITINERARY</center></h1>
        <?php include 'itinerary_data.php'; ?>
            <div class="day">
            <?php
                    // Fetch images from the images table based on matching image_id from the itinerary table
                    $p_id = $_GET["package_id"];
                    $i_query = "SELECT images_id FROM itinerary WHERE package_id='$p_id'";
                    $i_result = $conn->query($i_query);

                    // Check if there are images to display
                    if ($i_result && $i_result->num_rows > 0) {
                        $row = $i_result->fetch_assoc();
                        $images_id = $row['images_id']; // Assuming 'images_id' is the column name in the 'itinerary' table
                    
                        // Now use $images_id in the second query
                        $image_query = "SELECT * FROM images WHERE image_id = '$images_id'";
                        $image_result = $conn->query($image_query);
                        $row=$image_result->fetch_assoc();
                        for ($i = 1; $i <= 4; $i++) {
                            $image_path = $row['image_path_'.$i];
                            if (!empty($image_path)) {
                                echo '<div class="activity">';
                                echo '<div class="image-container">';
                                echo '<img src="' . $image_path . '" alt="Image">';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                    }
                     else {
                        // No images found
                        echo "No images found for this itinerary.";
                    }
    ?>
            </div>
			<?php	$p_id = $_GET["package_id"];?>
		<center><a href="book.php?package_id=<?php echo $p_id; ?>" class="btn">book now</a></center>
    </div>

	<section class="footer">
    <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
         <a href="book.php"> <i class="fas fa-angle-right"></i> book</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
         <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
         <a href="#"> <i class="fas fa-envelope"></i> shaikhanas@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> mumbai, india - 400104 </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <div class="credit"> created by <span>mr. web designer</span> | all rights reserved! </div>

</section>

</body>
</html>


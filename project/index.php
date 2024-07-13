<?php
   session_start();
//    if (!isset($_SESSION['institute_name'])) {
//       header("Location: home.php"); // Redirect to home.php
//       exit; // Stop further execution
//   }
   // Database configuration
   $servername = "localhost"; // Change this if your database is hosted elsewhere
   $username = "root"; // Your MySQL username
   $password = ""; // Your MySQL password
   $database = "project"; // Your database name

   // Create connection
   $conn = new mysqli($servername, $username, $password, $database);   
   $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


   <title>index</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- bootstrap Css Link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

      .user-dropdown {
   position: relative;
   display: inline-block;
   margin-left: 20px;
}

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

.background {
   background-color: #000;
   
}


.packages .box-container {
   display: flex;
   flex-wrap: wrap;
   gap: 32px; /* Optional: adds space between boxes */
}

.packages .box-container .box {
   width: 385px; /* Define a static width for the boxes */
   height: 550px; /* Define a static height for the boxes */
   box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

.packages .box-container .box .image {
   width: 100%;
   height: 67%; /* Define height for the image container */
   overflow: hidden; /* Hide any overflow content */
}

.packages .box-container .box .image img {
   width: 50%;
   height: 80%;
   object-fit: cover; /* Cover the entire container, preserving aspect ratio */
}

.packages .box-container .box .content {
   height: 30%; /* Define height for the content container */
   /*  padding: 10px; Optional: adds padding inside the content box */
}

.packages .box-container .box .content form {
   display: flex;
   gap: 2px; /* Space between form elements */
}

</style>

</head>
<body>

<!-- header section starts  -->

<section class="header">
   <a href="index.php" class="logo" style="text-decoration:none;color:#279e8c;">Edu Trip</a>
   <nav class="navbar">
      <a href="index.php" style="text-decoration:none">home</a>
      <a href="about.php" style="text-decoration:none">about</a>
      <a href="package.php" style="text-decoration:none">package</a>
      <!-- <a href="book.php" style="text-decoration:none">book</a> -->
      <a href="faq.php" style="text-decoration:none">FAQ</a>
      <!-- <a href="#" style="text-decoration:none">Feedback</a> -->
      <div class="user-dropdown">
            <a href="#" class="user-icon" id="userDropdown" role="button" data-bs-toggle="dropdown"
               aria-expanded="false">
               <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
               <li><span class="dropdown-item-text">Hello, <?php echo $_SESSION['institute_name']; ?></span></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="profile.php">Your Bookings</a></li>
               <li><a class="dropdown-item" href="#">Settings</a></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
         </div>
      <div class="login-register">
      </div>
   </nav>
   

   
</section>

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(images/home-slide-4.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Where Education Meets Adventure</h3>
               <a href="package.php" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-11.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Learning Beyond the Classroom</h3>
               <a href="package.php" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-5.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Cultivating Curiosity and Discovery</h3>
               <a href="package.php" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-10.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Wander and Learn</h3>
               <a href="package.php" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>
         <div class="swiper-slide slide" style="background:url(images/home-slide-12.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Journey to Knowledge</h3>
               <a href="package.php" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>
         
      </div>

      <!-- Add Pagination -->
      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- home section ends -->

<!-- services section starts  -->

<section class="services">

   <h1 class="heading-title"> our services </h1>

   <div class="box-container">

      <div class="box">
         <img src="images/icon-1.png" alt="">
         <h3>adventure</h3>
      </div>

      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>tour guide</h3>
      </div>

      <div class="box">
         <img src="images/icon-3.png" alt="">
         <h3>trekking</h3>
      </div>

      <div class="box">
         <img src="images/icon-4.png" alt="">
         <h3>camp fire</h3>
      </div>

      <div class="box">
         <img src="images/icon-5.png" alt="">
         <h3>off road</h3>
      </div>

      <div class="box">
         <img src="images/icon-6.png" alt="">
         <h3>camping</h3>
      </div>
   </div>

</section>

<!-- services section ends -->

<!-- home about section starts  -->

<section class="home-about">

   <div class="image">
      <img src="images/about-img1.jpeg" alt="">
   </div>

   <div class="content">
      <h3>about us</h3>
      <p>At Edu Trip, we believe that education extends far beyond the confines of a classroom. We are passionate about providing enriching experiences that inspire, educate, and broaden horizons. With years of expertise in educational travel, we are committed to offering exceptional journeys that foster personal growth, cultural understanding, and lifelong learning.

Our mission is simple: to ignite curiosity and cultivate a deeper appreciation for the world around us. </p>
<a href="about.php" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">Read more</a>
           
   </div>

</section>

<!-- home about section ends -->

<!-- home packages section starts  -->


<!-- packages section starts -->

<section class="packages">
   <h1 class="heading-title">top destinations</h1>
   <div class="box-container">

   <?php
// Establish a connection to the database
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "project"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3; // Number of reviews per page
$start = ($page - 1) * $limit;

// Fetch reviews from the database with pagination
$sql = "SELECT * FROM package LIMIT $start, $limit";
$result = $conn->query($sql);
// SQL query to fetch package records from the database
// $sql = "SELECT * FROM package";
// $result = $conn->query($sql);

// Check if there are records in the result set
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Output HTML for each package
        $imagePath = $row['image_id']; // Assuming image_id contains the path to the image
        $imageSize = getimagesize($imagePath);
        $imageWidth = 400;
        $imageHeight = 350;

        // Output HTML for each package
        echo '<div class="box">';
        echo '<div class="image">';
        echo '<img src="' . $imagePath . '" alt="" style="width: ' . $imageWidth . 'px; height: ' . $imageHeight . 'px;">';
        echo '</div>';
        echo '<div class="content">';
        echo '<h3>' . $row['package_name'] . '</h3>';
        echo '<p>Price: Rs.' . $row['package_price'] . '</p>';
        echo '<form>';
        echo '<style>
        .btn{
         display: inline-block;
         background: var(--black);
         margin-top: 1rem;
         color:var(--white);
         font-size: 1.7rem;
         padding:1rem 3rem;
         cursor: pointer;
      }
      
      .btn:hover{
         background: var(--main-color);
      }
      </style>';

echo '<a href="itinerary.php?package_id=' . $row['package_id'] . '" class="btn">More Details</a>';

        echo '<select class="dropdown">';
        echo '<option value="" disabled selected>' . $row['package_date1'] . '</option>';
        echo '<option value="" disabled selected>' . $row['package_date2'] . '</option>';
        echo '<option value="" disabled selected>' . $row['package_date3'] . '</option>';
        echo '<option value="" disabled selected>View Dates</option>';
        // echo '<option value="' . $row['package_date1'] . '">' . $row['package_date1'] . '</option>';
        // echo '<option value="' . $row['package_date2'] . '">' . $row['package_date2'] . '</option>';
        // echo '<option value="' . $row['package_date3'] . '">' . $row['package_date3'] . '</option>';
        echo '</select>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
    }
}
$conn->close();
?>
</div>
</section>
<div style="text-align: center;">
    <a href="package.php" class="btn" style="color: white;">Load more packages</a>
</div>

<!-- home packages section ends -->

<!-- home offer section starts  -->

<section class="home-offer">
   <div class="content">
      <!-- <h3>upto 50% off</h3> -->
      <p>Upcoming Offers will be there soon</p>
      <!-- <a href="#" class="btn">book now</a> -->
   </div>
</section>

<!-- home offer section ends -->

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

<!-- footer section ends -->


<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Initialize swiper for the carousel
    var swiper = new Swiper(".home-slider", {
        pagination: {
            el: ".swiper-pagination",
        },
        loop: true,
        autoplay: {
            delay: 3000, // 3 seconds delay between slides
            disableOnInteraction: false,
        },
    });
});
</script>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
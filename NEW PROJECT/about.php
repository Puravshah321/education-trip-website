
<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- Pagination CSS -->
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

      .pagination {
         margin-top: 20px;
         text-align: center;
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .pagination-link {
         display: inline-block;
         padding: 8px 16px;
         margin: 0 5px;
         color: #333;
         border: 1px solid #333;
         border-radius: 5px;
         text-decoration: none;
         transition: background-color 0.3s, color 0.3s;
      }

      .pagination-link:hover,
      .pagination-link.active {
         background-color: #333;
         color: #fff;
      }

      /* Pagination animation */
      @keyframes pulse {
         0% {
            transform: scale(1);
         }
         50% {
            transform: scale(1.1);
         }
         100% {
            transform: scale(1);
         }
      }

      .pagination-link:hover,
      .pagination-link.active {
         animation: pulse 0.5s ease-in-out infinite alternate;
      }

      .navbar {
         display: flex; /* Use flexbox to align items */
         align-items: center; /* Align items vertically in the center */
      }

      .navbar a {
         margin-right: 20px; /* Add margin between navbar links */
         text-decoration: none;
         color: #fff;
      }

      .background {
         background-color: #000;
      }

      .heading h1 {
         animation: fadeInUp 1s ease;
      }

      @keyframes fadeInUp {
         from {
            opacity: 0;
            transform: translateY(20px);
         }
         to {
            opacity: 1;
            transform: translateY(0px);
         }
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

<!-- header section ends -->

<div class="heading" style="background:url(images/header-bg-1.png) no-repeat">
   <h1>about us</h1>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="image">
      <img src="images/about-img2.jpeg" alt="">
   </div>

   <div class="content">
      <h3>why choose us?</h3>
      <p>At Edu Trip, we believe that education extends far beyond the confines of a classroom. We are passionate about providing enriching experiences that inspire, educate, and broaden horizons. With years of expertise in educational travel, we are committed to offering exceptional journeys that foster personal growth, cultural understanding, and lifelong learning.

Our mission is simple: to ignite curiosity and cultivate a deeper appreciation for the world around us. </p>
      <div class="icons-container">
         <div class="icons">
            <i class="fas fa-map"></i>
            <span>top destinations</span>
         </div>
         <div class="icons">
            <i class="fas fa-hand-holding-usd"></i>
            <span>affordable price</span>
         </div>
         <div class="icons">
            <i class="fas fa-headset"></i>
            <span>24/7 guide service</span>
         </div>
      </div>
   </div>

</section>

<!-- about section ends -->

<!-- reviews section starts  -->
<?php
// Establish a connection to the database
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "project"; // Change this to your database name

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
$sql = "SELECT * FROM feedback LIMIT $start, $limit";
$result = $conn->query($sql);

?>

<section class="reviews">

   <h1 class="heading-title">FEEDBACKS</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <?php
         // Output each review
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 ?>
                 <div class="swiper-slide slide">
                    <div class="stars">
                       <?php
                       // Output stars based on the rating
                       $stars = $row["feedback_rating"];
                       for ($i = 0; $i < $stars; $i++) {
                           echo '<i class="fas fa-star"></i>';
                       }
                       ?>
                    </div>
                    <p><?php echo $row["remarks"]; ?></p>
                    <!-- <h3><?php// echo $row["feedback_id"]; ?></h3>
                    <span><?php //echo $row["customer_id"]; ?></span> -->
                    <!-- <img src="//<?php// echo $row["image"]; ?>" alt=""> -->
                 </div>
                 <?php
             }
         } else {
             echo "No reviews found.";
         }
         ?>

      </div>

   </div>

   <!-- Pagination links -->
   <div class="pagination">
       <?php
       $sql_total = "SELECT COUNT(*) AS total FROM feedback";
       $result_total = $conn->query($sql_total);
       $row_total = $result_total->fetch_assoc();
       $total_pages = ceil($row_total["total"] / $limit);

       // Previous page link
       if ($page > 1) {
           echo '<a href="?page='.($page - 1).'" class="pagination-link">&laquo; Previous</a>';
       }

       // Page numbers
       for ($i = 1; $i <= $total_pages; $i++) {
           echo '<a href="?page='.$i.'" class="pagination-link';
           if ($i == $page) {
               echo ' active';
           }
           echo '">'.$i.'</a>';
       }

       // Next page link
       if ($page < $total_pages) {
           echo '<a href="?page='.($page + 1).'" class="pagination-link">Next &raquo;</a>';
       }
       ?>
   </div>

</section>

<?php
// Close database connection
$conn->close();
?>

<!-- reviews section ends -->

<!-- footer section starts  -->

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
         <a href="#"> <i class="fas fa-envelope"></i> abc@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> Ahmedabad, India - 380007 </a>
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

<!-- footer section ends -->

<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
```

In this version, the pagination links are centered using the `flexbox` properties `display: flex;`, `justify-content: center;`, and `align-items: center;` in the `.pagination` class.

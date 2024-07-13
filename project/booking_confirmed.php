
<?php
   session_start();
   if (!isset($_SESSION['institute_name'])) {
      header("Location: home.php"); // Redirect to home.php
      exit; // Stop further execution
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Book Now</title>

   <!--Swiper CSS link -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .navbar {
         display: flex;
         align-items: center;
      }

      .navbar a {
         margin-right: 20px;
         text-decoration: none;
         color: #fff;
      }

      .background {
         background-color: #000;
      }
      
      .error {
         color: #FF0000;
      }

      .heading h1 {
         animation: fadeInUp 1s ease;
      }

      .captcha{
         width:20%;
         height: 42%;
         background: black;
         color: white;
         text-align: center;
         font-size: 30px;
         margin-top: 17px;
         font-weight: 300;
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

      /* CSS for Student Registration Form */
      .student-title {
         font-size: 45px;
         font-weight: bold;
         margin-top: 35px;
         margin-bottom: 20px;
      }

      .book-form {
         margin-top: 20px;
      }

      .flex1 {
         display: flex;
         flex-wrap: wrap;
      }

      .student-info {
         margin-bottom: 10px;
         width: 100%;
      }

      .student-number {
         font-size: 18px;
         margin-right: 10px;
      }

      .student-heading {
         width: 33.33%; /* Adjust width based on your layout */
         font-weight: bold;
         padding: 8px;
         background-color: #f2f2f2;
         text-align: center;
         font-size: 25px;
         margin-right: 30%; /* Adds spacing between headings */
      }

      .student-heading:last-child {
         margin-right: 0; /* Remove right margin from the last heading */
      }
      .student-name,
      .student-age,
      .guardian-num {
         width: 31%; /* Adjust based on your layout preference */
         padding: 8px;
         border: 1px solid #ccc;
         border-radius: 4px;
         margin-right: 10px;
         margin-bottom: 10px;
         font-size: 16px;
         align: center;
      }

      .student-name:focus,
      .student-age:focus,
      .guardian-num:focus {
         outline: none;
         border-color: #279e8c; /* Highlight color on focus */
      }

      .student-name::placeholder,
      .student-age::placeholder,
      .guardian-num::placeholder {
         color: #999; /* Placeholder text color */
      }

      .btnsub {
         background-color: #279e8c;
         color: white;
         padding: 10px 20px;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         margin-top: 20px;
         font-size: 16px;
      }

      .btnsub:hover {
         background-color: #207c6b; /* Darker shade on hover */
      }

      .error-message {
         color: #ff0000;
         font-size: 14px;
         margin-top: 5px;
      }

   </style>

</head>
<body>
<?php
   $rand = rand(9999,1000);
?>   
<section class="header">
   <a href="index.php" class="logo" style="text-decoration:none;color:#279e8c;">Edu Trip</a>
   <nav class="navbar">
      <a href="index.php" style="text-decoration:none">home</a>
      <a href="about.php" style="text-decoration:none">about</a>
      <a href="package.php" style="text-decoration:none">package</a>
      <!-- <a href="book.php" style="text-decoration:none">book</a> -->
      <a href="faq.php" style="text-decoration:none">FAQ</a>
      <h1 style="color:#A020F0;margin: 0px 0px 0px 20px;font-size:24px;">Hello, <?php echo $_SESSION['institute_name'];?></h1>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>
</section>


<div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
   <h1>BOOKING CONFIMED!</h1>
</div>
<?php	$p_id = $_SESSION['package_id'];?>
<div class="">
<center>
  <h1 style="font-family: Arial, sans-serif; color: #333; text-align: center;">
    Thank You for Booking a Trip with Us! 
    <br></br>
    <a href="receipt.php?package_id=<?php echo $p_id; ?>" style="color: #007BFF; text-decoration: none; margin: 0 10px;">
      View Receipt
    </a>
    OR
    <a href="index.php" style="color: #007BFF; text-decoration: none; margin: 0 10px;">
      Go to Home Page
    </a>
  </h1>
</center>

</div>


</section>

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

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
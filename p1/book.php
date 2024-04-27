<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>book</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* Custom CSS for login and register buttons */
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

   </style>

</head>
<body>
   
<!-- header section starts  -->

<section class="header">

<a href="home.php" class="logo" style="text-decoration:none;color:#279e8c;">Edu Trip</a>
   <nav class="navbar">
      <a href="home.php" style="text-decoration:none">home</a>
      <a href="about.php" style="text-decoration:none">about</a>
      <a href="package.php" style="text-decoration:none">package</a>
      <a href="book.php" style="text-decoration:none">book</a>
      <h1 style="color:#A020F0;margin: 0px 0px 0px 20px;font-size:24px;">Hello,<?php echo $_SESSION['institute_name'];?></h1>
      <div class="login-register">
      </div>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<!-- header section ends -->

<div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
   <h1>book now</h1>
</div>

<!-- booking section starts  -->

<section class="booking">

   <h1 class="heading-title">book your trip!</h1>

   <form method="post" class="book-form">

      <div class="flex">
         <div class="inputBox">
            <span>name :</span>
            <input type="text" placeholder="Enter your name" name="name">
         </div>
         <div class="inputBox">
            <span>email :</span>
            <input type="email" placeholder="Enter your email" name="email">
         </div>
         <div class="inputBox">
            <span>phone :</span>
            <input type="number" placeholder="Enter Your Phone number" name="phone">
         </div>
         <div class="inputBox">
            <span>address :</span>
            <input type="text" placeholder="enter your address" name="address">
         </div>
         <div class="inputBox">
            <span>Package Name:</span>
            <input type="text" placeholder="Package Name" name="location">
         </div>
         <div class="inputBox">
            <span>Number of Students:</span>
            <input type="number" placeholder="Enter number of Students" name="guests">
         </div>
         <div class="inputBox">
            <span>Arrivals Dates:</span>
            <input type="date" name="arrivals">
         </div>
         <div class="inputBox">
            <span>Leaving Dates:</span>
            <input type="date" name="leaving">
         </div>
         <center><span>-- Upload Students Consent here --</span>
            <input type="file" name="s_consent"></center>
      </div>

      <input type="submit" value="submit" class="btnsub" name="send">
   </form>
   <br>
   <br>
   <!-- <h1 class="student-title">Student's Registration :</h1> -->
         <?php
            if(isset($_POST["send"]))
            {
               $number_of_students=$_POST["guests"];
               if($number_of_students > 0 && $number_of_students < 40)
               {
                  echo "<h1 class='student-title'>Student Registration:</h1>";
                  for($i = 1;$i <= $number_of_students;$i++)
                  {
         ?>
                     <form method="post" class="book-form">
                     <div class="flex1">
                        <div class="inputBox">
                        <span style="font-size: 23px;"><?php echo $i . " .)" ?></span>
                           <!-- <span>Student Name:</span> -->
                           <input type="text" placeholder="Student Name" name="s_name<?php.$i.?>">
                           <!-- <span>Student Age:</span> -->
                           <input type="number" placeholder="Student Age" name="s_number<?php.$i.?>">
                           <!-- <span>Guardian's Phone Number:</span> -->
                           <input type="text" placeholder="Student Phone Number" name="s_number<?php.$i.?>">
                        </div>
                     </div>
                     
         <?php
                  }
         ?>
         <input type="submit" name="stu_submit" class="btnsub" value="Submit"/>
         </form>
         <?php
               }
               else
               {
                  echo "Enter Valid Data.";
               }
            }   
         ?>
   </div>
</section>

<!-- booking section ends -->

















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



</section>

<!-- footer section ends -->









<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
<?php
session_start();
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

$emailErr = $pwdErr = $nameErr = $pnoerr = "";

// Registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $institute_name = $_POST['institute_name'];
    $email = $_POST['institute_email']; // Corrected field name
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    $uploadok = 1;

    if(strlen($phone_number)>10 || strlen($phone_number)<10)
    {
        $pnoerr = "Number should be only of 10 digits.";
        $uploadok = 0;
    }

    if (empty($institute_name)) {
        $nameErr = "Name Required";
        $uploadok = 0;
    } else {
      $institute_name = $_POST['institute_name'];
        $uploadok = 1;
        if (!preg_match("/^[a-zA-Z-' ]*$/", $institute_name)) {
            $nameErr = "Only letters and white space allowed";
            $uploadok = 0;
        }
    }

    if (empty($email)) {
        $emailErr = "Email is required";
        $uploadok = 0;
    } else {
         $email = $_POST['institute_email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $uploadok = 0;
        }
    }

    if ($confirm_password != $password) {
        $pwdErr = "Passwords do not match";
        $uploadok = 0;
    }


    if ($uploadok == 1) {
      //   $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO registration (institute_name, institute_email, institute_password, institute_address, institute_phone_number)
                VALUES ('$institute_name', '$email', '$password', '$address', '$phone_number')";

        if ($conn->query($sql) === TRUE) {
            // header("Location: index.php");
            // exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
   $name = $_POST['institute_name'];
   $password = $_POST['password'];

   // Prepare and bind parameters
   $query = "SELECT * FROM registration WHERE institute_name = '$name' and institute_password='$password'";
   $result = mysqli_query($conn,$query);

   if(mysqli_num_rows($result) === 1) 
   {       
           // Store data in session variables
           $_SESSION['loggedin'] = true;
           $_SESSION['institute_name'] = $name;
           $_SESSION['institute_id'] = $id;
           
           // Redirect user to index page
           header("Location: index.php");
           exit;
   } 
   else 
   {
      $loginErr =  "Invalid email or password.";
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


   <title>home</title>

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
   display: flex; /* Use flexbox to align items */
   align-items: center; /* Align items vertically in the center */
}

.navbar a {
   margin-right: 20px; /* Add margin between navbar links */
   text-decoration: none;
   color: #fff;
}

.navbar .login-register {
   margin-left: auto;
}

.navbar .login-register button {
   color: white;
   background-color: black;
   border: none;
   cursor: pointer;
   font-size: 16px;
   margin-left: 20px;
   padding: 10px 20px;
   transition: background-color 0.3s ease;
}

.navbar .login-register button:hover {
   background-color: #279e8c;
}

.background {
   background-color: #000;  
}

.error {
   color: #FF0000;
}



        .packages .box-container {
                display: flex;
                flex-wrap: wrap;
                gap: 32px; /* Optional: adds space between boxes */
            }

        .packages .box-container .box {
            width: 380px; /* Define a static width for the boxes */
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

        .responsive-image {
            max-width: auto;
            height: 100%;
        }
   </style>

</head>
<body>

<!-- header section starts  -->

<section class="header">
   <a href="index.php" class="logo" style="text-decoration:none;color:#279e8c;">Edu Trip</a>
   <nav class="navbar">
      <a href="#" onclick="openRegisterModal()" style="text-decoration:none">home</a>
      <a href="#" onclick="openRegisterModal()"style="text-decoration:none">about</a>
      <a href="#" onclick="openRegisterModal()"style="text-decoration:none">package</a>
      <!-- <a href="#" onclick="openRegisterModal()" style="text-decoration:none">book</a> -->
      <a href="#" onclick="openRegisterModal()" style="text-decoration:none">FAQ</a>
      <div class="login-register">
      <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#LoginModal">
                Login
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#RegisterModal">
                Register
                </button>
      </div>
   </nav>
   

   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<!-- header section ends -->


    <!-- Register Trigger Modal -->
      <div class="modal fade" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                        <i class="fa-solid fa-users-line fs-3 me-2"></i> User Registration <!-- Updated title -->
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Institute Name</label>
                                <input type="text" name="institute_name" class="form-control shadow-none" placeholder="Enter Institution Name">
                                <span class="error">* <?php echo $nameErr;?></span>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="institute_email" class="form-control shadow-none" placeholder="Enter Your Email">
                                <span class="error">* <?php echo $emailErr;?></span>
                            </div>
                            
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control shadow-none" placeholder="Enter Your Password">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control shadow-none" placeholder="Confirm Your Password">
                                <span class="error">* <?php echo $pwdErr;?></span>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control shadow-none" name="address" placeholder="Enter Your Address" rows="1"></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="phone_number"class="form-control shadow-none" placeholder="Enter Your Phone Number">
                                <span class="error">* <?php echo $pnoerr;?></span>
                            </div>
                            
                           
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" name="register" class="btn btn-dark shadow-none">Register</button> 
                        </div>
                    </div>

                    </div>
                </form>
            </div>
        </div> 
    </div>

    <!-- Button Trigger Modal -->
     <div class="modal fade" id="LoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
               <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="fa-solid fa-circle-user fs-3 me-2"></i> User Login
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">username</label>
                            <input type="text" name="institute_name" class="form-control shadow-none" placeholder="Enter Username">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control shadow-none" placeholder="Enter Your Password">
                            <!-- <span class="error">* <?php //echo $loginErr;?></span> -->
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2" >
                            <button type="submit" name="login" class="btn btn-dark shadow-none">Login</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- home section starts  -->

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(images/home-slide-4.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Where Education Meets Adventure</h3>
               <a href="#" onclick="openRegisterModal()" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-11.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Learning Beyond the Classroom</h3>
               <a href="#" onclick="openRegisterModal()" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-5.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Cultivating Curiosity and Discovery</h3>
               <a href="#" onclick="openRegisterModal()" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-12.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Wander and Learn</h3>
               <a href="#" onclick="openRegisterModal()" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-10.jpeg) no-repeat">
            <div class="content">
               <span>Explore, Learn, Grow</span>
               <h3>Journey to Knowledge</h3>
               <a href="#" onclick="openRegisterModal()" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">discover more</a>
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

<!-- home about section starts  -->

<section class="home-about">

   <div class="image">
      <img src="images/about-img1.jpeg" alt="">
   </div>

   <div class="content">
      <h3>about us</h3>
      <p>At Edu Trip, we believe that education extends far beyond the confines of a classroom. We are passionate about providing enriching experiences that inspire, educate, and broaden horizons. With years of expertise in educational travel, we are committed to offering exceptional journeys that foster personal growth, cultural understanding, and lifelong learning.

    Our mission is simple: to ignite curiosity and cultivate a deeper appreciation for the world around us. </p>
    <a href="#" onclick="openRegisterModal()" class="btn" style="color: white; text-decoration: none; padding: 5px 10px; border: 1px solid black; border-radius: 3px;font-size:20px;background-color:black;height:40px; width:200px;">Read more</a>
            
   </div>

</section>

<!-- home about section ends -->


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

// Check if user is logged in
// if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
//     // User is not logged in, restrict access to more details
//     $buttonLink = 'javascript:void(0);'; // Disable button
// } 


// Check if there are records in the result set
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Output HTML for each package
        $imagePath = $row['image_id']; // Assuming image_id contains the path to the image
        $imageSize = getimagesize($imagePath);
        $imageWidth = $imageSize[0];
        $imageHeight = $imageSize[1];

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
         font-size: 1.6rem;
         padding:1rem 3rem;
         cursor: pointer;
      }
      
      .btn:hover{
         background: var(--main-color);
      }
      </style>';
        echo '<a href="#" onclick="openRegisterModal()" class="btn">More Details</a>';
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
<!-- home packages section ends -->
<div style="text-align: center;">
        <a href="#" onclick="openRegisterModal()" class="btn" style="color: white;">Load more packages</a>
    </div>

<!-- home offer section starts  -->
<br>
<section class="home-offer">
   <div class="content">
      <h1 class="heading-title"> OFFERS </h1>
      <p> Will be updated soon</p>
      <!-- <a href="#" onclick="openRegisterModal()" class="btn">book now</a> -->
   </div>
</section>

<!-- home offer section ends -->

<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

   <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="#" onclick="openRegisterModal()" > <i class="fas fa-angle-right"></i> about</a>
         <a href="#"onclick="openRegisterModal()" > <i class="fas fa-angle-right"></i> package</a>
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

function openRegisterModal() {
        // Select the Register Modal element
        var registerModal = document.getElementById('RegisterModal');
        // Open the modal
        var modal = new bootstrap.Modal(registerModal);
        modal.show();
    }
</script>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
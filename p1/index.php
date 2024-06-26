<?php
    session_start();
    // Database configuration
    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $database = "project"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Registration
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
        // Retrieve form data
        $institute_name = $_POST['institute_name'];
        $_SESSION['institute_name'] = $institute_name;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];

        // SQL query to insert data into registration table
        $sql = "INSERT INTO registration (institute_name, email, password, address, phone_number)
                VALUES ('$institute_name', '$email', '$password', '$address', '$phone_number')";

        if ($conn->query($sql) === TRUE) {
         header("Location: home.php");
         exit;
            
        } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Login
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        // Retrieve form data
        $name = $_POST['name'];
        $password = $_POST['password'];
        $_SESSION['institute_name'] = $name;

        // SQL query to validate user credentials
        $sql = "SELECT * FROM registration WHERE institute_name='$name' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // If the user exists, set session variable and redirect to index1.php
            $_SESSION['loggedin'] = true;
            header("Location: home.php");
            exit;
        } else {
            // If the user doesn't exist, display error message
            echo "Invalid email or password.";
        }
    }

    // Close connection
    $conn->close();
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
      <a href="#"onclick="openRegisterModal()" style="text-decoration:none">book</a>
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
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control shadow-none" placeholder="Enter Your Email">
                            </div>
                            
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control shadow-none" placeholder="Enter Your Password">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control shadow-none" placeholder="Confirm Your Password">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control shadow-none" name="address" placeholder="Enter Your Address" rows="1"></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="phone_number"class="form-control shadow-none" placeholder="Enter Your Phone Number">
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
                            <input type="text" name="name"class="form-control shadow-none" placeholder="Enter Username">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"class="form-control shadow-none" placeholder="Enter Your Password">
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

         <div class="swiper-slide slide" style="background:url(images/home-slide-1.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>travel around the world</h3>
               <a href="package.php" class="btn">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-2.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>discover new places</h3>
               <a href="package.php" class="btn">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-3.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>make your tour worthwhile</h3>
               <a href="package.php" class="btn">discover more</a>
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
      <img src="images/about-img.jpg" alt="">
   </div>

   <div class="content">
      <h3>about us</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita et, recusandae nobis fugit modi quibusdam ea assumenda, nulla quisquam repellat rem aliquid sequi maxime sapiente autem ipsum? Nobis, provident voluptate?</p>
      <a href="about.php" class="btn">read more</a>
   </div>

</section>

<!-- home about section ends -->

<!-- home packages section starts  -->

<section class="home-packages">

   <h1 class="heading-title"> our packages </h1>

   <div class="box-container">

      <div class="box">
         <div class="image">
            <img src="images/img-1.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="book.php" class="btn">book now</a>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="images/img-2.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="book.php" class="btn">book now</a>
         </div>
      </div>
      
      <div class="box">
         <div class="image">
            <img src="images/img-3.jpg" alt="">
         </div>
         <div class="content">
            <h3>adventure & tour</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, sint!</p>
            <a href="book.php" class="btn">book now</a>
         </div>
      </div>

   </div>

   <div class="load-more"> <a href="package.php" class="btn">load more</a> </div>

</section>

<!-- home packages section ends -->

<!-- home offer section starts  -->

<section class="home-offer">
   <div class="content">
      <h3>upto 50% off</h3>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure tempora assumenda, debitis aliquid nesciunt maiores quas! Magni cumque quaerat saepe!</p>
      <a href="book.php" class="btn">book now</a>
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
         <a href="#" onclick="openRegisterModal()" > <i class="fas fa-angle-right"></i> book</a>
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
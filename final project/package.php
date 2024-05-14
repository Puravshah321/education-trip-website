<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>package</title>

   <!-- swiper css link -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link -->
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

      .pagination {
    margin-top: 20px;
    text-align: center;
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
      <a href="book.php" style="text-decoration:none">book</a>
      <a href="faq.php" style="text-decoration:none">FAQ</a>
      <h1 style="color:#A020F0;margin: 0px 0px 0px 20px;font-size:24px;">Hello,<?php echo $_SESSION['institute_name'];?></h1>
      <div class="login-register">
      </div>
   </nav>

   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<!-- header section ends -->

<div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
   <h1>packages</h1>
</div>

<!-- FILTERS SECTION STARTS -->

<section class="services">

   <h1 class="heading-title">Select Filters </h1>

   <div class="box-container">

   <div class="box">
         <div class="image">
            <img src="images/icon-1.png" alt="">
         </div>
         <div class="content">
            <h3>Trip Class</h3>
            <form>
               <select>
                  <option value="all">All</option>
                  <option value="standard">Standard</option>
                  <option value="premium">Premium</option>
                  <option value="economy">Economy</option>
               </select>
            </form>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="images/icon-2.png" alt="">
         </div>
         <div class="content">
            <h3>State</h3>
            <form>
               <select>
                  <option value="all">All</option>
                  <option value="andhra-pradesh">Andhra Pradesh</option>
                  <option value="arunachal-pradesh">Arunachal Pradesh</option>
                  <option value="assam">Assam</option>
                  <option value="bihar">Bihar</option>
                  <option value="chhattisgarh">Chhattisgarh</option>
                  <option value="goa">Goa</option>
                  <option value="gujarat">Gujarat</option>
                  <option value="haryana">Haryana</option>
                  <option value="himachal-pradesh">Himachal Pradesh</option>
                  <option value="jammu-kashmir">Jammu and Kashmir</option>
                  <option value="jharkhand">Jharkhand</option>
                  <option value="karnataka">Karnataka</option>
                  <option value="kerala">Kerala</option>
                  <option value="madhya-pradesh">Madhya Pradesh</option>
                  <option value="maharashtra">Maharashtra</option>
                  <option value="manipur">Manipur</option>
                  <option value="meghalaya">Meghalaya</option>
                  <option value="mizoram">Mizoram</option>
                  <option value="nagaland">Nagaland</option>
                  <option value="odisha">Odisha</option>
                  <option value="punjab">Punjab</option>
                  <option value="rajasthan">Rajasthan</option>
                  <option value="sikkim">Sikkim</option>
                  <option value="tamil-nadu">Tamil Nadu</option>
                  <option value="telangana">Telangana</option>
                  <option value="tripura">Tripura</option>
                  <option value="uttar-pradesh">Uttar Pradesh</option>
                  <option value="uttarakhand">Uttarakhand</option>
                  <option value="west-bengal">West Bengal</option>
               </select>
            </form>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="images/icon-3.png" alt="">
         </div>
         <div class="content">
            <h3>Grade</h3>
            <form>
               <select>
                  <option value="all">All</option>
                  <option value="primary">Primary</option>
                  <option value="secondary">Secondary</option>
                  <option value="higher-secondary">Higher Secondary</option>
               </select>
            </form>
         </div>
      </div>
      

      <div class="box">
    <div class="image">
        <img src="images/icon-4.png" alt="">
    </div>
    <div class="content">
        <h3>Season</h3>
        <form>
            <select>
                <option value="all">All</option>
                <option value="summer">Summer</option>
                <option value="autumn">Autumn</option>
                <option value="winter">Winter</option>
                <option value="spring">Spring</option>
            </select>
        </form>
    </div>
</div>


<div class="box">
    <div class="image">
        <img src="images/icon-5.png" alt="">
    </div>
    <div class="content">
        <h3>Categories</h3>
        <form>
            <select>
                <option value="all">All</option>
                <option value="history">History</option>
                <option value="science">Science & Technology</option>
                <option value="nature">Nature</option>
                <option value="art-and-culture">Art & Culture</option>
                <!-- <option value="technology">Technology</option> -->
                <option value="adventure">Adventure</option>
            </select>
        </form>
    </div>
</div>


   </div>

</section>
<!-- FILTERS SECTION ENDS -->



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
$limit = 6; // Number of reviews per page
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
?>
        <div class="box">
        <div class="image">
            <img src="<?php echo $row['image_id']; ?>" alt="" style="width: 250; height: 500px;">
         </div>

            <div class="content">
                <h3><?php echo $row['package_name']; ?></h3>
                <p><?php echo "Price: Rs." .$row['package_price']; ?></p>
                <form>
                    <a href="itinerary.php?package_id=<?php //echo $row['id']; ?>" class="btn">More Details</a>
                    <select class="dropdown">
                        <option value="" disabled selected>View Dates</option>
                        <option value="oct">October 21-23</option>
                        <option value="nov">November 4-6</option>
                        <option value="dec">December 12-14</option>
                    </select>
                </form>
            </div>
        </div>
<?php
    }
} else {
    echo "0 results"; // Output this if no records found
}

?>
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

       
      // Close connection
      $conn->close();
       ?>
      
   </div>
</section>
<!-- Packages End -->
<!-- footer section starts -->

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

<!-- footer section ends -->



   

<!-- swiper js link -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link -->
<script src="js/script.js"></script>

</body>
</html>
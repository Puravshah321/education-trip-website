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

        .packages .box-container {
                display: flex;
                flex-wrap: wrap;
                gap: 32px; /* Optional: adds space between boxes */
            }

        .packages .box-container .box {
            width: 385px; /* Define a static width for the boxes */
            height: 520px; /* Define a static height for the boxes */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .packages .box-container .box .image {
            width: 100%;
            height: 67%; /* Define height for the image container */
            overflow: hidden; /* Hide any overflow content */
        }

        .packages .box-container .box .image img {
            width: 100%;
            height: 100%;
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

   <div class="box-container"  style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
   <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
   <div class="box"  style="flex: 1; min-width: 200px;">
         <div class="image">
            <img src="images/icon-1.png" alt="">
         </div>
         <div class="content">
            <h3>Trip Class</h3>
               <select name="package_type">
                  <option value="all">All</option>
                  <option value="standard">Standard</option>
                  <option value="premium">Premium</option>
                  <option value="economy">Economy</option>
               </select>
         </div>
      </div>

      <div class="box"  style="flex: 1; min-width: 200px;">
         <div class="image">
            <img src="images/icon-2.png" alt="">
         </div>
         <div class="content">
            <h3>State</h3>
               <select name="filter_state">
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
         </div>
      </div>

      <div class="box" style="flex: 1; min-width: 200px;">
         <div class="image">
            <img src="images/icon-3.png" alt="">
         </div>
         <div class="content">
            <h3>Grade</h3>
               <select name="filter_grade">
                  <option value="all">All</option>
                  <option value="primary">Primary</option>
                  <option value="secondary">Secondary</option>
                  <option value="higher-secondary">Higher Secondary</option>
               </select>
         </div>
      </div>
      

<div class="box" style="flex: 1; min-width: 200px;">
    <div class="image">
        <img src="images/icon-4.png" alt="">
    </div>
    <div class="content">
        <h3>Months</h3>
            <select name="filter_month">
                <option value="all">All</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
    </div>
</div>


<div class="box" style="flex: 1; min-width: 200px;">
    <div class="image">
        <img src="images/icon-5.png" alt="">
    </div>
    <div class="content">
        <h3>Categories</h3>
            <select name = "filter_category">
                <option value="all">All</option>
                <option value="Heritage">Heritage</option>
                <option value="Industrial">Industrial</option>
                <option value="Wildlife">Wildlife</option>
                <option value="Cultural">Cultural</option>
                <option value="Historial">Historial</option>
            </select>
    </div>
</div>
<br>
        <div style="flex-basis: 100%; display: flex; justify-content: center; align-items: center;">
            <button type="submit" class="btn" style="color: white; text-decoration: none; border: 1px solid black; border-radius: 3px; font-size: 20px; background-color: black; height: 50px; width: 200px;">
               Apply Filters
            </button>
         </div>
    </form>

   </div>

</section>
<!-- FILTERS SECTION ENDS -->



<!-- packages section starts -->

<section id="top-destinations" class="packages">
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

                // Build the WHERE clause based on the filters
                $whereClause = '';

                // Trip Class filter
                if (isset($_GET['package_type']) && $_GET['package_type'] !== 'all') {
                    $whereClause .= " package_type = '" . $_GET['package_type'] . "' AND ";
                }

                // State filter
                if (isset($_GET['filter_state']) && $_GET['filter_state'] !== 'all') {
                    $whereClause .= " filter_state = '" . $_GET['filter_state'] . "' AND ";
                }

                // Grade filter
                if (isset($_GET['filter_grade']) && $_GET['filter_grade'] !== 'all') {
                    $whereClause .= " filter_grade = '" . $_GET['filter_grade'] . "' AND ";
                }

                // Dates filter
                if (isset($_GET['filter_month']) && $_GET['filter_month'] !== 'all') {
                    // Assuming your database has a table named 'your_table_name' and three date columns named 'date1', 'date2', and 'date3'
                    $filterMonth = $_GET['filter_month'];
                    
                    // Assuming $whereClause is already initialized
                    $whereClause .= " (MONTH(package_date1) = '$filterMonth' OR MONTH(package_date2) = '$filterMonth' OR MONTH(package_date3) = '$filterMonth') AND ";
                }
                

                // Categories filter
                if (isset($_GET['filter_category']) && $_GET['filter_category'] !== 'all') {
                    // Assuming your database has a column named 'categories'
                    $whereClause .= " filter_category = '" . $_GET['filter_category'] . "' AND ";
                }

                // Remove the trailing "AND" from the WHERE clause
                if (!empty($whereClause)) {
                    $whereClause = 'WHERE ' . rtrim($whereClause, ' AND ');
                }

                // Construct the SQL query with the WHERE clause
                $sql = "SELECT * FROM package $whereClause LIMIT $start, $limit";

                $result = $conn->query($sql);

                if ($result !== null && $result instanceof mysqli_result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Get image dimensions
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
                } else {
                    echo "<div style='text-align: center;'>";
                    echo "<h2>";
                    echo "Sorry, No packages found!"; // Output this if no records found or if $result is null
                    echo "</h2>";
                    echo "</div>";                    
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

<!-- Scroll to top destinations on page load -->
<script>
window.onload = function() {
    var topDestinationsSection = document.getElementById("top-destinations");
    if (topDestinationsSection) {
        topDestinationsSection.scrollIntoView({ behavior: "smooth" });
    }
};
</script>

</body>
</html>
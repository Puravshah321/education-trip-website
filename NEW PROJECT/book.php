<?php
session_start();
use SimpleExcel\SimpleExcel;

$conn = mysqli_connect("localhost", "root", "", "project") or die("Not connected");

// Fetch institute details
$name = $_SESSION['institute_name'];
$query = "SELECT * FROM registration WHERE institute_name= '$name'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$i_id = $row['institute_id'];
$name = $row['institute_name'];
$email = $row['institute_email'];
$phone = $row['institute_phone_number'];
$address = $row['institute_address'];

// Fetch package details
$p_id = $_GET["package_id"];
$query = "SELECT * FROM package WHERE package_id = '$p_id'";
$result = mysqli_query($conn, $query);
$rows = mysqli_fetch_assoc($result);
$package = $rows['package_name'];
$date1 = $rows['package_date1'];
$date2 = $rows['package_date2'];
$date3 = $rows['package_date3'];
$duration = $rows['package_duration'];
$package_price = $rows['package_price']; // Package price

// Validation variables
$no_studentErr = "";
$arrivalerr = "";
$csv_error = "";

// Registration handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $institute_name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone'];
    $address = $_POST['address'];
    $package_name = $_POST['location'];
    $no_student = $_POST['guests'];
    $arrival = $_POST['arrival'];
    $leaving = $_POST['leaving'];
    $total_payment = $no_student * $package_price;

    $uploadok = 1;

    // Validate number of students
    if (empty($no_student)) {
        $no_studentErr = "No of student is required";
        $uploadok = 0;
    } else {
        $no_student = $_POST['guests'];
        $uploadok = 1;

        if ($no_student < 0 || $no_student > 50) {
            $no_studentErr = "Students can be between 1 to 50";
            $uploadok = 0;
        }
    }

    // Validate arrival date
    if (empty($arrival)) {
        $arrivalerr = "Date is required";
        $uploadok = 0;
    } else {
        $arrival = $_POST['arrival'];
    }

    // CSV file validation and processing
    if ($uploadok == 1 && isset($_FILES['excel_file'])) {
        if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $_FILES['excel_file']['name'])) {
            require_once('SimpleExcel/SimpleExcel.php');
            $excel = new SimpleExcel('csv');
            $excel->parser->loadFile($_FILES['excel_file']['name']);
            $foo = $excel->parser->getField();

            // Count the number of entries in the CSV file
            $csv_entry_count = count($foo);

            // Validate the number of students against CSV entries
            if ($csv_entry_count != $no_student) {
                $csv_error = "The number of students entered does not match the entries in the CSV file.";
                $uploadok = 0;
            } else {
                foreach ($foo as $entry) {
                    $stu_name = $entry[0];
                    $stu_age = $entry[1];
                    $stu_g_num = $entry[2];
                    $query = "INSERT INTO student(institute_id, student_name, student_age, guardian_num) VALUES('$i_id', '$stu_name', '$stu_age', '$stu_g_num')";
                    mysqli_query($conn, $query);
                }
            }
        }
    }

    // Insert booking details if all validations passed
    if ($uploadok == 1) {
        $sql = "INSERT INTO booking (booking_date, institute_id, package_id, institution_name, institution_email, institution_phone_no, institution_address, number_of_student, arrival_date, leaving_date, total_payment)
                VALUES (NOW(), '$i_id', '$p_id', '$institute_name', '$email', '$phone_number', '$address', '$no_student', '$arrival', '$leaving', '$total_payment')";
        if ($conn->query($sql) === TRUE) {
            // Redirect or display success message
            // header("Location: index.php");
            // exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Book Now</title>

   <!-- Swiper CSS link -->
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
   
<section class="header">
   <a href="index.php" class="logo" style="text-decoration:none;color:#279e8c;">Edu Trip</a>
   <nav class="navbar">
      <a href="index.php" style="text-decoration:none">home</a>
      <a href="about.php" style="text-decoration:none">about</a>
      <a href="package.php" style="text-decoration:none">package</a>
      <a href="book.php" style="text-decoration:none">book</a>
      <a href="faq.php" style="text-decoration:none">FAQ</a>
      <h1 style="color:#A020F0;margin: 0px 0px 0px 20px;font-size:24px;">Hello, <?php echo $_SESSION['institute_name'];?></h1>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
   <h1>Book Now</h1>
</div>

<section class="booking">
   <h1 class="heading-title">Book Your Trip!</h1>

   <form method="post" class="book-form" enctype="multipart/form-data">

      <div class="flex">
         <div class="inputBox">
            <span>Name:</span>
            <input type="text" value="<?php echo $name; ?>" name="name">
         </div>
         <div class="inputBox">
            <span>Email:</span>
            <input type="email" value="<?php echo $email; ?>" name="email">
         </div>
         <div class="inputBox">
            <span>Phone:</span>
            <input type="number" value="<?php echo $phone; ?>" name="phone">
         </div>
         <div class="inputBox">
            <span>Address:</span>
            <input type="text" value="<?php echo $address; ?>" name="address">
         </div>
         <div class="inputBox">
            <span>Package Name:</span>
            <input type="text" value="<?php echo $package; ?>" name="location">
         </div>
         <div class="inputBox">
            <span>Number of Students:</span>
            <input type="number" placeholder="Enter number of Students" name="guests">
            <span style="color: #FF0000;">* <?php echo $no_studentErr;?></span>
         </div>
         <div class="inputBox">
            <span>Arrival Date:</span><br>
            <select class="dropdown" name="arrival" onchange="calculateLeavingDate()" style="background-color: white; color: #222; margin-top: 15px; font-size: 16px; border: 1px solid black; padding: 10px; width: 585px; height: 50px;">
               <option value="" disabled selected>Select Dates</option>
               <option value="<?php echo $date1; ?>"><?php echo $date1; ?></option>
               <option value="<?php echo $date2; ?>"><?php echo $date2; ?></option>
               <option value="<?php echo $date3; ?>"><?php echo $date3; ?></option>
            </select>
            <span  style="color: #FF0000;">* <?php echo $arrivalerr;?></span>
         </div>
         <div class="inputBox">
            <span>Leaving Date:</span>
            <input type="text" name="leaving" readonly>
         </div>
         <div class="inputBox">
            <span>Upload Students' Info:</span>
            <input type="file" placeholder="Enter number of Students" name="excel_file" accept=".csv">
            <span style="color: #FF0000;">* <?php echo $csv_error; ?></span>
         </div>
         <div class="inputBox">
            <span>Total Payment:</span>
            <input type="text" name="total_payment" readonly>
         </div>
      </div>
      <input type="submit" value="Submit" class="btnsub" name="send">
   </form>

   <script>
      function updateTotalPayment() {
         const packagePrice = <?php echo $package_price; ?>;
         const numberOfStudents = document.querySelector('input[name="guests"]').value;
         const totalPayment = numberOfStudents * packagePrice;
         document.querySelector('input[name="total_payment"]').value = totalPayment;
      }

      // Update the total payment when the number of students changes
      document.querySelector('input[name="guests"]').addEventListener('input', updateTotalPayment);

      // Calculate total payment initially if there is a predefined value
      document.addEventListener('DOMContentLoaded', updateTotalPayment);

      function calculateLeavingDate() {
         const arrivalDropdown = document.querySelector('select[name="arrival"]');
         const arrivalDate = arrivalDropdown.options[arrivalDropdown.selectedIndex].value;
         if (arrivalDate) {
            const arrival = new Date(arrivalDate);
            const leaving = new Date(arrival);
            leaving.setDate(leaving.getDate() + <?php echo $duration; ?>); // Add duration days
            const leavingDateString = leaving.toISOString().split('T')[0]; // Format as YYYY-MM-DD
            document.querySelector('input[name="leaving"]').value = leavingDateString;
         }
      }
   </script>

   <!-- Display student registration form only if CSV validation passed -->
   <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"]) && $uploadok == 1) {
      echo "<h1 class='student-title'>Student Registration:</h1>";
      echo "<form method='post' class='book-form' enctype='multipart/form-data'>";
      echo "<div class='flex1'>";
      $query = "SELECT * FROM student WHERE institute_id = '$i_id'";
      $result = mysqli_query($conn, $query);
      $number_of_students = $_POST["guests"];
      for ($i = 1; $i <= $number_of_students; $i++) {
         $row = mysqli_fetch_assoc($result);
         echo "<div class='inputBox'>";
         echo "<span style='font-size: 23px;'>{$i}.</span>";
         echo "<input type='text' value='{$row['student_name']}' name='s_name{$i}'>";
         echo "<input type='text' value='{$row['student_age']}' name='s_age{$i}'>";
         echo "<input type='text' value='{$row['guardian_num']}' name='s_guardian{$i}'>";
         echo "</div>";
      }
      echo "</div>";
      echo "<input type='submit' name='stu_submit' class='btnsub' value='Submit'/>";
      echo "</form>";
   }
   ?>
</section>

<section class="footer">
   <div class="box-container">
      <div class="box">
         <h3>Quick Links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
         <a href="package.php"> <i class="fas fa-angle-right"></i> Package</a>
         <a href="book.php"> <i class="fas fa-angle-right"></i> Book</a>
      </div>
      <div class="box">
         <h3>Extra Links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> Ask Questions</a>
         <a href="#"> <i class="fas fa-angle-right"></i> About Us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> Privacy Policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> Terms of Use</a>
      </div>
      <div class="box">
         <h3>Contact Info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
         <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
         <a href="#"> <i class="fas fa-envelope"></i> shaikhanas@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> Mumbai, India - 400104 </a>
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

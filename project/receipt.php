
<?php
    session_start();
    if (!isset($_SESSION['institute_name'])) {
      header("Location: home.php"); // Redirect to home.php
      exit; // Stop further execution
  }
    $conn = mysqli_connect("localhost", "root", "", "project") or die("Not connected");
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


<div>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Details</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  .container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
  }
  h1 {
    text-align: center;
  }
  h2{
      font-family : vendana;
  }
  .booking-info {
    margin-top: 20px;
  }
  .booking-info p {
    margin: 5px 0;
  }
  .booking-info table {
    width: 100%;
    border-collapse: collapse;
  }
  .booking-info th, .booking-info td {
    border: 1px solid #ddd;
    padding: 8px;
  }
  .booking-info th {
    background-color: #f2f2f2;
  }
</style>
</head>
<body>
<?php
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

   $query = "SELECT * FROM booking WHERE package_id = '$p_id' and institute_id = '$i_id'";
   $result = mysqli_query($conn, $query);
   $rows = mysqli_fetch_assoc($result);
   $b_id = $rows['booking_id'];
   $arrival = $rows['arrival_date'];
   $leave = $rows['leaving_date'];
   $no_student = $rows['number_of_student'];
   $b_date = $rows['booking_date'];
?>
<div class="container">
  <h1>BOOK DETAILS</h1><br>
  <div class="booking-info">
    <h2>Booked By : <?php echo $name; ?> </h2>
    <h2>Email :  <?php echo $email; ?> </h2>
    <h2>Phone : <?php echo $phone; ?> </h2><br>

    <h2>Arrival Date : <?php echo $arrival; ?> </h2>
    <h2>Leaving Date : <?php echo $leave; ?> </h2>
    <h2>Students :  <?php echo $no_student; ?> </h2><br>

    <h2>Booking ID :  <?php echo $b_id; ?></h2>
    <h2>Booking Date :<?php echo $b_date; ?> </h2>
    <h2>Status : Booked</h2>
    <h2>Payment : 3 days After Booking </h2><br><br>
    <table>
      <tr>
        <th><h3>Description</th>
        <th>Amount</h3></th>
      </tr>
      <tr>
        <td>Package Name </td>
        <td><?php echo $package;?></td>
      </tr>
      <tr>
        <td>Duration </td>
        <td><?php echo $duration; ?></td>
      </tr>
      <tr>
        <td>Transportation</td>
        <td>Included</td>
      </tr>
      <tr>
        <td><strong>Sub Total</strong></td>
        <td><?php echo $rows["total_payment"]; ?></td>
      </tr>
      <tr>
        <td><strong>GST (18%)</strong></td>
        <td><?php echo $rows["total_payment"]*0.18; ?></td>
      </tr>
      <tr>
        <td><strong>Final Total</strong></td>
        <td><?php echo $rows["total_payment"]*0.18 + $rows["total_payment"]; ?></td>
      </tr>
    </table><br><br>
    <p><h2>Additional Information:</h2></p>
    <p>Thank You for Choosing Edu Trip Educational Tours!<br> All the meals and transportation facilites during the journey will be provided by us.<br>

We appreciate your business and are committed to providing you with an enriching and memorable educational experience.<br>
<br><br>
<h3>Payment Terms:</h3><br>

Payment due within 30 days from the date of this invoice.<br>
Please make all checks payable to Edu Trip.<br>
For electronic payments, please use the following details:<br>
Bank: State Bank Of India<br>
Account Number : @987658943<br>
Routing Number: 233245556<br><br>
<h3>Contact Information :</h3> <br>

Email: edutrip@gmail.com<br>
Phone: +91 123456789<br>
Website: edutrip.com<br><br>
<h3>Cancellation Policy:</h3><br>

Cancellations made 30 days prior to the tour date will receive a full refund.<br>
Cancellations made within 15-30 days prior to the tour date will receive a 50% refund.<br>
No refunds for cancellations made within 14 days of the tour date.<br>
We look forward to welcoming you on your next educational adventure!</p>
    <p></p>
    <p></p>
    
  </div>
</div>
</body>
</html>
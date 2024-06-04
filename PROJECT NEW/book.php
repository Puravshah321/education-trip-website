<?php
   session_start();
   use SimpleExcel\SimpleExcel; 
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
      
      .error {
         color: #FF0000;
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

<div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
   <h1>book now</h1>
</div>

<!-- booking section starts  -->
<?php
			$conn = mysqli_connect("localhost","root","","project") or die("Not connected");
			$name = $_SESSION['institute_name'];
			$query = "SELECT * FROM registration WHERE institute_name= '$name'";
			$result = mysqli_query($conn,$query);
			$row = mysqli_fetch_assoc($result);
			
			$i_id = $row['institute_id'];
			$name = $row['institute_name'];
			$email = $row['institute_email'];
			$phone = $row['institute_phone_number'];
			$address = $row['institute_address'];
			
			$p_id = $_GET["package_id"];
			$query = "SELECT * FROM package where package_id = '$p_id'";
			$result = mysqli_query($conn,$query);
			$rows=mysqli_fetch_assoc($result);
			$package = $rows['package_name'];
			$date1 = $rows['package_date1'];
			$date2 = $rows['package_date2'];
			$date3 = $rows['package_date3'];
			$duration = $rows['package_duration'];
			

      $no_studentErr = $arrivalerr = "";



// Registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    $institute_name = $_POST['name'];
    $email = $_POST['email'];
	$phone_number = $_POST['phone'];
    $address = $_POST['address'];
	$package_name = $_POST['location'];
	$no_student = $_POST['guests'];
	$arrival = $_POST['arrival'];
	$Leaving = $_POST['leaving'];

    $uploadok = 1;

    if (empty($no_student)) 
    {
        $no_studentErr = "No of student is required";
        $uploadok = 0;
    } 
    else 
    {
      $no_student = $_POST['guests'];
        $uploadok = 1;
        
        if ($no_student < 0 || $no_student>50) 
        {
            $no_studentErr = "Students can be beetween 1 to 50";
            $uploadok = 0;
        }
    }

    if (empty($arrival)) 
    {
        $arrivalerr = "Date is required";
        $uploadok = 0;
    } 
    else 
    {
         $arrival = $_POST['arrival'];
    }

    if ($uploadok == 1) 
    {
        $sql = "INSERT INTO booking (booking_date, institute_id,package_id,institution_name,institution_email,institution_phone_no, institution_address, number_of_student,arrival_date,leaving_date)
                VALUES (now(),'$i_id','$p_id','$institute_name', '$email', '$phone_number', '$address', '$no_student','$arrival','$Leaving')";

        if ($conn->query($sql) === TRUE) 
        {
            // header("Location: index.php");
            // exit;
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(move_uploaded_file($_FILES['excel_file']['tmp_name'],$_FILES['excel_file']['name']))
    {
       require_once('SimpleExcel/SimpleExcel.php');

       $excel = new SimpleExcel('csv');                   
       $excel->parser->loadFile($_FILES['excel_file']['name']);            
 
       $foo = $excel->parser->getField();         
       
       $count = 0;

       while(count($foo)>$count)
       {
         $stu_name = $foo[$count][0];
         $stu_age = $foo[$count][1];
         $stu_g_num = $foo[$count][2];
         $query = "INSERT INTO student(student_name,student_age,guardian_num) VALUES ('$stu_name' , '$stu_age' , '$stu_g_num')"; 
         mysqli_query($conn,$query);
         $count++;
       }
       

    }
}

?>
<section class="booking">

   <h1 class="heading-title">book your trip!</h1>

   <form method="post" class="book-form" enctype="multipart/form-data">

<div class="flex">
   <div class="inputBox">
      <span>name :</span>
      <input type="text" value="<?php echo $name; ?>" name="name">
   </div>
   <div class="inputBox">
      <span>email :</span>
      <input type="email" value="<?php echo $email; ?>" name="email">
   </div>
   <div class="inputBox">
      <span>phone :</span>
      <input type="number" value="<?php echo $phone; ?>" name="phone">
   </div>
   <div class="inputBox">
      <span>address :</span>
      <input type="text" value="<?php echo $address; ?>" name="address">
   </div>
   <div class="inputBox">
      <span>Package Name:</span>
      <input type="text" value="<?php echo $package; ?>" name="location">
   </div>
   <div class="inputBox">
      <span>Number of Students:</span>
      <input type="number" placeholder="Enter number of Students" name="guests">
    <span class="error">* <?php echo $no_studentErr;?></span>
   </div>
   <div class="inputBox">
      <span>Arrivals Dates:</span><br>
      <select class="dropdown" name="arrival" onchange="calculateLeavingDate()" style="background-color: white; color: #222; margin-top: 15px; font-size: 16px; border: 1px solid black; padding: 10px; width:585px; height:50px;">
         <option value="" disabled selected style="background-color: black; color: white;">Select Dates</option>
         <option value="<?php echo $date1; ?>" style="background-color: black; color: white;"><?php echo $date1; ?></option>
         <option value="<?php echo $date2; ?>" style="background-color: black; color: white;"><?php echo $date2; ?></option>
         <option value="<?php echo $date3; ?>" style="background-color: black; color: white;"><?php echo $date3; ?></option>
      </select>
      <span class="error">* <?php echo $arrivalerr;?></span>
   </div>
   
   <div class="inputBox">
      <span>Leaving Dates:</span>
      <input type="text"  name="leaving" readonly>
   </div>

   <div class="inputBox">
      <span>Upload Student's Info: </span>
      <input type="file" placeholder="Enter number of Students" name="excel_file" accept=".csv">
      <!-- <input type="submit" name="import" value="import"> -->
   </div>

</div>

<input type="submit" value="submit" class="btnsub" name="send">
</form>
   <br>
   <br>
   <script>
    function calculateLeavingDate() {
        const arrivalDropdown = document.querySelector('select[name="arrival"]');
        const arrivalDate = arrivalDropdown.options[arrivalDropdown.selectedIndex].value;
        if (arrivalDate) {
            const arrival = new Date(arrivalDate);
            const leaving = new Date(arrival);
            leaving.setDate(leaving.getDate() + 3); // Add 3 days for example
            const leavingDateString = leaving.toISOString().split('T')[0]; // Format as YYYY-MM-DD
            document.querySelector('input[name="leaving"]').value = leavingDateString;
        }
    }
</script>

   <!-- <h1 class="student-title">Student's Registration :</h1> -->
         <?php
				
            if(isset($_POST["send"]))
            {
               $number_of_students=$_POST["guests"];
               if($number_of_students > 0 && $number_of_students <= 40)
               {
                  echo "<h1 class='student-title'>Student Registration:</h1>";
                  for($i = 1;$i <= $number_of_students;$i++)
                  {
         ?>
                     <form method="post" class="book-form" enctype="multipart/form-data">
                     <div class="flex1">
                        <div class="inputBox">
                        <span style="font-size: 23px;"><?php echo $i . "." ?></span>
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

   <div class="credit"> created by <span>mr. web designer</span> | all rights reserved! </div>

</section>

<!-- footer section ends -->









<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>

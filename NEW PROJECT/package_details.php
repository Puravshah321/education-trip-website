<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "project");

// Fetch activities from the database
$sql = "SELECT * FROM activity";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html>
<head>

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
        *{
            /* background-color:black;
            color:white; */
        }
        .boxpd {
        display: table;
        width: 60%;
        height:500px;
        background-color: #114BFF;
        border: 2px solid black;
        border-radius: 5px;
        padding: 10px;
        font-size: 15px;
        }

        .boxpd th {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid yellow;
        }

        .button-group {
        margin-bottom: 1px;
        }

        .button-group button:hover {
        background-color: #FFC700;
        }


        .button-group button {
        background-color: yellow;
        border: 1px solid black;
        color: black;
        padding: 5px 10px ;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 2px 2px;
        cursor: pointer;

        }
</style>
</head>
<body>

<body>

<!-- header section starts  -->

<section class="header">
   <a href="home.php" class="logo" style="text-decoration:none;color:#279e8c;">Edu Trip</a>
   <nav class="navbar">
      <a href="home.php" style="text-decoration:none">home</a>
      <a href="about.php" style="text-decoration:none">about</a>
      <a href="package.php" style="text-decoration:none">package</a>
      <a href="book.php" style="text-decoration:none">book</a>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>
</section>

<!-- header section ends  -->

<div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
   <h1>Planned Trip</h1>
</div>

<div class="button-group">
  <button class="active" onclick="showContent('setting')">To Explore</button>
  <button onclick="showContent('itinerary')">Itinerary</button>
  <button onclick="showContent('activities')">Activities</button>
  <button onclick="showContent('images')">Images</button>
</div>

<!-- <div id="content-box" class="boxpd">
  <div class="title">Setting The Stage</div>
  <div class="content">
    Participants plan and execute their own trekking expedition. The trekking expedition, spread over 4 days, requires them to reach a high point, usually a summit, and return down to the base camp safely. They do this in teams composed of 8 to 10 members, usually of diverse skills and abilities. Designing the trek experience nudges participants out of their comfort zones. It creates an environment for learning. Each day of the trek has a progressive change in terrain, altitude, temperature, and trekking hours. This keeps participants constantly on the learning edge.
  </div>
</div> -->

<div id="content-box" class="boxpd">
    <div class="title"><h1>Activities Details</h1></div>
    <div class="content">
        <?php
        // Check if there are activities in the database
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<h4>" . $row["activity_id"] . "</h4>";
                echo "<p>" . $row["activity_name"] . "</p>";
                // You can add more data fields as needed
            }
        } else {
            echo "No activities found";
        }
        ?>
    </div>
</div>


<script>
function showContent(contentId) {
  const title = document.querySelector('.title');
  const content = document.querySelector('.content');

  if (contentId === 'setting') {
    title.textContent = 'Setting The Stage';
    content.textContent = `Participants plan and execute their own trekking expedition. The trekking expedition, spread over 4 days, requires them to reach a high point, usually a summit, and return down to the base camp safely. They do this in teams composed of 8 to 10 members, usually of diverse skills and abilities. Designing the trek experience nudges participants out of their comfort zones. It creates an environment for learning. Each day of the trek has a progressive change in terrain, altitude, temperature, and trekking hours. This keeps participants constantly on the learning edge.`;
  } else if (contentId === 'itinerary') {
    title.textContent = 'itinerary Details';
    content.textContent = `itinerary details go here.`;
  }  else if (contentId === 'activities') {
    title.textContent = 'Activities Details';
    content.textContent = `Activities details go here.`;
  } else if (contentId === 'images') {
    title.textContent = 'Images Title';
    content.textContent = `Images details go here.`;
  }
}

document.querySelector('.button-group button').addEventListener('click', () => {
  const buttons = document.querySelectorAll('.button-group button');
  buttons.forEach(button => button.classList.remove('active'));
  event.target.classList.add('active');
});

function showActivityDetails(activityId) {
    // Fetch activity details dynamically using AJAX
    fetch('get_activity_details.php?id=' + activityId)
    .then(response => response.text())
    .then(data => {
        // Update the content with the fetched activity details
        document.getElementById('activity-details').innerHTML = data;
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to each activity
    var activities = document.querySelectorAll('.activity');
    activities.forEach(activity => {
        activity.addEventListener('click', function() {
            // Get the activity ID
            var activityId = this.dataset.id;
            // Show the activity details
            showActivityDetails(activityId);
        });
    });
});
</script>

<!-- footer section starts -->
<br>
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
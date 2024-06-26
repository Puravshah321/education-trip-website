<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Itinerary</title>
    <link rel="stylesheet" href="styles.css">
	
	<?php
$itinerary = array(
    1 => array(
        'activities' => array(
            array(
                'name' => 'City Tour',
                'description' => 'Explore the Gandhi Ashram.',
                'image' => 'images/Gandhi_ashram.jpg'
            ),
            array(
                'name' => 'Museum Visit',
                'description' => 'Discover the local history and culture.',
                'image' => 'images/calico.jpeg'
            )
        )
    ),
    2 => array(
        'activities' => array(
            array(
                'name' => 'Museum Visit',
                'description' => 'Embark on an Shreyas folk museum.',
                'image' => 'images/shreyas folk.jpg'
            ),
            array(
                'name' => 'Sardar vallabh bhai',
                'description' => 'Enjoy a peaceful day at the Sardar vallabh bhai museum.',
                'image' => 'images/sardar vallabh bhai.jpeg'
            )
        )
    )
);
?>

	<style>
body {
    font-family: Arial, sans-serif;
    background-color: bisque;
    margin: 0;
    padding: 0;
}

.itinerary-container {
    max-width: 1800px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
   <-- box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);-->
}

h1, h2, h3 {
    color: #333;
}

.day {
    margin-bottom: 30px;
}

.activities {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.activity {
    width: calc(50% - 20px);
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.image-container {
    position: relative;
    overflow: hidden;
    border-radius: 10px 10px 0 0;
}

.image-container img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease;
}

.image-container:hover img {
    transform: scale(1.1);
}

.details {
    padding: 20px;
}

.details h3 {
    margin-top: 0;
}

.details p {
    margin-bottom: 0;
}

	</style>
	<link rel="stylesheet" href="css/style.css">
	
</head>	
<body>
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

<div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
   <h1>Tour Itinerary</h1>
</div>


    <div class="itinerary-container">
        <h1><center>ITINERARY</center></h1>
        <?php include 'itinerary_data.php'; ?>
        <?php foreach ($itinerary as $day => $details): ?>
            <div class="day">
                <h1>Day <?php echo $day; ?></h1>
                <div class="activities">
                    <?php foreach ($details['activities'] as $activity): ?>
                        <div class="activity">
                            <div class="image-container">
                                <img src="<?php echo $activity['image']; ?>" alt="<?php echo $activity['name']; ?>">
                            </div>
                            <div class="details">
                                <h3><?php echo $activity['name']; ?></h3>
                                <p><?php echo $activity['description']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
	
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

</body>
</html>

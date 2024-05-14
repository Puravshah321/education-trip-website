<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FAQ</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
       .pagination {
          margin-top: 20px;
          text-align: center;
       }

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

       h3
       {
            text-align:center;
            font-size: 4rem;
       }

       .heading h3 {
          color: white;
          font-size: 10rem;
       }

       .accordion-item {
          margin-bottom: 20px;
       }

       .accordion-title {
          background-color: lightgrey;
          color: #333;
          padding: 10px;
          cursor: pointer;
          border: 2px solid #ddd;
          border-radius: 5px;
          font-size: 3rem;
       }

       .accordion-title-nf {
          background-color: lightgrey;
          color: #333;
          padding: 10px;
          cursor: pointer;
          border: 2px solid #ddd;
          border-radius: 5px;
          font-size: 3rem;
          text-align:center;
       }
       .accordion-content {
          background-color: black; 
          color: white;
          padding: 10px;
          display: none;
          font-size:20px;
       }

       .accordion-content.show {
          display: block;
       }

    .question-form 
    {
        margin-top: 20px;
        text-align: center;
    }

    .question-input {
        padding: 10px;
        font-size: 3rem;
        border: 2px solid lightgrey;
        border-radius: 5px;
        margin-bottom: 10px;
        width: 80%; /* Adjust the width as needed */
    }

    .question-submit {
        padding: 10px 20px;
        font-size: 2rem;
        background-color: #279e8c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .question-submit:hover {
        background-color: #177c6a;
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
      <a href="index.php">home</a>
      <a href="about.php">about</a>
      <a href="package.php">package</a>
      <a href="book.php">book</a>
      <a href="faq.php" style="text-decoration:none">FAQ</a>
      <h1 style="color:#A020F0;margin: 0px 0px 0px 20px;font-size:24px;">Hello,<?php echo $_SESSION['institute_name'];?></h1>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>
</section>
<!-- header section ends -->

<div class="heading" style="background:url(images/header-bg-1.png) no-repeat">
   <h1>FAQs</h1>
</div>

<section class="faq">
    <h3>Here are few of the frequently asked questions </h3>
    <div class="accordion">
        <?php
        // Establish database connection
        $connection = mysqli_connect("localhost", "root", "", "project");

        // Check if connection was successful
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Query to select questions and answers from the faq table where answer is not null
        $query = "SELECT * FROM faq WHERE faq_question IS NOT NULL AND faq_answer IS NOT NULL";
        $result = mysqli_query($connection, $query);

        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row of the result set
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="accordion-item">';
                echo '<div class="accordion-title">' . $row['faq_question'] . '</div>';
                echo '<div class="accordion-content">';
                echo '<p>' . $row['faq_answer'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="accordion-title-nf">';
            echo '<p>No FAQs found.</p>';
            echo '</div>';
        }

        // Close the database connection
        mysqli_close($connection);
        ?> 
    </div>
    <!-- Form to ask new question -->
    <br>
    <form action="insert_question.php" method="post" class="question-form">
    <input type="text" name="question" placeholder="Ask your question here" class="question-input">
    <input type="submit" value="Submit Question" class="question-submit">
</form>
</section>
<!-- footer section ends -->

<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script>
   const accordionItems = document.querySelectorAll('.accordion-item');

   accordionItems.forEach(item => {
      const title = item.querySelector('.accordion-title');

      title.addEventListener('click', () => {
         const content = item.querySelector('.accordion-content');

         // Toggle the 'show' class to display/hide content
         content.classList.toggle('show');
      });
   });
</script>
</body>
</html>

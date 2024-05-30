<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Itinerary</title>
    <style>
        /* CSS styles */
        body {
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1400px;
            margin: 20px auto;
            background-color: bisque;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

		p{
			font-size:22px;
			font-family:arial;
		}
		
        h1, h2 {
            color: #333;
			font-size:35px;
			font-family:vendana;
        }
		h3{
			color: #333;
			font-size:20px;
			font-family:vendana;
		}

        .day {
            margin-bottom: 30px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
			font-family:vendana;
			font-size:15px;
			
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
		
			$p_id = $_GET["package_id"];
			
			$conn = mysqli_connect("localhost","root","","project") or die("Not connected");
			
			$query = "SELECT * FROM package where package_id = '$p_id'";
			$result = mysqli_query($conn,$query);
			$rows=mysqli_fetch_assoc($result);
			
			echo "<center><h1>- ",$rows['package_name']," -</h1>","<br><center>";
			echo "<center><h3>- ",$rows['package_duration']," Days Tour in ",$rows['filter_state']," -<h3><br><br></center>";
			
			$query = "SELECT * FROM itinerary where package_id = '$p_id'";
			$result = mysqli_query($conn,$query);
			$i=1;
			while($rows=mysqli_fetch_assoc($result)){
			$h_id = $rows['hotel_id'];
			echo "<center><p><b>","Day ",$i++," : ",$rows["description"],"</b><br>";
			echo "~	  ",$rows["location"],"<br>";
			echo " Distance  ",$rows["distance"],"Kms.","<br>","<br></p></center>";
			}
			
			$query = "SELECT * FROM hotel where hotel_id = '$h_id'";
			$result = mysqli_query($conn,$query);
			$rows=mysqli_fetch_assoc($result);
			echo "<h1><br>~ Stay ~</br></h1>";
			echo "<h3><b>Hotel  -  ",$rows['hotel_name'],"</b>";
			echo "<br>Rating - ",$rows['hotel_ratings']," star.";
			echo "<br>Price - Included","</h3>";
			
        ?>
    </div>
</body>
</html>

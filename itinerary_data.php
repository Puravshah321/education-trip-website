<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Itinerary</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
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

        h1, h2 {
            color: #333;
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
            // Read text file
            $file_path = 'itinerary_data.txt';
            $file_content = file_get_contents($file_path);

            // Split content by lines
            $lines = explode("\n", $file_content);

            // Display title and date
            echo "<h1>{$lines[0]}</h1>";
            echo "<h2>{$lines[1]}</h2>";
			echo "<br><br>";
            // Extract and display itinerary
            for ($i = 3; $i < count($lines); ) {
                if (substr($lines[$i], 0, 4) == 'Day ') {
                    echo "<div class='day'>";
                    echo "<h2>{$lines[$i]}</h2>";
                    echo "<ul>";
                    $i++;
                    while ($i < count($lines) && substr($lines[$i], 0, 4) != 'Day ') {
                        echo "<li>" . str_replace('-', '&#8226;', $lines[$i]) . "</li>";
                        $i++;
                    }
                    echo "</ul>";
                    echo "</div>";
                }
            }
        ?>
    </div>
</body>
</html>

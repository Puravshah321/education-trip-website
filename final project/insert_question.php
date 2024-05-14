<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $connection = mysqli_connect("localhost", "root", "", "project");

    // Check if connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the question from the form
    $question = $_POST['question'];

    // Prepare the query to insert the question into the database
    $insert_query = "INSERT INTO faq (faq_question) VALUES ('$question')";
    $result = mysqli_query($connection, $insert_query);
    // Execute the query
    if (mysqli_query($connection, $insert_query)) {
        echo "Question inserted successfully!";
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>

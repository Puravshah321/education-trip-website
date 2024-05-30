<?php

    session_start();
    // Database configuration
    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $database = "project"; // Your database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if(isset($_POST['Signin'])){
    
        $query = "SELECT * FROM admin_login WHERE Admin_Name = '$_POST[AdminName]'
        AND Admin_Password = '$_POST[AdminPassword]'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1){
            // Store the admin's name in the session
            $admin_data = mysqli_fetch_assoc($result);
            $_SESSION['AdminLoginId'] = $admin_data['Admin_Name'];
            header("location: admindashboard.php");
        }
        else{
            echo "Incorrect";
        }
    }
    
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
            width: 350px;
            max-width: 100%;
            text-align: center;
            transition: transform 0.3s ease;
            position: relative;
        }

        .login-form:hover {
            transform: translateY(-5px);
        }

        .login-form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-field {
            position: relative;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .input-field input {
            width: calc(100% - 40px);
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
            transition: border-color 0.3s ease;
            padding-left: 40px;
        }

        .input-field input:focus {
            border-color: #8e44ad;
        }

        .input-field i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #777;
        }

        button[type="submit"] {
            width: 100%;
            background: #8e44ad;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button[type="submit"]:hover {
            background: #6c3483;
        }

        .extra a {
            color: #777;
            text-decoration: none;
            margin-right: 20px;
            transition: color 0.3s ease;
        }

        .extra a:hover {
            color: #8e44ad;
        }

        .back-button {
            color: #8e44ad;
            text-decoration: none;
            position: absolute;
            top: 20px;
            left: 20px;
            transition: color 0.3s ease;
        }

        .back-button:hover {
            color: #6c3483;
        }
        .error{
            color:red;
        }
    </style>
</head>
<body>

<div class="login-form">
    <a href="../home.php" class="back-button">Back to Home</a>
    <h2>Admin Login</h2>
    <form method="POST">
        <div class="input-field">
            <i class="bi bi-person-circle" style="margin-right: 10px;"></i>
            <input type="text" placeholder="Enter Admin Username" name="AdminName">
            <span class="error">*</span>
        </div>
        <div class="input-field">
            <i class="bi bi-shield-lock" style="margin-right: 10px;"></i>
            <input type="password" placeholder="Enter Password" name="AdminPassword">
            <span class="error">*</span>
        </div>
        
        <button type="submit" name="Signin">Sign In</button>

        <div class="extra">
            <a href="#">Forgot Password ?</a>
            <a href="#">Create an Account</a>
        </div>

    </form>
</div>

<?php
if(isset($_POST['Signin'])){

    $query = "SELECT * FROM admin_login WHERE Admin_Name = '$_POST[AdminName]'
    AND Admin_Password = '$_POST[AdminPassword]'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        session_start();
        $_SESSION['AdminLoginId'] = $_POST['AdminName'];
        header("location: admindashboard.php");
    }
    else{
        echo "Incorrect";
    }
}

?>

</body>
</html>
<?php
// signup.php

session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    // Collect form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Insert data into the database
    $sql = "INSERT INTO Users (firstname, lastname, email, password) 
            VALUES ('$firstname', '$lastname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful! Please log in.'); window.location.href='index.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up | Ludiflex</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-box {
            margin-bottom: 15px;
        }

        .input-box label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .input-box input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-box input:focus {
            border-color: #2d87f0;
        }

        .input-box input[type="submit"] {
            background-color: #2d87f0;
            color: white;
            cursor: pointer;
            border: none;
        }

        .input-box input[type="submit"]:hover {
            background-color: #2276b7;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #2d87f0;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Sign Up</h2>
        <form method="POST" action="sign.php">
            <div class="input-box">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter First Name" required>
            </div>
            <div class="input-box">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter Last Name" required>
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="input-box">
                <input type="submit" name="register" value="Register">
            </div>
        </form>
        <div class="back-link">
            <a href="index.php">Back to Login</a>
        </div>
    </div>
</body>
</html>

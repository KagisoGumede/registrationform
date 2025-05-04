<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_password'])) {
    // Collect form data for searching the user
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email']; // Email is required

    // Query the database to find the user based on the information provided
    $sql = "SELECT * FROM Users WHERE firstname='$firstname' AND lastname='$lastname' AND email='$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display the user's details in an editable form for resetting the password
        echo "<form method='POST' action='forgot.php'>
                <h2>Edit Your Information</h2>
                <input type='hidden' name='user_id' value='".$row['id']."'>
                <div class='input-box'>
                    <label for='firstname'>First Name</label>
                    <input type='text' name='firstname' value='".$row['firstname']."' required>
                </div>
                <div class='input-box'>
                    <label for='lastname'>Last Name</label>
                    <input type='text' name='lastname' value='".$row['lastname']."' required>
                </div>
                <div class='input-box'>
                    <label for='email'>Email</label>
                    <input type='email' name='email' value='".$row['email']."' required>
                </div>
                <div class='input-box'>
                    <label for='password'>New Password</label>
                    <input type='password' name='password' placeholder='New Password' required>
                </div>
                <div class='input-box'>
                    <input type='submit' name='update' value='Update Information'>
                </div>
            </form>";
    } else {
        echo "No user found with that information.";
    }
}

// Handle the update of the user details when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Collect updated form data
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // New password

    // Update the user details in the database without encrypting the password
    $sql_update = "UPDATE Users SET firstname='$firstname', lastname='$lastname', email='$email', password='$password' WHERE id=$user_id";
    
    if ($conn->query($sql_update) === TRUE) {
        echo "Your information has been updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
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
    <title>Forgot Password | Ludiflex</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-box {
            width: 100%;
            max-width: 360px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .form-box h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }

        .input-box {
            margin-bottom: 15px;
        }

        .input-box label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .input-box input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
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
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Forgot Password</h2>
        <form method="POST" action="forgot.php">
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
                <input type="submit" name="reset_password" value="Find My Account">
            </div>
        </form>
        <div class="back-link">
            <a href="index.php">Back to Login</a>
        </div>
    </div>
</body>
</html>

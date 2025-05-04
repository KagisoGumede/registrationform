<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: logout.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    include('db.php');

    // Collect form data
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];

    // Check if the email or username exists
    $sql = "SELECT * FROM Users WHERE email='$email_or_username' OR firstname='$email_or_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Now check if the provided password matches the stored password
        if ($password === $row['password']) { // No password hashing here, as per your request
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php"); // Redirect to dashboard after login
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that email or username.";
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
    <title>Ludiflex | Login</title>
    <style>
        #head{color: white;}
    </style>
   
        
       
</head>

<body>
   
   <h3 id="head"> Ludiflex | Login</h3>

    <div class="wrapper">
        <nav class="nav">
            <div class="nav-log">
                
            </div>
        </nav>

 

        <!-- Login Form -->
        <div class="form-box">
            <div class="login-container">
                <div class="top">
                    <span>Don't have an account? <a href="sign.php">Sign Up</a></span>
                    <header>Login</header>
                </div>

 
                <form method="POST" action="index.php">
                    <div class="input-box">
                        <input type="text" name="email_or_username" class="input-field" placeholder="Username or Email" required>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input-field" placeholder="Password" required>
                    </div>
                    <div class="input-box">
                        <input type="submit" name="login" class="submit" value="Sign In">
                    </div>
                    <div class="two-col">
                        <div class="one">
                            <input type="checkbox" id="login-check">
                            <label for="login-check"> Remember Me</label>
                        </div>
                        <div class="two">
                            <label><a href="forgot.php" class="forgot-password">Forgot password?</a></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login if user is not logged in
    exit();
}

include('db.php');
$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard | Ludiflex</title>
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

        .wrapper {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #2d87f0;
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
        }

        .welcome-message {
            font-size: 18px;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .user-info {
            width: 100%;
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .user-info p {
            margin: 10px 0;
        }

        .user-info strong {
            color: #2d87f0;
        }

        .logout-button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #2d87f0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        .logout-button:hover {
            background-color: #2276b7;
        }

        .back-link {
            margin-top: 20px;
            text-align: center;
        }

        .back-link a {
            color: #2d87f0;
            font-weight: bold;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .wrapper {
                padding: 20px;
            }

            h1 {
                font-size: 26px;
            }

            .user-info p {
                font-size: 14px;
            }

            .logout-button {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Dashboard</h1>

        <div class="welcome-message">
            <p>Welcome, <?php echo $row['firstname'] . " " . $row['lastname']; ?>!</p>
        </div>

        <div class="user-info">
            <p><strong>Your username:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Your full name:</strong> <?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
        </div>

        <!-- Logout button -->
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-button">Logout</button>
        </form>

        <!-- Back to login link -->
        <div class="back-link">
            <a href="index.php">Back to Login</a>
        </div>
    </div>
</body>
</html>

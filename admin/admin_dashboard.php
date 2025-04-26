<?php
// Start the session
session_start();

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    // Redirect to login page if not logged in as admin
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard | University of Botswana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
        }

        .dashboard-container {
            max-width: 1100px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #003366;
            text-align: center;
            margin-bottom: 25px;
        }

        .welcome-msg {
            font-size: 18px;
            text-align: center;
            color: #003366;
        }

        .admin-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .action-box {
            background-color: #00509e;
            color: white;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            flex-basis: 23%;
            transition: background-color 0.3s;
        }

        .action-box:hover {
            background-color: #003f7d;
        }

        .action-box h3 {
            margin-bottom: 10px;
        }

        .action-box a {
            color: white;
            font-size: 18px;
            text-decoration: none;
        }

        .action-box a:hover {
            text-decoration: underline;
        }

        .logout-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #00509e;
            color: white;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: #003f7d;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>Admin Dashboard</h1>
    <p class="welcome-msg">Welcome, <?php echo $_SESSION['username']; ?>! You are logged in as an Admin.</p>

    <div class="admin-actions">
        <div class="action-box">
            <h3>Manage Applications</h3>
            <a href="manage_applications.php">View All Applications</a>
        </div>
        <div class="action-box">
            <h3>Student Rankings</h3>
            <a href="student_rankings.php">View Rankings</a>
        </div>
        <div class="action-box">
            <h3>Admission Settings</h3>
            <a href="settings.php">Configure Settings</a>
        </div>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
</div>

</body>
<footer>
    <p>&copy; <?php echo date("Y"); ?> University of Botswana. All rights reserved.</p>
    <p>Need help? <a href="support.php">Contact Support</a></p>
</footer>
</html>

<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Application</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Link to the CSS file for styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
            color: #333;
        }

        main {
            max-width: 900px;
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

        .application-details {
            background-color: #e8f4ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .application-details h2 {
            color: #00509e;
        }

        .application-details p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <main>
        <h1>View Application</h1>

        <?php
        require_once '../util.php'; // Include the utility functions for database connection and sanitization

        $conn = connectToDatabase(); // Connect to the database

        if (isset($_SESSION['student_id'])) { // Check if the student is logged in
            $student_id = $_SESSION['student_id']; // Get the student ID from session
            $stmt = $conn->prepare("SELECT * FROM applications WHERE student_id = ?"); // Prepare the SQL statement
            $stmt->bind_param("i", $student_id); // Bind the student ID parameter
            $stmt->execute(); // Execute the statement
            $stmt->store_result(); // Store the result set
            $stmt->bind_result($application_id, $student_id, $status, $created_at); // Bind the result variables
        }
        else {
            echo "<p>Please log in to view your application.</p>"; // Message if not logged in
            exit;
        }
        ?>
    </main>
</body>
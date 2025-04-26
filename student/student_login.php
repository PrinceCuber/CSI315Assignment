<?php 
require_once '../util.php'; // Include the utility functions for database connection and sanitization
session_start(); // Start the session

$conn = connectToDatabase(); // Connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the form is submitted
    $email = sanitizeInput($_POST["email"]); // Sanitize the email input
    $password = sanitizeInput($_POST["password"]); // Sanitize the password input

    // Validate email and password format
    if (!validateEmail($email)) {
        echo "Invalid email format";
        exit;
    }
    if (!validatePassword($password)) {
        echo "Password must be at least 8 characters long and contain both letters and numbers";
        exit;
    }

    // Prepare and execute the SQL statement to check for user credentials
    $stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->bind_param("s", $email); // Bind parameters to prevent SQL injection
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set

    if ($result->num_rows > 0) { // If a matching record is found
        if ($row = $result->fetch_assoc()) { // Fetch the record
            if (password_verify($password, $row['password'])) { // Verify the password
                $_SESSION['student_id'] = $row['id']; // Store the student ID in session
                $_SESSION['email'] = $row['email']; // Store the email in session
                $_SESSION['name'] = $row['name']; // Store the name in session
            } else {
                echo "Invalid email or password"; // Invalid credentials message
                exit;
            }
        }
    } else {
        echo "Invalid email or password"; // Invalid credentials message
    }
}
$stmt->close(); // Close the statement
?>
<?php
include "../util.php"; // Include the utility functions for database connection and sanitization
session_start(); 

$conn = connectToDatabase(); 

if(isset($_SESSION["student_id"])) {
    header("Location: student_dashboard.php"); // Redirect to the dashboard if already logged in
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $name = sanitizeInput($_POST["name"]); 
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]); 
    $confirmPassword = sanitizeInput($_POST["confirmPassword"]);

    // Validate email and password format
    if (!validateEmail($email)) {
        echo "Invalid email format";
        exit;
    }
    if (!validatePassword($password)) {
        echo "Password must be at least 8 characters long and contain both letters and numbers";
        exit;
    }
    if ($password !== $confirmPassword) {
        echo "Passwords do not match"; // Password mismatch message
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL statement to insert a new student record
    $stmt = $conn->prepare("INSERT INTO students (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password); // Bind parameters to prevent SQL injection

    if ($stmt->execute()) { 
        $_SESSION['student_id'] = $conn->insert_id; 
        $_SESSION['email'] = $email; 
        $_SESSION['name'] = $name;
        header("Location: student_dashboard.php"); 
        exit;
    } else {
        echo "Error: " . $stmt->error; 
    }
}
?>
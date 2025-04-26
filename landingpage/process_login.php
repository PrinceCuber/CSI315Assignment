<?php
session_start(); // Start the session to track user login

// Database connection details
$servername = "localhost"; // Host
$username = "root"; // Database username (change it as needed)
$password = ""; // Database password (change it as needed)
$dbname = ""; // The database name

// Create connection to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$email = $_POST['email'];
$input_password = $_POST['password'];

// Validate the inputs (basic validation)
if (empty($email) || empty($input_password)) {
    echo "Please enter both email and password.";
    exit;
}

// Prepare and execute the SQL query to check for the email
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify the password (assuming passwords are stored as hashed)
    if (password_verify($input_password, $user['password'])) {
        // Password is correct, start session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Redirect to a protected page (dashboard or home)
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No user found with that email.";
}

$conn->close();
?>

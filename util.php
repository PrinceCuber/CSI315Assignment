<?php
function connectToDatabase() {
    $host = 'localhost';
    $db = 'school_management_system';
    $username = 'root';
    $password = '';

    $conn = new mysqli($host, $username, $password, $db);   

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function sanitizeInput($data) {
    $conn = connectToDatabase();
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    return strlen($password) >= 8 && preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password);
}
?>
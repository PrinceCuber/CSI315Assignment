<?php
session_start(); // Start the session
session_destroy(); // Destroy the session to log out the user
header("Location: student_login.html"); // Redirect to the home page after logout
?>
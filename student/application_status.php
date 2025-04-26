<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Application Status</title>
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

        .status-container {
            background-color: #e8f4ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }

        .status-container h2 {
            color: #00509e;
        }

        .status-container p {
            font-size: 18px;
            font-weight: bold;
        }

        .status-button {
            background-color: #00509e;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
            margin-top: 20px;
        }

        .status-button:hover {
            background-color: #003f7d;
        }

        .go-back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 20px;
            background-color: #00509e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }

        .go-back-btn:hover {
            background-color: #003f7d;
        }
    </style>
</head>
<body>

<main>
    <h1>Check Application Status</h1>

    <form method="post">
        <label for="application_id">Enter Your Application ID:</label>
        <input type="text" id="application_id" name="application_id" placeholder="Enter your ID" required style="width: 100%; padding: 10px; font-size: 16px; margin-top: 10px; margin-bottom: 20px;">
        
        <button type="submit" name="check_status" style="background-color: #00509e; color: white; padding: 12px 20px; font-size: 16px; border: none; border-radius: 5px; cursor: pointer; display: block; width: 100%;">Check Status</button>
    </form>

    <?php
    // Simulating a static application status for the purpose of the example.
    if (isset($_POST['check_status'])) {
        $application_id = $_POST['application_id'];

        // For demonstration, we will use a basic check to simulate different statuses.
        $status = 'Under Review'; // Replace with real status query from the database.
        
        // For example, you can have some conditional checks to simulate status based on the application ID.
        if ($application_id == '12345') {
            $status = 'Accepted';
        } elseif ($application_id == '54321') {
            $status = 'Rejected';
        }

        // Display the status to the student.
        echo "<div class='status-container'>";
        echo "<h2>Application Status for ID: $application_id</h2>";
        echo "<p>Status: <strong>$status</strong></p>";
        echo "</div>";
    }
    ?>

    <!-- Go Back Button -->
    <a href="student_dashboard.html" class="go-back-btn">Go Back</a>
</main>

</body>
</html>

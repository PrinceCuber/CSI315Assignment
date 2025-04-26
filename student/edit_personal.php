<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Application</title>
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

        .application-form {
            background-color: #e8f4ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .application-form h2 {
            color: #00509e;
        }

        .application-form label {
            display: block;
            margin-bottom: 10px;
        }

        .application-form input[type="text"],
        .application-form input[type="email"],
        .application-form input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <main>
        <h1>Edit Application</h1>

        <?php
        require_once '../util.php'; // Include the utility functions for database connection and sanitization

        $conn = connectToDatabase(); // Connect to the database

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $application_id = $_POST['application_id'];
            $name = sanitizeInput($_POST['name']);
            $email = sanitizeInput($_POST['email']);
            $phone = sanitizeInput($_POST['phone']);
            $address = sanitizeInput($_POST['address']);
            $resume = $_FILES['resume']['name'];

            // Validate inputs
            if (empty($name) || empty($email) || empty($phone) || empty($address)) {
                echo "<p style='color: red;'>All fields are required.</p>";
            } else {
                // Update application in the database
                $stmt = $conn->prepare("UPDATE applications SET name=?, email=?, phone=?, address=?, resume=? WHERE application_id=?");
                $stmt->bind_param("sssssi", $name, $email, $phone, $address, $resume, $application_id);

                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Application updated successfully.</p>";
                } else {
                    echo "<p style='color: red;'>Error updating application: " . $stmt->error . "</p>";
                }

                $stmt->close();
            }
        } else {
            // Fetch existing application details
            if (isset($_GET['application_id'])) {
                $application_id = $_GET['application_id'];
                $stmt = $conn->prepare("SELECT * FROM applications WHERE student_id=?");
                $stmt->bind_param("i", $_SESSION['student_id']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Display existing application details in the form
                    ?>
                    <div class="application-form">
                        <h2>Edit Your Application</h2>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($row['application_id']); ?>">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required>
                            <button type="submit">Update Application</button>
                        </form>
                    </div>
                    <?php
                } else {
                    echo "<p style='color: red;'>No application found.</p>";
                }
                $stmt->close();
            } else {
                echo "<p style='color: red;'>No application ID provided.</p>";
            }
        }
        $conn->close(); // Close the database connection
        ?>
    </main>
</body>

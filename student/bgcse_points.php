<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BGCSE Point Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
            color: #333;
        }

        main {
            background: white;
            padding: 25px;
            border-radius: 8px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        h1 {
            color: #003366;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        label {
            font-weight: bold;
        }

        select, button {
            padding: 10px;
            font-size: 16px;
            width: 100%;
        }

        button {
            background-color: #00509e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #003f7d;
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            background-color: #e8f4ff;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
        }
    </style>
</head>
<body>

<main>
    <h1>BGCSE Point Calculator</h1>
    <form method="post">
        <?php
        $grades = ['A*' => 8, 'A' => 7, 'B' => 6, 'C' => 5, 'D' => 4, 'E' => 3, 'F' => 2, 'G' => 1, 'U' => 0];
        for ($i = 1; $i <= 6; $i++) {
            echo "<label for='subject$i'>Subject $i Grade:</label>";
            echo "<select name='subject$i' required>";
            echo "<option value=''>-- Select Grade --</option>";
            foreach ($grades as $grade => $points) {
                echo "<option value='$points'>$grade</option>";
            }
            echo "</select>";
        }
        ?>
        <button type="submit" name="calculate">Calculate Total Points</button>
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $total = 0;
        for ($i = 1; $i <= 6; $i++) {
            $total += intval($_POST["subject$i"]);
        }
        echo "<div class='result'><strong>Total BGCSE Points: $total</strong></div>";
    }
    ?>
</main>

</body>
</html>

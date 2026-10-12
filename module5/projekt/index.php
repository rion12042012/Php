<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student = array(
        "name" => $_POST["name"],
        "age" => $_POST["age"],
        "activities" => $_POST["activities"],
        "completed" => $_POST["completed"]
    );

    $percentage = ($student["completed"] / $student["activities"]) * 100;

    if ($percentage <= 20) {
        $result = "Bad";
    } elseif ($percentage <= 40) {
        $result = "Good";
    } elseif ($percentage <= 60) {
        $result = "Very Good";
    } else {
        $result = "Excellent";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Activities</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: auto;
        }

        .form-box,
        .result-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            margin-bottom: 25px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #4facfe;
            border-bottom: 2px solid #4facfe;
            padding-bottom: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        input:focus {
            border-color: #4facfe;
            outline: none;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #4facfe;
            color: white;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #238be6;
        }

        .result {
            font-size: 18px;
            line-height: 1.8;
        }

        .excellent {
            color: green;
            font-weight: bold;
        }

        .very-good {
            color: #2196f3;
            font-weight: bold;
        }

        .good {
            color: orange;
            font-weight: bold;
        }

        .bad {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="form-box">

        <h1>Student Information</h1>

        <form method="POST">

            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter your name" required>

            <label>Age:</label>
            <input type="number" name="age" placeholder="Enter your age" required>

            <label>Number of Activities:</label>
            <input type="number" name="activities" placeholder="Enter number of activities" min="1" required>

            <label>Completed Activities:</label>
            <input type="number" name="completed" placeholder="Enter completed activities" min="0" required>

            <button type="submit">Show Result</button>

        </form>

    </div>


    <?php if (isset($student)) { ?>

        <div class="result-box">

            <h2>Student Result</h2>

            <div class="result">

                Name: <?php echo $student["name"]; ?><br>

                Age: <?php echo $student["age"]; ?><br>

                Number of Activities:
                <?php echo $student["activities"]; ?><br>

                Completed Activities:
                <?php echo $student["completed"]; ?><br>

                Percentage:
                <?php echo $percentage; ?>%<br>

                Result:
                <?php echo $result; ?>

            </div>

        </div>

    <?php } ?>

</div>

</body>
</html>

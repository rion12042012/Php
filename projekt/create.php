
<?php
include "config.php";

$message = "";

if (isset($_POST['save'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = (float) $_POST['price'];
    $image = trim($_POST['image']);

    if ($name === "" || $description === "" || $price <= 0) {
        $message = "Please fill in all required fields!";
    } else {

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO products (name, description, price, image)
             VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssds",
            $name,
            $description,
            $price,
            $image
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        } else {
            $message = "Something went wrong!";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | The Mint Coffee</title>

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #edf5ef;
            color: #234638;
        }

        header {
            background: #174c3c;
            color: white;
            text-align: center;
            padding: 30px 15px;
        }

        header h1 {
            margin: 0;
            font-size: 32px;
            letter-spacing: 3px;
        }

        header p {
            color: #c8e8d7;
        }

        .form-container {
            max-width: 600px;
            margin: 45px auto;
            padding: 35px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .form-container h2 {
            text-align: center;
            color: #174c3c;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 13px;
            margin-bottom: 20px;
            border: 1px solid #cbded2;
            border-radius: 9px;
            font-size: 15px;
            box-sizing: border-box;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #286b55;
            box-shadow: 0 0 5px #a4d4b8;
        }

        textarea {
            height: 110px;
            resize: vertical;
        }

        .save-btn {
            width: 100%;
            padding: 14px;
            background: #286b55;
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #174c3c;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #286b55;
            text-decoration: none;
            font-weight: bold;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        .message {
            background: #ffe4e4;
            color: #a32222;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        footer {
            background: #174c3c;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }

        @media(max-width: 650px) {
            .form-container {
                margin: 25px 15px;
                padding: 22px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>THE MINT COFFEE</h1>
    <p>Fresh Coffee • Fresh Moments</p>
</header>

<div class="form-container">

    <h2>Add New Product</h2>
    <p class="subtitle">Add a new delicious product to our menu.</p>

    <?php if ($message != "") { ?>
        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php } ?>

    <form method="POST">

        <label>Product Name</label>
        <input
            type="text"
            name="name"
            placeholder="Enter product name"
            required
        >

        <label>Description</label>
        <textarea
            name="description"
            placeholder="Describe your product..."
            required
        ></textarea>

        <label>Price (€)</label>
        <input
            type="number"
            name="price"
            step="0.01"
            min="0.01"
            placeholder="Example: 2.50"
            required
        >

        <label>Image Filename</label>
        <input
            type="text"
            name="image"
            placeholder="Example: coffee.jpg"
        >

        <button type="submit" name="save" class="save-btn">
            + Save Product
        </button>

    </form>

    <a href="index.php" class="back-btn">
        ← Back to Home
    </a>

</div>

<footer>
    <p>© 2026 The Mint Coffee | All Rights Reserved</p>
</footer>

</body>
</html>

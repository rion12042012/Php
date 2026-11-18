
<?php
include "config.php";

$message = "";

// Merr produktet nga databaza
$result = mysqli_query($conn, "SELECT * FROM products");

// Kontrollon nese eshte derguar porosia
if (isset($_POST['order'])) {

    $customer = trim($_POST['customer_name']);
    $phone = trim($_POST['phone']);
    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    // Kontrollon sasine
    if ($customer == "" || $phone == "" || $quantity < 1 || $quantity > 30) {

        $message = "Please complete all fields correctly!";

    } else {

        // Merr produktin nga databaza
        $sql = "SELECT * FROM products WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $product_id);

        mysqli_stmt_execute($stmt);

        $product_result = mysqli_stmt_get_result($stmt);

        $product = mysqli_fetch_assoc($product_result);

        if ($product) {

            $product_name = $product['name'];

            $total = $product['price'] * $quantity;

            // Regjistron porosine
            $sql = "INSERT INTO orders
            (customer_name, phone, product_name, quantity, total)
            VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "sssid",
                $customer,
                $phone,
                $product_name,
                $quantity,
                $total
            );

            if (mysqli_stmt_execute($stmt)) {

                $message = "Your order was successful! Total: " .
                number_format($total, 2) . " €";

            } else {

                $message = "Something went wrong!";

            }

        } else {

            $message = "Product not found!";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Order Food | The Mint Coffee</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <h1>THE MINT COFFEE</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="view.php">Menu</a>
        <a href="reservation.php">Reservation</a>
    </nav>

</header>

<div class="form-box">

    <h2>Order Your Food</h2>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="POST">

        <label>Your Name</label>

        <input
            type="text"
            name="customer_name"
            placeholder="Enter your name"
            required
        >

        <label>Phone Number</label>

        <input
            type="text"
            name="phone"
            placeholder="Enter your phone"
            required
        >

        <label>Select Product</label>

        <select name="product_id" required>

            <option value="">Choose Product</option>

            <?php

            mysqli_data_seek($result, 0);

            while ($row = mysqli_fetch_assoc($result)) {

            ?>

                <option value="<?php echo $row['id']; ?>">

                    <?php echo htmlspecialchars($row['name']); ?>

                    - <?php echo $row['price']; ?> €

                </option>

            <?php } ?>

        </select>

        <label>Quantity</label>

        <input
            type="number"
            name="quantity"
            min="1"
            max="30"
            placeholder="Enter quantity"
            required
        >

        <button type="submit" name="order">

            Place Order

        </button>

    </form>

    <a href="index.php">← Back to Home</a>

</div>

</body>

</html>


<?php
require_once __DIR__ . '/config.php';

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>Product System</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="index.php">Products</a>
    <a href="add.php">Add Product</a>
</div>

<div class="main">

    <h1>Products List</h1>

    <a href="add.php" class="btn">+ Add Product</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

        <tr>
            <td><?= $row['id'] ?></td>

            <td>
                <?= htmlspecialchars($row['name']) ?>
            </td>

            <td>
                <?= htmlspecialchars($row['description']) ?>
            </td>

            <td><?= $row['quantity'] ?></td>

            <td>
                <a class="edit"
                   href="edit.php?id=<?= $row['id'] ?>">
                   Edit
                </a>

                <a class="delete"
                   href="delete.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('Are you sure?')">
                   Delete
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>

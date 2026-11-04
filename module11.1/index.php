
<?php
include "config.php";

// Zgjedhim databazen
$conn->exec("USE db");

// Marrim perdoruesit nga tabela table
$sql = "SELECT * FROM `table`";
$stmt = $conn->query($sql);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Menaxhimi i përdoruesve</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
        }

        h2 {
            color: #333;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>

<div class="container">

    <h2 class="text-center mb-4">
        Menaxhimi i përdoruesve
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <a href="add.php" class="btn btn-primary mb-3">
                + Shto përdorues
            </a>

            <?php if (isset($_GET['added'])): ?>
                <div class="alert alert-success">
                    Përdoruesi u shtua me sukses!
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['updated'])): ?>
                <div class="alert alert-success">
                    Përdoruesi u ndryshua me sukses!
                </div>
            <?php endif; ?>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Veprime</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (count($users) > 0): ?>

                        <?php foreach ($users as $row): ?>

                            <tr>
                                <td>
                                    <?= htmlspecialchars($row['id']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['username']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['name']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['surname']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row['email']) ?>
                                </td>

                                <td>
                                    <a href="up.php?id=<?= urlencode($row['id']) ?>"
                                       class="btn btn-warning btn-sm">
                                        Ndrysho
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6">
                                Nuk ka përdorues të regjistruar.
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

</body>
</html>

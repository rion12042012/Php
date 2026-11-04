
<?php
include "config.php";

$message = "";

$id = $_GET['id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST['id'] ?? '';
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);

    if (
        $id !== "" &&
        $username !== "" &&
        $name !== "" &&
        $surname !== "" &&
        filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {

        $stmt = $conn->prepare(
            "UPDATE users
             SET username=?, name=?, surname=?, email=?
             WHERE id=?"
        );

        $stmt->bind_param(
            "sssss",
            $username,
            $name,
            $surname,
            $email,
            $id
        );

        if ($stmt->execute()) {
            header("Location: index.php?updated=1");
            exit;
        } else {
            $message = "Gabim gjatë ndryshimit!";
        }

        $stmt->close();

    } else {
        $message = "Plotësoni të gjitha fushat saktë!";
    }
}

if ($id === "") {
    die("ID nuk është dhënë!");
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("s", $id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();

if (!$user) {
    die("Përdoruesi nuk u gjet!");
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ndrysho përdorues</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:500px">

        <div class="card-body p-4">

            <h3 class="mb-4">Ndrysho përdoruesin</h3>

            <?php if ($message): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <input type="hidden" name="id"
                       value="<?= htmlspecialchars($user['id']) ?>">

                <label class="form-label">Username</label>
                <input type="text" name="username"
                       class="form-control mb-3"
                       value="<?= htmlspecialchars($user['username']) ?>"
                       required>

                <label class="form-label">Name</label>
                <input type="text" name="name"
                       class="form-control mb-3"
                       value="<?= htmlspecialchars($user['name']) ?>"
                       required>

                <label class="form-label">Surname</label>
                <input type="text" name="surname"
                       class="form-control mb-3"
                       value="<?= htmlspecialchars($user['surname']) ?>"
                       required>

                <label class="form-label">Email</label>
                <input type="email" name="email"
                       class="form-control mb-3"
                       value="<?= htmlspecialchars($user['email']) ?>"
                       required>

                <button type="submit"
                        class="btn btn-primary w-100">
                    Ruaj ndryshimet
                </button>

            </form>

            <a href="index.php"
               class="btn btn-secondary w-100 mt-2">
                Kthehu
            </a>

        </div>
    </div>

</div>

</body>
</html>

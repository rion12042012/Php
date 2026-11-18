
<?php
include 'config.php';

$totalQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$totalStudents = mysqli_fetch_assoc($totalQuery)['total'];

$courseQuery = mysqli_query($conn, "SELECT COUNT(DISTINCT course) AS total FROM students");
$totalCourses = mysqli_fetch_assoc($courseQuery)['total'];

$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h3>Student Panel</h3>
    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="#students">All Students</a>
    <a href="add.php">Add Student</a>
</div>

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Dashboard</h2>
            <p class="text-muted">Welcome to Student Management System</p>
        </div>

        <a href="add.php" class="btn btn-primary">+ Add Student</a>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card-box">
                <h6>Total Students</h6>
                <h2><?php echo $totalStudents; ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <h6>Total Courses</h6>
                <h2><?php echo $totalCourses; ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <h6>System Status</h6>
                <h2 class="text-success">Active</h2>
            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0 p-4" id="students">

        <h4 class="mb-4">All Students</h4>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(mysqli_num_rows($result) > 0): ?>

                    <?php while($row = mysqli_fetch_assoc($result)): ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>

                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>"
                               class="btn btn-success btn-sm">Edit</a>

                            <form action="delete.php" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure?');">

                                <input type="hidden" name="id"
                                       value="<?php echo $row['id']; ?>">

                                <button type="submit"
                                        class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="7" class="text-center">
                            No students found.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>

<?php include 'db.php'; ?>
include 'session.php';

<!DOCTYPE html>
<html>
<head>
    <title>Add Student Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="view_result.php">🎓 Result Manager</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="add_result.php">Add Result</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_result.php">View Results</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Enter Student Result</h2>

        <form method="post" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Roll No:</label>
                <input type="text" name="roll_no" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Subject:</label>
                <input type="text" name="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Marks:</label>
                <input type="number" name="marks" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">Submit Result</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $roll_no = $_POST['roll_no'];
            $subject = $_POST['subject'];
            $marks = $_POST['marks'];

            $sql = "INSERT INTO students (name, roll_no, subject, marks)
                    VALUES ('$name', '$roll_no', '$subject', '$marks')";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-4'>Result added successfully!</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>

        <div class="text-center mt-3">
            <a href="view_result.php" class="btn btn-outline-secondary">View Results</a>
        </div>
    </div>
</body>
</html>

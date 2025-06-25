<?php include 'db.php'; ?>
include 'session.php';

<!DOCTYPE html>
<html>
<head>
    <title>View Student Results</title>
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
        <h2 class="mb-4 text-center">Student Result List</h2>

        <?php
        // Handle delete action
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $delete_sql = "DELETE FROM students WHERE id = $delete_id";
            mysqli_query($conn, $delete_sql);
            echo "<div class='alert alert-warning'>Record deleted successfully.</div>";
        }
        ?>
        <form method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search by name or roll no..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="view_result.php" class="btn btn-secondary">Reset</a>
    </div>
</form>


        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Roll No</th>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM students 
            WHERE name LIKE '%$search%' 
               OR roll_no LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM students";
}

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['name']."</td>
                                <td>".$row['roll_no']."</td>
                                <td>".$row['subject']."</td>
                                <td>".$row['marks']."</td>
                                <td>
                                    <a href='edit_result.php?edit_id=".$row['id']."' class='btn btn-sm btn-warning'>Edit</a>
                                    <a href='view_result.php?delete_id=".$row['id']."' 
                                       onclick=\"return confirm('Are you sure you want to delete this record?');\" 
                                       class='btn btn-sm btn-danger mt-1'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No results found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="add_result.php" class="btn btn-primary">Add New Result</a>
        </div>
    </div>
</body>
</html>

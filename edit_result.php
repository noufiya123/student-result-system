<?php include 'db.php'; ?>
include 'session.php';

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Student Result</h2>

    <?php
    if (isset($_GET['edit_id'])) {
        $id = $_GET['edit_id'];
        $sql = "SELECT * FROM students WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $roll_no = $_POST['roll_no'];
        $subject = $_POST['subject'];
        $marks = $_POST['marks'];

        $update_sql = "UPDATE students SET 
                        name='$name', 
                        roll_no='$roll_no', 
                        subject='$subject', 
                        marks='$marks' 
                        WHERE id=$id";

        if (mysqli_query($conn, $update_sql)) {
            echo "<div class='alert alert-success'>Result updated successfully!</div>";
            echo "<a href='view_result.php' class='btn btn-secondary mt-3'>Back to Result List</a>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Update failed.</div>";
        }
    }
    ?>

    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" value="<?php echo $data['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Roll No:</label>
            <input type="text" name="roll_no" class="form-control" value="<?php echo $data['roll_no']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject:</label>
            <input type="text" name="subject" class="form-control" value="<?php echo $data['subject']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Marks:</label>
            <input type="number" name="marks" class="form-control" value="<?php echo $data['marks']; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary w-100">Update Result</button>
    </form>
</div>
</body>
</html>

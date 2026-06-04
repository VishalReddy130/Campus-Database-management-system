<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>University Portal</h1>
        </div>
        <div class="nav-links">
            <a href="view_students.php">Students</a>
            <a href="view_faculty.php">Faculty</a>
            <a href="view_courses.php">Courses</a>
            <a href="view_subjects.php">Subjects</a>
            <a href="view_exams.php">Exams</a>
        </div>
    </nav>

    <h2>Department List</h2>
    <table>
        <thead>
            <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                <th>Head of Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Department";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Department_ID']}</td>
                            <td>{$row['Name']}</td>
                            <td>{$row['Head_of_Department']}</td>
                            <td class='actions'>
                                <form action='delete_department.php' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this department?');\">
                                    <input type='hidden' name='department_id' value='{$row['Department_ID']}'>
                                    <input type='submit' value='Delete' class='delete-button'>
                                </form>
                                <a href='edit_department.php?id={$row['Department_ID']}' class='update-button'>Update</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='no-data'>No departments found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index.php" class="back-link">Back to Home</a>

</body>
</html>

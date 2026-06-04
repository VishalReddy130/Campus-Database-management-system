<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Faculty List</title>
</head>
<body>
    <nav>
        <div class="logo">
            <h1>University Portal</h1>
        </div>
        <div class="nav-links">
            <a href="view_students.php">Students</a>
            <a href="view_departments.php">Departments</a>
            <a href="view_courses.php">Courses</a>
            <a href="view_subjects.php">Subjects</a>
            <a href="view_exams.php">Exams</a>
        </div>
    </nav>

    <h2>Faculty List</h2>
    <table>
        <tr>
            <th>Faculty ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Designation</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT Faculty.Faculty_ID, Faculty.Name, Faculty.Email, Faculty.Phone, Faculty.Designation, Department.Name AS Dept
                FROM Faculty
                LEFT JOIN Department ON Faculty.Department_ID = Department.Department_ID";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Faculty_ID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['Phone']}</td>
                    <td>{$row['Designation']}</td>
                    <td>{$row['Dept']}</td>
                    <td>
                        <form action='delete_faculty.php' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this faculty member?');\" style='display:inline;'>
                            <input type='hidden' name='faculty_id' value='{$row['Faculty_ID']}'>
                            <input type='submit' value='Delete' class='delete-button'>
                        </form>
                        <a href='edit_faculty.php?id={$row['Faculty_ID']}' class='update-button'>Update</a>
                  </td>   
                  </tr>";
        }
        ?>
    </table>

    <a href="index.php" class="back-link">Back</a>
</body>
</html>

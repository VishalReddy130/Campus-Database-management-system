<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>University Portal</h1>
        </div>
        <div class="nav-links">
            <a href="view_faculty.php">Faculty</a>
            <a href="view_departments.php">Departments</a>
            <a href="view_courses.php">Courses</a>
            <a href="view_subjects.php">Subjects</a>
            <a href="view_exams.php">Exams</a>
        </div>
    </nav>
    <h2>Student List</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Department</th><th>Action</th>
        </tr>
        <?php
        $sql = "SELECT Student.Student_ID, Student.Name, Email, Phone, Department.Name AS Dept
                FROM Student
                LEFT JOIN Department ON Student.Department_ID = Department.Department_ID";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Student_ID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['Phone']}</td>
                    <td>{$row['Dept']}</td>
        
                    <td>
                        <form action='delete_student.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this student?\");' style='display:inline;'>
                            <input type='hidden' name='student_id' value='{$row['Student_ID']}'>
                            <input type='submit' value='Delete' class='delete-button'>
                        </form>
    <a href='edit_student.php?id={$row['Student_ID']}' class='update-button'>Update</a>
</td>
                  </tr>";
        }
        ?>
    </table>
    <a href="index.php" class="back-link">Back</a>
</body>
</html>

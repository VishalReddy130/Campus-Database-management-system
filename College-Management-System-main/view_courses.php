<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Courses List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a href="view_departments.php">Departments</a>
            <a href="view_subjects.php">Subjects</a>
            <a href="view_exams.php">Exams</a>
        </div>
    </nav>

   

        <?php
        if (isset($_GET['success'])) {
            echo '<div class="message success">Course updated successfully!</div>';
        } elseif (isset($_GET['error'])) {
            echo '<div class="message error">Error updating course</div>';
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th>Department</th>
                    <th>Faculty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT Course.Course_ID, Course.Course_Name, Course.Credits, 
                               Department.Name AS Dept, Faculty.Name AS Faculty
                        FROM Course
                        LEFT JOIN Department ON Course.Department_ID = Department.Department_ID
                        LEFT JOIN Faculty ON Course.Faculty_ID = Faculty.Faculty_ID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['Course_ID']}</td>
                                <td>{$row['Course_Name']}</td>
                                <td>{$row['Credits']}</td>
                                <td>{$row['Dept']}</td>
                                <td>{$row['Faculty']}</td>
                                <td class='actions'>
                                    
                                    <form action='delete_course.php' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this course?');\">
                                        <input type='hidden' name='course_id' value='{$row['Course_ID']}'>
                                        <input type='submit' value='Delete' class='delete-button'>
                                    </form>
                                    <a href='edit_course.php?id={$row['Course_ID']}' class='update-button'>Update</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-data'>No courses found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>
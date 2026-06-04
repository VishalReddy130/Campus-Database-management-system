<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subject List</title>
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
            <a href="view_courses.php">Courses</a>
            <a href="view_exams.php">Exams</a>
        </div>
    </nav>

   
        <?php
        if (isset($_GET['success'])) {
            echo '<div class="message success">Subject updated successfully!</div>';
        } elseif (isset($_GET['error'])) {
            echo '<div class="message error">Error updating subject</div>';
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Subject ID</th>
                    <th>Subject Name</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT Subject.Subject_ID, Subject.Subject_Name, Course.Course_Name, Subject.Course_ID
                        FROM Subject
                        LEFT JOIN Course ON Subject.Course_ID = Course.Course_ID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['Subject_ID']}</td>
                                <td>{$row['Subject_Name']}</td>
                                <td>{$row['Course_Name']}</td>
                                <td class='actions'>
                                    
                                    <form action='delete_subject.php' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this subject?');\">
                                        <input type='hidden' name='subject_id' value='{$row['Subject_ID']}'>
                                        <input type='submit' value='Delete' class='delete-button'>
                                    </form>
                                    <a href='edit_subject.php?id={$row['Subject_ID']}' class='update-button'>Update</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='no-data'>No subjects found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam List</title>
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
            <a href="view_subjects.php">Subjects</a>
        </div>
    </nav>

    

        <?php
        if (isset($_GET['success'])) {
            echo '<div class="message success">Exam updated successfully!</div>';
        } elseif (isset($_GET['error'])) {
            echo '<div class="message error">Error updating exam</div>';
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Exam ID</th>
                    <th>Subject</th>
                    <th>Exam Date</th>
                    <th>Marks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT Exam.Exam_ID, Exam.Subject_ID, Subject.Subject_Name, 
                               Exam.Exam_Date, Exam.Marks
                        FROM Exam
                        LEFT JOIN Subject ON Exam.Subject_ID = Subject.Subject_ID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['Exam_ID']}</td>
                                <td>{$row['Subject_Name']}</td>
                                <td>" . date('Y-m-d', strtotime($row['Exam_Date'])) . "</td>
                                <td>{$row['Marks']}</td>
                                <td class='actions'>
                                    <form action='delete_exam.php' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this exam?');\">
                                        <input type='hidden' name='exam_id' value='{$row['Exam_ID']}'>
                                        <input type='submit' value='Delete' class='delete-button'>
                                    </form>
                                        <a href='edit_exam.php?id={$row['Exam_ID']}' class='update-button'>Update</a>

                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='no-data'>No exams found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>
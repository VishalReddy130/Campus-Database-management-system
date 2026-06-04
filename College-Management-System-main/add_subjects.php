<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Subject</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            color: black;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
        }
        table td {
            padding: 10px;
        }
        input[type="text"],
        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #0071b3;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #004c8c;
        }
        .message {
            text-align: center;
            color: green;
            margin-top: 20px;
        }
        .error {
            color: red;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color:rgb(255, 255, 255);
            text-decoration: underline;
        }
    </style>
</head>
<body>
<nav>
    <div class="logo"><h1>University Portal</h1></div>
    <div class="nav-links">
    <a href="view_students.php">Students</a>
                <a href="view_faculty.php">Faculty</a>
                <a href="view_departments.php">Departments</a>
                <a href="view_courses.php">Courses</a>
                <a href="view_subjects.php">Subjects</a>
                <a href="view_exams.php">Exams</a>
    </div>
</nav>

<div class="form-container">
    <h2>Add New Subject</h2>
    <form method="POST">
        <table>
            <tr>
                <td><label>Subject Name:</label></td>
                <td><input type="text" name="subject_name" required></td>
            </tr>
            <tr>
                <td><label>Course:</label></td>
                <td>
                    <select name="course_id" required>
                        <option value="">Select Course</option>
                        <?php
                        $result = $conn->query("SELECT Course_ID, Course_Name FROM Course");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['Course_ID']}'>{$row['Course_Name']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add Subject"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $stmt = $conn->prepare("INSERT INTO Subject (Subject_Name, Course_ID) VALUES (?, ?)");
        $stmt->bind_param("si", $_POST['subject_name'], $_POST['course_id']);

        if ($stmt->execute()) {
            echo "<div class='message'>Subject added successfully.</div>";
        } else {
            echo "<div class='message error'>Error: " . $stmt->error . "</div>";
        }
    }
    ?>
    <a class="back-link" href="index.php">← Back to Home</a>
</div>
</body>
</html>

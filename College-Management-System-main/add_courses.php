<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Course</title>
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
            color: black;
            text-align: center;
            margin-bottom: 25px;
        }
        form input[type="text"],
        form input[type="number"],
        form select,
        form input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[type="submit"] {
            background-color: #0071b3;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #004c8c;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color:rgb(234, 234, 234);
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
        <h2>Add New Course</h2>
        <form method="POST" action="">
            <input type="text" name="course_name" placeholder="Course Name" required>
            <input type="number" name="credits" placeholder="Credits" required min="1" max="10">

            <select name="department_id" required>
                <option value="">-- Select Department --</option>
                <?php
                $result = $conn->query("SELECT Department_ID, Name FROM Department");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['Department_ID']}'>{$row['Name']}</option>";
                }
                ?>
            </select>

            <select name="faculty_id">
                <option value="">-- Optional: Assign Faculty --</option>
                <?php
                $result = $conn->query("SELECT Faculty_ID, Name FROM Faculty");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['Faculty_ID']}'>{$row['Name']}</option>";
                }
                ?>
            </select>

            <input type="submit" name="submit" value="Add Course">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $stmt = $conn->prepare("INSERT INTO Course (Course_Name, Credits, Department_ID, Faculty_ID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $_POST['course_name'], $_POST['credits'], $_POST['department_id'], $_POST['faculty_id']);
            
            // Convert empty faculty to NULL
            if (empty($_POST['faculty_id'])) {
                $stmt->bind_param("sii", $_POST['course_name'], $_POST['credits'], $_POST['department_id']);
                $stmt = $conn->prepare("INSERT INTO Course (Course_Name, Credits, Department_ID) VALUES (?, ?, ?)");
            }

            if ($stmt->execute()) {
                echo "<div class='message'>Course added successfully.</div>";
            } else {
                echo "<div class='message error'>Error: " . $stmt->error . "</div>";
            }
        }
        ?>

        <a class="back-link" href="index.php">← Back to Home</a>
    </div>
</body>
</html>

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Department</title>
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
            font-size: 16px;
            cursor: pointer;
            border: none;
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
            color:rgb(255, 255, 255);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
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
    </header>

    <div class="form-container">
        <h2>Add New Department</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Department Name" required>
            <input type="text" name="hod" placeholder="Head of Department" required>
            <input type="submit" name="submit" value="Add Department">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $stmt = $conn->prepare("INSERT INTO Department (Name, Head_of_Department) VALUES (?, ?)");
            $stmt->bind_param("ss", $_POST['name'], $_POST['hod']);

            if ($stmt->execute()) {
                echo "<div class='message'>Department added successfully.</div>";
            } else {
                echo "<div class='message error'>Error: " . $stmt->error . "</div>";
            }
        }
        ?>

        <a class="back-link" href="index.php">← Back to Home</a>
    </div>
</body>
</html>

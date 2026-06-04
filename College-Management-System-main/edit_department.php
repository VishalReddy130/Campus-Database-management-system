<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Department</title>
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
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 25px;
        }

        form input[type="text"],
        form select {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        form input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            transition: var(--transition);
        }

        form input[type="submit"]:hover {
            background-color: var(--primary-dark);
        }

        .message {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
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

    <div class="form-container">
        <h2>Edit Department</h2>
        
        <?php
        if (isset($_GET['id'])) {
            $dept_id = intval($_GET['id']);
            $sql = "SELECT * FROM Department WHERE Department_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $dept_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $department = $result->fetch_assoc();
        ?>
        
        <form method="POST" action="update_department.php">
            <input type="hidden" name="department_id" value="<?php echo $department['Department_ID']; ?>">
            
            <label for="name">Department Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($department['Name']); ?>" required>
            
            <label for="hod">Head of Department</label>
            <input type="text" id="hod" name="hod" value="<?php echo htmlspecialchars($department['Head_of_Department']); ?>" required>
            
            <input type="submit" name="submit" value="Update Department">
        </form>
        
        <?php
            } else {
                echo '<div class="message error">Department not found</div>';
            }
            $stmt->close();
        } else {
            echo '<div class="message error">Invalid request</div>';
        }
        ?>
        
        <a href="view_departments.php" class="back-link">← Back to Departments</a>
    </div>
</body>
</html>
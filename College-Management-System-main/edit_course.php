<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Course</title>
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
        form input[type="number"],
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
            <a href="view_departments.php">Departments</a>
            <a href="view_subjects.php">Subjects</a>
            <a href="view_exams.php">Exams</a>
        </div>
    </nav>

    <div class="form-container">
        <h2>Edit Course</h2>
        
        <?php
        if (isset($_GET['id'])) {
            $course_id = intval($_GET['id']);
            $sql = "SELECT * FROM Course WHERE Course_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $course_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $course = $result->fetch_assoc();
        ?>
        
        <form method="POST" action="update_course.php">
            <input type="hidden" name="course_id" value="<?php echo $course['Course_ID']; ?>">
            
            <label for="name">Course Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($course['Course_Name']); ?>" required>
            
            <label for="credits">Credits</label>
            <input type="number" id="credits" name="credits" min="1" max="10" value="<?php echo $course['Credits']; ?>" required>
            
            <label for="department">Department</label>
            <select id="department" name="department_id" required>
                <option value="">Select Department</option>
                <?php
                $deptQuery = "SELECT * FROM Department";
                $deptResult = $conn->query($deptQuery);
                while ($dept = $deptResult->fetch_assoc()) {
                    $selected = ($dept['Department_ID'] == $course['Department_ID']) ? 'selected' : '';
                    echo "<option value='{$dept['Department_ID']}' $selected>{$dept['Name']}</option>";
                }
                ?>
            </select>
            
            <label for="faculty">Faculty</label>
            <select id="faculty" name="faculty_id" required>
                <option value="">Select Faculty</option>
                <?php
                $facultyQuery = "SELECT * FROM Faculty";
                $facultyResult = $conn->query($facultyQuery);
                while ($faculty = $facultyResult->fetch_assoc()) {
                    $selected = ($faculty['Faculty_ID'] == $course['Faculty_ID']) ? 'selected' : '';
                    echo "<option value='{$faculty['Faculty_ID']}' $selected>{$faculty['Name']}</option>";
                }
                ?>
            </select>
            
            <input type="submit" name="submit" value="Update Course">
        </form>
        
        <?php
            } else {
                echo '<div class="message error">Course not found</div>';
            }
            $stmt->close();
        } else {
            echo '<div class="message error">Invalid request</div>';
        }
        ?>
        
        <a href="view_courses.php" class="back-link">← Back to Courses</a>
    </div>
</body>
</html>
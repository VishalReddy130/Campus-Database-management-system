<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Subject</title>
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
            <a href="view_courses.php">Courses</a>
            <a href="view_exams.php">Exams</a>
        </div>
    </nav>

    <div class="form-container">
        <h2>Edit Subject</h2>
        
        <?php
        if (isset($_GET['id'])) {
            $subject_id = intval($_GET['id']);
            $sql = "SELECT * FROM Subject WHERE Subject_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $subject_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $subject = $result->fetch_assoc();
        ?>
        
        <form method="POST" action="update_subject.php">
            <input type="hidden" name="subject_id" value="<?php echo $subject['Subject_ID']; ?>">
            
            <label for="name">Subject Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($subject['Subject_Name']); ?>" required>
            
            <label for="course">Course</label>
            <select id="course" name="course_id" required>
                <option value="">Select Course</option>
                <?php
                $courseQuery = "SELECT * FROM Course";
                $courseResult = $conn->query($courseQuery);
                while ($course = $courseResult->fetch_assoc()) {
                    $selected = ($course['Course_ID'] == $subject['Course_ID']) ? 'selected' : '';
                    echo "<option value='{$course['Course_ID']}' $selected>{$course['Course_Name']}</option>";
                }
                ?>
            </select>
            
            <input type="submit" name="submit" value="Update Subject">
        </form>
        
        <?php
            } else {
                echo '<div class="message error">Subject not found</div>';
            }
            $stmt->close();
        } else {
            echo '<div class="message error">Invalid request</div>';
        }
        ?>
        
        <a href="view_subjects.php" class="back-link">← Back to Subjects</a>
    </div>
</body>
</html>
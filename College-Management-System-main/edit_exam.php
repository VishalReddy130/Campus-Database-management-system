<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Exam</title>
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
        form input[type="date"],
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
            <a href="view_courses.php">Courses</a>
            <a href="view_subjects.php">Subjects</a>
        </div>
    </nav>

    <div class="form-container">
        <h2>Edit Exam</h2>
        
        <?php
        if (isset($_GET['id'])) {
            $exam_id = intval($_GET['id']);
            $sql = "SELECT * FROM Exam WHERE Exam_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $exam_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $exam = $result->fetch_assoc();
        ?>
        
        <form method="POST" action="update_exam.php">
            <input type="hidden" name="exam_id" value="<?php echo $exam['Exam_ID']; ?>">
            
            <label for="subject">Subject</label>
            <select id="subject" name="subject_id" required>
                <option value="">Select Subject</option>
                <?php
                $subjectQuery = "SELECT * FROM Subject";
                $subjectResult = $conn->query($subjectQuery);
                while ($subject = $subjectResult->fetch_assoc()) {
                    $selected = ($subject['Subject_ID'] == $exam['Subject_ID']) ? 'selected' : '';
                    echo "<option value='{$subject['Subject_ID']}' $selected>{$subject['Subject_Name']}</option>";
                }
                ?>
            </select>
            
            <label for="date">Exam Date</label>
            <input type="date" id="date" name="exam_date" value="<?php echo date('Y-m-d', strtotime($exam['Exam_Date'])); ?>" required>
            
            <label for="marks">Marks</label>
            <input type="number" id="marks" name="marks" min="0" max="100" value="<?php echo $exam['Marks']; ?>" required>
            
            <input type="submit" name="submit" value="Update Exam">
        </form>
        
        <?php
            } else {
                echo '<div class="message error">Exam not found</div>';
            }
            $stmt->close();
        } else {
            echo '<div class="message error">Invalid request</div>';
        }
        ?>
        
        <a href="view_exams.php" class="back-link">← Back to Exams</a>
    </div>
</body>
</html>
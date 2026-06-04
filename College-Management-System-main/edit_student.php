<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
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
        form input[type="email"],
        form input[type="date"],
        form select {
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
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
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
    </style>
</head>
<body>
    <header>
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
                <a href="view_exams.php">Exams</a>
            </div>
        </nav>
    </header>

    <div class="form-container">
        <h2>Edit Student</h2>

        <?php
        if (isset($_GET['id'])) {
            $student_id = intval($_GET['id']);
            $sql = "SELECT * FROM Student WHERE Student_ID = $student_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
        ?>

        <form method="POST" action="update_student.php">
            <input type="hidden" name="student_id" value="<?php echo $student['Student_ID']; ?>">
            <input type="hidden" name="last_updated" value="<?php echo $student['last_updated']; ?>">

            <input type="text" name="name" placeholder="Full Name" value="<?php echo $student['Name']; ?>" required>
            <input type="date" name="dob" value="<?php echo $student['Date_of_Birth']; ?>" required>
            <input type="email" name="email" placeholder="Email Address" value="<?php echo $student['Email']; ?>" required>
            <input type="text" name="phone" placeholder="Phone Number" value="<?php echo $student['Phone']; ?>" required>
            <input type="text" name="address" placeholder="Address" value="<?php echo $student['Address']; ?>">

            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php
                $deptQuery = "SELECT * FROM Department";
                $deptResult = $conn->query($deptQuery);
                while ($dept = $deptResult->fetch_assoc()) {
                    $selected = ($dept['Department_ID'] == $student['Department_ID']) ? 'selected' : '';
                    echo "<option value='{$dept['Department_ID']}' $selected>{$dept['Name']}</option>";
                }
                ?>
            </select>

            <input type="submit" name="submit" value="Update Student">
        </form>

        <?php
            } else {
                echo "<div class='message error'>Student not found</div>";
            }
        } else {
            echo "<div class='message error'>Invalid request</div>";
        }
        ?>

        <a class="back-link" href="view_students.php">← Back to Students</a>
    </div>
</body>
</html>
        
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Faculty</title>
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
        <h2>Edit Faculty Member</h2>
        
        <?php
        if (isset($_GET['id'])) {
            $faculty_id = intval($_GET['id']);
            $sql = "SELECT * FROM Faculty WHERE Faculty_ID = $faculty_id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $faculty = $result->fetch_assoc();
        ?>
        
        <form method="POST" action="update_faculty.php">
            <input type="hidden" name="faculty_id" value="<?php echo $faculty['Faculty_ID']; ?>">
            <input type="text" name="name" placeholder="Full Name" value="<?php echo $faculty['Name']; ?>" required>
            <input type="email" name="email" placeholder="Email Address" value="<?php echo $faculty['Email']; ?>" required>
            <input type="text" name="phone" placeholder="Phone Number" value="<?php echo $faculty['Phone']; ?>" required>
            <input type="text" name="designation" placeholder="Designation" value="<?php echo $faculty['Designation']; ?>" required>
            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php
                $deptQuery = "SELECT * FROM Department";
                $deptResult = $conn->query($deptQuery);
                while ($dept = $deptResult->fetch_assoc()) {
                    $selected = ($dept['Department_ID'] == $faculty['Department_ID']) ? 'selected' : '';
                    echo "<option value='{$dept['Department_ID']}' $selected>{$dept['Name']}</option>";
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Update Faculty">
        </form>
        
        <?php
            } else {
                echo "<div class='message error'>Faculty member not found</div>";
            }
        } else {
            echo "<div class='message error'>Invalid request</div>";
        }
        ?>
        
        <a class="back-link" href="view_faculty.php">← Back to Faculty</a>
    </div>
</body>
</html>
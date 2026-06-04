<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Faculty</title>
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
        <h2>Add New Faculty</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="text" name="designation" placeholder="Designation" required>
            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php
                $deptQuery = "SELECT * FROM Department";
                $deptResult = $conn->query($deptQuery);
                while ($dept = $deptResult->fetch_assoc()) {
                    echo "<option value='{$dept['Department_ID']}'>{$dept['Name']}</option>";
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Add Faculty">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $stmt = $conn->prepare("INSERT INTO Faculty (Name, Email, Phone, Designation, Department_ID)
                                    VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['designation'], $_POST['department_id']);

            if ($stmt->execute()) {
                echo "<div class='message'>Faculty added successfully.</div>";
            } else {
                echo "<div class='message error'>Error: " . $stmt->error . "</div>";
            }
        }
        ?>

        <a class="back-link" href="index.php">← Back to Home</a>
    </div>

    <?php
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    
    ?>
</body>
</html>

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Exam</title>
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
        input[type="date"],
        input[type="number"],
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
    <h2>Add New Exam</h2>
    <form method="POST">
        <table>
            <tr>
                <td><label>Exam Date:</label></td>
                <td><input type="date" name="exam_date" required></td>
            </tr>
            <tr>
                <td><label>Marks:</label></td>
                <td><input type="number" name="marks" min="0" required></td>
            </tr>
            <tr>
                <td><label>Subject:</label></td>
                <td>
                    <select name="subject_id" required>
                        <option value="">Select Subject</option>
                        <?php
                        $result = $conn->query("SELECT Subject_ID, Subject_Name FROM Subject");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['Subject_ID']}'>{$row['Subject_Name']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add Exam"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $stmt = $conn->prepare("INSERT INTO Exam (Exam_Date, Subject_ID, Marks) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $_POST['exam_date'], $_POST['subject_id'], $_POST['marks']);

        if ($stmt->execute()) {
            echo "<div class='message'>Exam added successfully.</div>";
        } else {
            echo "<div class='message error'>Error: " . $stmt->error . "</div>";
        }
    }
    ?>
    <a class="back-link" href="index.php">← Back to Home</a>
</div>
</body>
</html>

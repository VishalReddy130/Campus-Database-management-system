<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $course_id = intval($_POST['course_id']);
    $name = trim($_POST['name']);
    $credits = intval($_POST['credits']);
    $dept_id = intval($_POST['department_id']);
    $faculty_id = intval($_POST['faculty_id']);

    // Basic validation
    if (empty($name) || $credits < 1 || $credits > 10 || $dept_id <= 0 || $faculty_id <= 0) {
        header("Location: view_courses.php?error=1");
        exit();
    }

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE Course SET 
                          Course_Name = ?, 
                          Credits = ?, 
                          Department_ID = ?, 
                          Faculty_ID = ? 
                          WHERE Course_ID = ?");
    $stmt->bind_param("siiii", $name, $credits, $dept_id, $faculty_id, $course_id);

    // Execute and handle result
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: view_courses.php?success=1");
        } else {
            header("Location: view_courses.php?info=1");
        }
    } else {
        header("Location: view_courses.php?error=1");
    }

    $stmt->close();
} else {
    header("Location: view_courses.php");
}

$conn->close();
?>
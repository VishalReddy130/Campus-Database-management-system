<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $subject_id = intval($_POST['subject_id']);
    $name = trim($_POST['name']);
    $course_id = intval($_POST['course_id']);

    // Basic validation
    if (empty($name) || $course_id <= 0) {
        header("Location: view_subjects.php?error=1");
        exit();
    }

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE Subject SET 
                          Subject_Name = ?, 
                          Course_ID = ? 
                          WHERE Subject_ID = ?");
    $stmt->bind_param("sii", $name, $course_id, $subject_id);

    // Execute and handle result
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: view_subjects.php?success=1");
        } else {
            header("Location: view_subjects.php?info=1");
        }
    } else {
        header("Location: view_subjects.php?error=1");
    }

    $stmt->close();
} else {
    header("Location: view_subjects.php");
}

$conn->close();
?>
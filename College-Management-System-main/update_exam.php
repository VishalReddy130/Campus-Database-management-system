<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $exam_id = intval($_POST['exam_id']);
    $subject_id = intval($_POST['subject_id']);
    $exam_date = $_POST['exam_date'];
    $marks = intval($_POST['marks']);

    // Basic validation
    if ($subject_id <= 0 || empty($exam_date) || $marks < 0 || $marks > 100) {
        header("Location: view_exams.php?error=1");
        exit();
    }

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE Exam SET 
                          Subject_ID = ?, 
                          Exam_Date = ?, 
                          Marks = ? 
                          WHERE Exam_ID = ?");
    $stmt->bind_param("isii", $subject_id, $exam_date, $marks, $exam_id);

    // Execute and handle result
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: view_exams.php?success=1");
        } else {
            header("Location: view_exams.php?info=1");
        }
    } else {
        header("Location: view_exams.php?error=1");
    }

    $stmt->close();
} else {
    header("Location: view_exams.php");
}

$conn->close();
?>
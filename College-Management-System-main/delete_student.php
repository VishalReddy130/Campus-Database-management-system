<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = intval($_POST['student_id']);
    
    // Delete student query
    $sql = "DELETE FROM Student WHERE Student_ID = $student_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_students.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: view_students.php");
    exit();
}
?>

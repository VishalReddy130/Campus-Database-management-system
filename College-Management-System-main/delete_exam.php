<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exam_id'])) {
    $exam_id = $_POST['exam_id'];
    $sql = "DELETE FROM Exam WHERE Exam_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $exam_id);

    if ($stmt->execute()) {
        header("Location: view_exams.php");
    } else {
        echo "Error deleting exam: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

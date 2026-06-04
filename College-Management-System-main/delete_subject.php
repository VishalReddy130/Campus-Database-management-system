<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['subject_id'])) {
    $subject_id = $_POST['subject_id'];
    $sql = "DELETE FROM Subject WHERE Subject_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $subject_id);

    if ($stmt->execute()) {
        header("Location: view_subjects.php");
    } else {
        echo "Error deleting subject: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

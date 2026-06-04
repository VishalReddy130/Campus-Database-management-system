<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['faculty_id'])) {
    $faculty_id = $_POST['faculty_id'];
    $sql = "DELETE FROM Faculty WHERE Faculty_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $faculty_id);

    if ($stmt->execute()) {
        header("Location: view_faculty.php");
    } else {
        echo "Error deleting faculty: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

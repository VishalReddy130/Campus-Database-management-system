<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];
    $sql = "DELETE FROM Course WHERE Course_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);

    if ($stmt->execute()) {
        header("Location: view_courses.php");
    } else {
        echo "Error deleting course: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

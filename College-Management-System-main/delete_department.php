<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['department_id'])) {
    $department_id = $_POST['department_id'];
    $sql = "DELETE FROM Department WHERE Department_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $department_id);

    if ($stmt->execute()) {
        header("Location: view_departments.php");
    } else {
        echo "Error deleting department: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

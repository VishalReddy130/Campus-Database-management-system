<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $dept_id = intval($_POST['department_id']);
    $name = trim($_POST['name']);
    $hod = trim($_POST['hod']);

    // Basic validation
    if (empty($name) || empty($hod)) {
        die("All fields are required");
    }

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE Department SET Name = ?, Head_of_Department = ? WHERE Department_ID = ?");
    $stmt->bind_param("ssi", $name, $hod, $dept_id);

    // Execute and handle result
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: view_departments.php?success=1");
        } else {
            header("Location: view_departments.php?info=1");
        }
    } else {
        header("Location: view_departments.php?error=1");
    }

    $stmt->close();
} else {
    header("Location: view_departments.php");
}

$conn->close();
?>
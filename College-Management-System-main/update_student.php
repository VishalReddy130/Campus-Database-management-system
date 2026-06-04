<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = intval($_POST['student_id']);
    $submitted_timestamp = $_POST['last_updated'];

    $conn->begin_transaction();

    try {
        // Lock the row for safe update
        $stmt = $conn->prepare("SELECT last_updated FROM Student WHERE Student_ID = ? FOR UPDATE");
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            throw new Exception("Student not found.");
        }

        if ($row['last_updated'] !== $submitted_timestamp) {
            throw new Exception("This record was modified by someone else. Please reload and try again.");
        }

        // Perform update
        $stmt = $conn->prepare("UPDATE Student SET 
            Name = ?, 
            Date_of_Birth = ?, 
            Email = ?, 
            Phone = ?, 
            Address = ?, 
            Department_ID = ?
            WHERE Student_ID = ?");

        $stmt->bind_param("sssssii", 
            $_POST['name'], 
            $_POST['dob'], 
            $_POST['email'], 
            $_POST['phone'], 
            $_POST['address'], 
            $_POST['department_id'], 
            $student_id);

        if ($stmt->execute()) {
            $conn->commit();
            header("Location: view_students.php?msg=updated");
        } else {
            throw new Exception("Error updating record: " . $stmt->error);
        }

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: view_students.php");
}
?>

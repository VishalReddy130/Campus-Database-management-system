<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['faculty_id'])) {
    $faculty_id = intval($_POST['faculty_id']);
    
    $stmt = $conn->prepare("UPDATE Faculty SET 
                          Name = ?, 
                          Email = ?, 
                          Phone = ?, 
                          Designation = ?, 
                          Department_ID = ? 
                          WHERE Faculty_ID = ?");
    
    $stmt->bind_param("ssssii", 
                     $_POST['name'], 
                     $_POST['email'], 
                     $_POST['phone'], 
                     $_POST['designation'], 
                     $_POST['department_id'], 
                     $faculty_id);

    if ($stmt->execute()) {
        header("Location: view_faculty.php?msg=updated");
    } else {
        echo "Error updating record: " . $stmt->error;
    }
} else {
    header("Location: view_faculty.php");
}
?>
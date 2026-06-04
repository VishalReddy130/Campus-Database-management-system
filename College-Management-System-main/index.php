<?php include 'db.php'; ?>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-university"></i>
                    <h1>University Portal</h1>
                </div>
                <div class="nav-links">
                    <a href="view_faculty.php"><i class="fas fa-chalkboard-teacher"></i> Faculty</a>
                    <a href="view_departments.php"><i class="fas fa-building"></i> Departments</a>
                    <a href="view_courses.php"><i class="fas fa-book"></i> Courses</a>
                    <a href="view_subjects.php"><i class="fas fa-book-open"></i> Subjects</a>
                    <a href="view_exams.php"><i class="fas fa-clipboard-list"></i> Exams</a>
                    <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>

                </div>
            </div>
        </nav>
    </header>

    <section class="hero">
    <div class="hero-content">
        <h2>Welcome to the University Portal</h2>
        <p>Comprehensive management system for all academic records and university operations</p>
        <div class="hero-buttons">
            <a href="view_students.php" class="cta-button primary"><i class="fas fa-users"></i> View Students</a>
        </div>
    </div>
</section>

    <section class="features">
        <h2 class="section-title">University Management System</h2>
        <p class="section-subtitle">Efficiently manage all academic operations in one place</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3>Students</h3>
                <p>Add and manage student records, attendance, and performance.</p>
                <a href="add_student.php" class="card-button">Add Students <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3>Faculty Management</h3>
                <p>Add and manage faculty records, schedules, and departments.</p>
                <a href="add_faculty.php" class="card-button">Add Faculty <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3>Departments</h3>
                <p>Add and manage university departments and programs.</p>
                <a href="add_department.php" class="card-button">Add Departments <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>Courses</h3>
                <p>Manage courses offered by the university and their curricula.</p>
                <a href="add_courses.php" class="card-button">Add Courses <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>Subjects</h3>
                <p>Manage subjects and their allocation to different courses.</p>
                <a href="add_subjects.php" class="card-button">Add Subjects <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3>Exams</h3>
                <p>Schedule and manage university examinations and results.</p>
                <a href="add_exams.php" class="card-button">Add Exams <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <i class="fas fa-university"></i>
                <span>University Portal</span>
            </div>
            
            <div class="footer-social">
                <a href="https://www.facebook.com/aditya.sarvanam.3/"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/SRM_Univ"><i class="fab fa-twitter"></i></a>
                <a href="https://www.linkedin.com/in/phani-krishna-seetepalli-88230823b/"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.instagram.com/phani.krishnaa/"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 University Portal. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
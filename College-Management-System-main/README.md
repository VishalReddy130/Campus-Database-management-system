# 🎓 University Portal Management System

A PHP & MySQL-based web application that allows administrators to manage students, faculty, departments, courses, subjects, and exams in a university setting.

## 🧩 Features

- 🔐 **Login System** – Basic session-based authentication.
- 🧑‍🎓 **Student Management** – Add, view, edit, and delete students.
- 👨‍🏫 **Faculty Management** – Manage faculty records and their department links.
- 🏢 **Department Management** – Manage academic departments and their heads.
- 📚 **Course and Subject Management** – Assign subjects to courses, and manage them both.
- 📝 **Exam Scheduling** – Set exam dates and marks for each subject.
- 🔁 **Concurrency Control** – Prevents overwriting records using timestamps (`last_updated`).
- 🎨 **Responsive UI** – Clean layout using HTML, CSS, and basic styling.
- 🧑‍💻 **Prepared Statements** – SQL injection protected using PHP MySQLi prepared statements.

## ⚙️ Tech Stack

- **Backend:** PHP (MySQLi)
- **Frontend:** HTML5, CSS3
- **Database:** MySQL
- **Server:** WAMP / XAMPP
- **Editor:** Visual Studio Code

## 🚀 Installation & Usage

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/) installed
- PHP and MySQL enabled
- Basic understanding of PHP and SQL

## Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/university-portal.git
2. **Copy Project Folder**

3. **Paste the folder into htdocs (XAMPP) or www (WAMP) directory.**

4. **Import Database**

5. **Open phpMyAdmin**

6. **Create a new database named CollegeDB3**

7. **Import the provided SQL file (CollegeDB3.sql) located in the project folder**

8. **Configure Database**

9. **Open db.php and ensure credentials match your setup:**

php
```
$conn = new mysqli("localhost", "root", "", "CollegeDB3");
Run the Project
```
10. **Visit http://localhost/university-portal/ in your browser**

11. **Login with your credentials to access the index page**

## 📂 Folder Structure
```
university-portal/
│
├── add_student.php
├── view_students.php
├── edit_student.php
├── update_student.php
│
├── add_faculty.php
├── view_faculty.php
│
├── add_department.php
├── view_departments.php
│
├── add_course.php
├── view_courses.php
│
├── add_subject.php
├── view_subjects.php
│
├── add_exam.php
├── view_exams.php
│
├── db.php
├── login.php
├── logout.php
├── index.php
│
├── styles.css
└── README.md
|__collegedb.sl
```
## 🔐 Login
The system includes a simple login (login.php) and logout (logout.php) system using PHP sessions.

Only authenticated users can access index.php and other core pages.

## 📌 Concurrency Control
Each student record includes a last_updated timestamp.

During updates, the timestamp is checked to prevent conflicting writes by different users at the same time!

## 📣 Contribution
Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## 📃 License
This project is open-source and free to use under the MIT License.





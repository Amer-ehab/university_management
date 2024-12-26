<?php

require 'db_connection.php';
//----------------------------------------------------------------------------------------------

if (isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; 
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $facName = $_POST['facName'];

    $insert_student = "INSERT INTO Student (Name, Email,Phone ,Address, DateOfBirth, facName)
                       VALUES ('$name', '$email','$phone' ,'$address', '$dob', '$facName')";
    if ($conn->query($insert_student)) {
        echo "<script>alert('Student added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding student: " . $conn->error . "');</script>";
    }
}

//------------------------------------------------------------------------------------------------
if (isset($_POST['add_course'])) {
    $course_name = $_POST['course_name'];
    $credits = $_POST['credits'];
    $date_of_course = $_POST['date_of_course'];
    $facName = $_POST['facName'];
    $department = $_POST['department'];

    $insert_course = "INSERT INTO Course (CourseName, Credits, Smester, FacName, Department)
                      VALUES ('$course_name', '$credits', '$date_of_course', '$facName', '$department')";
    if ($conn->query($insert_course)) {
        echo "<script>alert('Course added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding course: " . $conn->error . "');</script>";
    }
}

//-----------------------------------------------------------------------------------------------------
if (isset($_POST['add_enrollment'])) {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $enrollment_date = $_POST['enrollment_date'];

    $insert_enrollment = "INSERT INTO Enrollment (StudentID, CourseID, EnrollmentDate)
                          VALUES ('$student_id', '$course_id', '$enrollment_date')";
    if ($conn->query($insert_enrollment)) {
        echo "<script>alert('Enrollment added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding enrollment: " . $conn->error . "');</script>";
    }
}

//------------------------------------------------------------------------------------------------------
if (isset($_POST['add_grade'])) {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $grade = $_POST['grade'];

    $insert_grade = "INSERT INTO Grade (StudentID, CourseID, Grade)
                     VALUES ('$student_id', '$course_id', '$grade')";
    if ($conn->query($insert_grade)) {
        echo "<script>alert('Grade added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding grade: " . $conn->error . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student Data</title>
    <style>
        
        nav {
            background-color: #4CAF50;
            overflow: hidden;
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #45a049;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        form {
            margin: 20px;
        }
        label {
            display: block;
            margin: 5px 0;
        }
        input, select, button {
            margin: 5px 0 10px;
            padding: 8px;
            width: 100%;
            max-width: 300px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        h1, h2 {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    
    <nav>
        <a href="index.php">Home</a>
        <a href="index.php#add_student">Add Student</a>
        <a href="index.php#add_course">Add Course</a>
        <a href="index.php#enroll_student">Enroll Student</a>
        <a href="index.php#add_grade">Add Grade</a>
        <a href="search.php">Search</a>
    </nav>

    <h1>Manage Student Data</h1>

    
    <h2 id="add_student">Add New Student</h2>
    <form method="POST" action="index.php">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Phone:</label>
        <input type="text" name="phone" required>
        <label>Address:</label>
        <input type="text" name="address" required>
        <label>Date of Birth:</label>
        <input type="date" name="dob" required>
        <label>Faculty Name:</label>
        <input type="text" name="facName" required>
        <button type="submit" name="add_student">Add Student</button>
    </form>

    
    <h2 id="add_course">Add New Course</h2>
    <form method="POST" action="index.php">
        <label>Course Name:</label>
        <input type="text" name="course_name" required>
        <label>Credits:</label>
        <input type="number" name="credits" required>
        <label>Term (Date of Course):</label>
        <select name="date_of_course" required>
            <option value="first semester">First Semester</option>
            <option value="second semester">Second Semester</option>
            <option value="summer course">Summer Course</option>
        </select>
        <label>Faculty Name:</label>
        <input type="text" name="facName" required>
        <label>Department:</label>
        <input type="text" name="department" required>
        <button type="submit" name="add_course">Add Course</button>
    </form>

    
    <h2 id="enroll_student">Enroll Student in Course</h2>
    <form method="POST" action="index.php">
        <label>Student ID:</label>
        <input type="number" name="student_id" required>
        <label>Course ID:</label>
        <input type="number" name="course_id" required>
        <label>Enrollment Date:</label>
        <input type="date" name="enrollment_date" required>
        <button type="submit" name="add_enrollment">Enroll Student</button>
    </form>

    
    <h2 id="add_grade">Add Grade</h2>
    <form method="POST" action="index.php">
        <label>Student ID:</label>
        <input type="number" name="student_id" required>
        <label>Course ID:</label>
        <input type="number" name="course_id" required>
        <label>Grade:</label>
        <input type="text" name="grade" required>
        <button type="submit" name="add_grade">Add Grade</button>
    </form>
</body>
</html>

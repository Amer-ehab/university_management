<?php
require 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Student Details</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        h1 {
            color: #4CAF50;
            text-align: center;
            margin-top: 20px;
        }
        
        h2 {
            color: #4CAF50;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }
        
        table, th, td {
            border: 1px solid #ddd;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        
        form {
            margin: 20px;
            text-align: center;
        }

        label {
            font-size: 18px;
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 8px;
            width: 250px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        
        input[type="text"]:focus {
            outline: none;
            border-color: #4CAF50;
        }

        
        .container {
            width: 80%;
            margin: 0 auto;
        }

        
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
    </style>
</head>
<body>
    <!-- شريط التنقل -->
    <nav>
        <a href="index.php">Home</a>
        <a href="search.php">Search</a>
    </nav>

    <div class="container">
        <h1>Search Student Details</h1>
        <form method="GET" action="search.php">
            <label>Search by Student Name or Student ID:</label>
            <input type="text" name="query" required>
            <button type="submit">Search</button>
        </form>

        <?php
        if (isset($_GET['query'])) {
            $query = $_GET['query'];

            
            $sql = "
                SELECT 
                    s.StudentID, s.Name, s.Email, s.Address, s.DateOfBirth, s.facName,
                    c.CourseID, c.CourseName, c.Smester, c.Credits,
                    g.Grade
                FROM Student s
                LEFT JOIN Enrollment e ON s.StudentID = e.StudentID
                LEFT JOIN Course c ON e.CourseID = c.CourseID
                LEFT JOIN Grade g ON s.StudentID = g.StudentID AND c.CourseID = g.CourseID
                WHERE s.Name LIKE '%$query%' OR s.StudentID = '$query'
            ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $studentInfoPrinted = false;

                while ($row = $result->fetch_assoc()) {
                    
                    if (!$studentInfoPrinted) {
                        echo "<h2>Student Details:</h2>";
                        echo "<table>
                            <tr><th>Student ID</th><td>{$row['StudentID']}</td></tr>
                            <tr><th>Name</th><td>{$row['Name']}</td></tr>
                            <tr><th>Email</th><td>{$row['Email']}</td></tr>
                            <tr><th>Address</th><td>{$row['Address']}</td></tr>
                            <tr><th>Date of Birth</th><td>{$row['DateOfBirth']}</td></tr>
                            <tr><th>Faculty</th><td>{$row['facName']}</td></tr>
                        </table>";
                        $studentInfoPrinted = true;

                        echo "<h2>Enrolled Courses and Grades:</h2>";
                        echo "<table>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Term</th>
                                <th>Credits</th>
                                <th>Grade</th>
                            </tr>";
                    }

                  
                    echo "<tr>
                            <td>{$row['CourseID']}</td>
                            <td>{$row['CourseName']}</td>
                            <td>{$row['Smester']}</td>
                            <td>{$row['Credits']}</td>
                            <td>" . ($row['Grade'] ? $row['Grade'] : "N/A") . "</td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No student found with the given information.</p>";
            }
        }
        ?>
    </div>
</body>
</html>

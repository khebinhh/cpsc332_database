<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Course Grades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #3D85C6;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        h1 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Course Section Information</h1>
        <form method="post" action="student_interface.php">
            <label for="cn">Enter Course Number:</label>
            <input type="text" id="cn" name="cn" required>
            <input type="submit" value="Submit">
        </form>
        
        <h1>View Your Grades</h1>
        <form method="post" action="student_interface.php">
            <label for="cwid">Enter Your CWID:</label>
            <input type="text" id="cwid" name="cwid" required>
            <input type="submit" value="Submit">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
/*
"AAA": This is the hostname of the database server. It can be a domain name, an IP address, 
       or a local identifier for a server instance.
"BBB": This is the username used to authenticate with the database server.
"CCC": This is the password for the specified username.
"DDD": This is the name of the database to connect to within the server.
*/
            $servername = "AAA";
            $username = "BBB";
            $password = "CCC";
            $dbname = "DDD";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("<div class='message'>Connection failed: " . $conn->connect_error . "</div>");
            }

            if (isset($_POST['cn'])) {
                $courseID = $_POST['cn'];
            
                $stmt = $conn->prepare("SELECT s.secID, s.classroom, s.meetingDays, s.startTime, s.endTime, COUNT(e.cwID) AS studentCount
                                        FROM Sections s
                                        LEFT JOIN Enrollments e ON s.courseID = e.courseID AND s.secID = e.secID
                                        WHERE s.courseID = ?
                                        GROUP BY s.courseID, s.secID, s.classroom, s.meetingDays, s.startTime, s.endTime");
                $stmt->bind_param("s", $courseID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<table><tr><th>Section #</th><th>Classroom</th><th>Meeting Days</th><th>Start Time</th><th>End Time</th><th>Student Count</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['secID']}</td><td>{$row['classroom']}</td><td>{$row['meetingDays']}</td><td>{$row['startTime']}</td><td>{$row['endTime']}</td><td>{$row['studentCount']}</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='message'>No results found for course number {$courseID}.</div>";
                }
                $stmt->close();
            } else if (isset($_POST['cwid'])) {
                $cwid = $_POST['cwid'];

                $stmt = $conn->prepare("SELECT c.courseID, c.title, e.grade
                                        FROM Courses c
                                        JOIN Enrollments e ON c.courseID = e.courseID
                                        WHERE e.cwID = ?");
                $stmt->bind_param("s", $cwid);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<table><tr><th>Course #</th><th>Course Title</th><th>Grade</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['courseID']}</td><td>{$row['title']}</td><td>{$row['grade']}</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='message'>No results found for CWID {$cwid}.</div>";
                }
                $stmt->close();
            }
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

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
            background-color: #f4f4f4;
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
"AAA": This is the hostname of the database server. It can be a domain name, an IP address, or in this case, it seems to be a local identifier for a MariaDB server instance.
"BBB": This is the username used to authenticate with the database server.
"CCC": This is the password for the specified username.
"DDD": This is the name of the database to connect to within the server.
*/
            $conn = new mysqli("AAA", "BBB", "CCC", "DDD");
            if ($conn->connect_error) {
                die("<p>Connection failed: " . $conn->connect_error . "</p>");
            }

            if (isset($_POST['cn'])) {
                $cn = $_POST['cn'];

                $stmt = $conn->prepare("SELECT s.S_Num, s.Classroom, GROUP_CONCAT(DISTINCT md.Days ORDER BY md.Days SEPARATOR ', ') AS Meeting_Days, s.Start_Time, s.End_Time, COUNT(DISTINCT e.CWID) AS Student_Count
                                        FROM sections s
                                        JOIN meeting_days md ON s.Course_Num = md.Course_Num AND s.S_Num = md.S_Num
                                        JOIN enrollments e ON s.Course_Num = e.Course_Num AND s.S_Num = e.S_Num
                                        WHERE s.Course_Num = ?
                                        GROUP BY s.S_Num, s.Course_Num");
                $stmt->bind_param("s", $cn);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<table><tr><th>Section #</th><th>Classroom</th><th>Meeting Days</th><th>Start Time</th><th>End Time</th><th>Student Count</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['S_Num']}</td><td>{$row['Classroom']}</td><td>{$row['Meeting_Days']}</td><td>{$row['Start_Time']}</td><td>{$row['End_Time']}</td><td>{$row['Student_Count']}</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No results found.</p>";
                }
                $stmt->close();
            }

            if (isset($_POST['cwid'])) {
                $cwid = $_POST['cwid'];

                $stmt = $conn->prepare("SELECT DISTINCT c.Course_Num, c.Course_Title, e.Grade
                                        FROM courses c
                                        JOIN enrollments e ON e.Course_Num = c.Course_Num
                                        WHERE e.CWID = ?");
                $stmt->bind_param("s", $cwid);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<table><tr><th>Course #</th><th>Course Title</th><th>Grade</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['Course_Num']}</td><td>{$row['Course_Title']}</td><td>{$row['Grade']}</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No results found.</p>";
                }
                $stmt->close();
            }
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

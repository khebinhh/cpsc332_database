<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor's Interface</title>
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
        input[type="text"], button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        input[type="submit"], button[type="submit"] {
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
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        <h1>Your Teaching Schedule</h1>
        <form method="post" action="professorui.php">
            <label for="ssn">Enter SSN:</label>
            <input type="text" id="ssn" name="ssn" required>
            <input type="submit" value="Submit">
        </form>

        <h1>Your Course Grade Distribution</h1>
        <form method="post" action="professorui.php">
            <div>
                <label for="cn">Course Number:</label>
                <input type="text" id="cn" name="cn" required>
            </div>
            <div>
                <label for="sn">Section Number:</label>
                <input type="text" id="sn" name="sn" required>
            </div>
            <button type="submit">Submit</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['ssn'])) {
                $ssn = $_POST['ssn'];
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

                $conn = new mysqli(AAA, BBB, CCC, DDD);
                if ($conn->connect_error) {
                    die("<div class='message'>Connection failed: " . $conn->connect_error . "</div>");
                }

                // Prepare SQL statement to prevent SQL injection
                $stmt = $conn->prepare("SELECT c.Course_Title, s.Classroom, md.Days, s.Start_Time, s.End_Time FROM courses c, professors p, sections s, meeting_days md WHERE p.SSN = ? AND p.SSN = s.SSN AND c.Course_Num = s.Course_Num AND s.S_Num = md.S_Num AND s.Course_Num = md.Course_Num");
                $stmt->bind_param("s", $ssn);

                // Execute the query
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Output data of each row
                    echo "<h2>Teaching Schedule</h2>";
                    echo "<table><tr><th>Title</th><th>Classroom</th><th>Meeting Days</th><th>Start Time</th><th>End Time</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["Course_Title"]."</td><td>".$row["Classroom"]."</td><td>".$row["Days"]."</td><td>".$row["Start_Time"]."</td><td>".$row["End_Time"]."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='message'>No results found for the provided SSN.</div>";
                }
                $stmt->close();
                $conn->close();
            }
            else {
                $cn = $_POST['cn'];
                $sn = $_POST['sn'];

                // Database connection
                $conn = new mysqli("localhost", "username", "password", "database");
                if ($conn->connect_error) {
                    die("<div class='message'>Connection failed: " . $conn->connect_error . "</div>");
                }

                // Prepare SQL statement to prevent SQL injection
                $stmt = $conn->prepare("SELECT e.Grade, COUNT(*) as num_students FROM enrollments e WHERE e.Course_Num = ? AND e.S_Num = ? GROUP BY e.Grade");
                $stmt->bind_param("ss", $cn, $sn);

                // Execute the query
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Output data of each row
                    echo "<h2>Course Grade Distribution</h2>";
                    echo "<table><tr><th>Grade</th><th>Number of Students</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["Grade"]."</td><td>".$row["num_students"]."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='message'>No results found for the provided course and section.</div>";
                }
                $stmt->close();
                $conn->close();
            }
        }
        ?>
    </div>
</body>
</html>

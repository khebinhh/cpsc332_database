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
            background-color: #e9f5f9;
            /* Light blue background */
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #00274C;
            /* CSUF Blue */
        }

        .form-container {
            margin-bottom: 40px;
        }

        form {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"],
        button {
            background: #FF6600;
            /* CSUF Orange */
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 10px;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #E65C00;
            transform: scale(1.05);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #00274C;
            /* CSUF Blue */
            color: #fff;
        }

        .message {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .back-button {
            background: #FF6600;
            /* CSUF Orange */
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #E65C00;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Your Teaching Schedule</h1>
        <div class="form-container">
            <form method="post" action="professorui.php">
                <label for="ssn">Enter SSN:</label>
                <input type="text" id="ssn" name="ssn" required>
                <input type="submit" value="Submit">
            </form>
        </div>

        <h1>Your Course Grade Distribution</h1>
        <div class="form-container">
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
        </div>

        <a href="index.php" class="back-button">Back</a>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['ssn'])) {
                $ssn = $_POST['ssn'];
                $servername = "kevindb";
                $username = "cs332e25";
                $password = "X4x2pBb0";
                $dbname = "cs332e25";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("<div class='message'>Connection failed: " . $conn->connect_error . "</div>");
                }

                $stmt = $conn->prepare("SELECT c.Course_Title, s.Classroom, md.Days, s.Start_Time, s.End_Time 
                                        FROM courses c, professors p, sections s, meeting_days md 
                                        WHERE p.SSN = ? 
                                        AND p.SSN = s.SSN 
                                        AND c.Course_Num = s.Course_Num 
                                        AND s.S_Num = md.S_Num 
                                        AND s.Course_Num = md.Course_Num");
                $stmt->bind_param("s", $ssn);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<h2>Teaching Schedule</h2>";
                    echo "<table><tr><th>Title</th><th>Classroom</th><th>Meeting Days</th><th>Start Time</th><th>End Time</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["Course_Title"] . "</td><td>" . $row["Classroom"] . "</td><td>" . $row["Days"] . "</td><td>" . $row["Start_Time"] . "</td><td>" . $row["End_Time"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='message'>No results found for the provided SSN.</div>";
                }
                $stmt->close();
                $conn->close();
            } else if (isset($_POST['cn']) && isset($_POST['sn'])) {
                $cn = $_POST['cn'];
                $sn = $_POST['sn'];
                $servername = "kevindb";
                $username = "cs332e25";
                $password = "X4x2pBb0";
                $dbname = "cs332e25";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("<div class='message'>Connection failed: " . $conn->connect_error . "</div>");
                }

                $stmt = $conn->prepare("SELECT e.Grade, COUNT(*) as num_students 
                                        FROM enrollments e 
                                        WHERE e.Course_Num = ? 
                                        AND e.S_Num = ? 
                                        GROUP BY e.Grade");
                $stmt->bind_param("ss", $cn, $sn);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<h2>Course Grade Distribution</h2>";
                    echo "<table><tr><th>Grade</th><th>Number of Students</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["Grade"] . "</td><td>" . $row["num_students"] . "</td></tr>";
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
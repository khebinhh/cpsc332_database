<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to University Database System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9f5f9; /* Light blue background */
            text-align: center;
            padding: 50px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #00274C; /* CSUF Blue */
        }
        p {
            font-size: 1.2em;
            margin-bottom: 40px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .button {
            background-color: #FF6600; /* CSUF Orange */
            border: none;
            color: white;
            padding: 20px 40px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            flex: 1;
            max-width: 200px;
        }
        .button:hover {
            background-color: #E65C00;
            transform: scale(1.05);
        }
        .logo {
            max-width: 300px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="csuf-logo-rgb.png" alt="CSUF Logo" class="logo">
        <h1>Welcome to the University Database System</h1>
        <p>Select an option below to proceed:</p>
        <div class="button-container">
            <a href="professor_interface.php" class="button">Professor Interface</a>
            <a href="student_interface.php" class="button">Student Interface</a>
        </div>
    </div>
</body>
</html>

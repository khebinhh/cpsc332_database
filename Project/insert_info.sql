--3 Professors ex.
INSERT INTO Professor(SSN, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, sex, title, salary, degrees)
VALUES('423897106', 'Swayam', 'Pati', '123 Main St', 'Santa Clara', 'CA', '95050', '650', '6493785', 'F', 'Dr.', '80000', 'Ph.D in Computer Science');
INSERT INTO Professor(SSN, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, sex, title, salary, degrees)
VALUES('386724059', 'Shawn', 'Wang', '476 Elm St', 'San Francisco', 'CA', '94105', '951', '4151234567', 'M', 'Dr.', '100000',' Ph.D. in Computer and Information Science');
INSERT INTO Professor(SSN, firstName, lastName, streetName, city, state, zip, areaCode, phonNumber, sex, title, salary, degrees)
VALUES('293847123', 'Nathaniel', 'Hall', '657 Maple St', 'San Diego', 'CA', '92130', '310', '7483805', 'M', 'Mr.', '90000', 'Masters in Mathematics');

--2 Departments ex.
INSERT INTO Department(deptID, name, telephone, officeLocation, chairpersonSSN)
VALUES(1, 'Computer Science', '6572783770', 'CS-522', '6572787255');
INSERT INTO Department(deptID, name, telephone, officeLocation, chairpersonSSN)
VALUES(2, 'Mathematics', '6572783631', 'MH-154', '6572785535');

--4 Courses ex.
INSERT INTO Courses(courseID, title, textbook, units, deptID)
VALUES('332', 'File Structures and Database Systems', 'Fundamentals of Database Systems', 3, 1);
INSERT INTO Courses(courseID, title, textbook, units, deptID)
VALUES('362', 'Foundation of Software Engineering', 'Software Engineering, A Practitioner''s Approach', 3, 1);
INSERT INTO Courses(courseID, title, textbook, units, deptID)
VALUES('335', 'Algorithm Engineering', 'Algorithm Design in Three Acts', 3, 1);
INSERT INTO Courses(courseID, title, textbook, units, deptID)
VALUES('170B', 'Mathematical Structure II', 'Linear Algebra with Applications', 3, 2);
INSERT INTO Courses(courseID, title, textbook, units, deptID)
VALUES('338', 'Statistics Applied to Natural Sciences', 'OpenIntro Statistics (OS)', 4, 2)

--6 Sections
INSERT INTO Sections(courseID, secID, classroom, seats, meetingDays, startTime, endTime, professorSSN)
VALUES()
--8 Students

--20 Enrollments

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
VALUES('338', 'Statistics Applied to Natural Sciences', 'OpenIntro Statistics (OS)', 4, 2);

--6 Sections
INSERT INTO Sections(courseID, secID, classroom, seats, meetingDays, startTime, endTime, professorSSN)
VALUES('335', 1, 'CS-104', 45, 'Friday', '13:00', '15:45', '423897106');
INSERT INTO Sections(courseID, secID, classroom, seats, meetingDays, startTime, endTime, professorSSN)
VALUES('332', 1, 'CS-300', 35, 'Monday/Wednesday', '10:00', '11:15', '386724059');
INSERT INTO Sections(courseID, secID, classroom, seats, meetingDays, startTime, endTime, professorSSN)
VALUES('170B', 1, 'MH-487', 40, 'Monday/Wednesday', '11:30', '12:45', '293847123');
INSERT INTO Sections(courseID, secID, classroom, seats, meetingDays, startTime, endTime, professorSSN)
VALUES('170B', 2, 'MH-487', 40, 'Tuesday/Thursday', '16:00', '17:15', '293847123');
INSERT INTO Sections(courseID, secID, classroom, seats, meetingDays, startTime, endTime, professorSSN)
VALUES('362', 1, 'CS-104', 35, 'Saturday', '09:00', '12:00', '423897106');
INSERT INTO Sections(courseID, secID, classroom, seats, meetingDays, startTime, endTime, professorSSN)
VALUES('338', 1, 'MH-655', 35, 'Monday/Wednesday', '15:30', '17:45', '293847123');

--8 Students
INSERT INTO Student(cwID, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, majordeptID)
VALUES('889362406', 'Kevin', 'Ramirez', '465 Main St', 'Santa Clara', 'CA', '95050', '650', '6493785', 1);
INSERT INTO Student(cwID, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, majordeptID)
VALUES('885547844', 'Kenny', 'Ly', '375 Cutlery St', 'Anaheim', 'CA', '92801', '310', '4151234567', 2);
INSERT INTO Student(cwID, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, majordeptID)
VALUES('885050286', 'Nezar', 'Humound', '132 Carnival St', 'San Diego', 'CA', '92130', '310', '7483805', 1);
INSERT INTO Student(cwID, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, majordeptID)
VALUES('882146745', 'Joshua', 'Holmes', '745 Orange St', 'Diamond Bar', 'CA', '92801', '310', '7483805', 2);
INSERT INTO Student(cwID, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, majordeptID)
VALUES('884678456', 'Theresa', 'Nguyen', '462 Standford St', 'Irvine', 'CA', '92601', '650', '4151234567', 1);
INSERT INTO Student(cwID, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, majordeptID)
VALUES('883967452', 'Jullian', 'Brown', '825 Central Ave', 'Santa Ana', 'CA', '95050', '650', '6493785', 2);
INSERT INTO Student(cwID, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, majordeptID)
VALUES('882678456', 'Omar', 'Bello', '836 Victory St', 'Anaheim', 'CA', '92801', '310', '7483805', 1);
INSERT INTO Student(cwID, firstName, lastName, streetName, city, state, zip, areaCode, phoneNumber, majordeptID)
VALUES('885478456', 'Naomi', 'Park', '742 Jefferson St', 'Corona', 'CA', '92801', '310', '7483805', 2);

--20 Enrollments

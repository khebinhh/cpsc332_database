-- This is used to create the tablenames and the columns in the database
--1)Professor
CREATE TABLE Professor(
  SSN VARCHAR(9) PRIMARY KEY,
  firstName VARCHAR(20),            
  lastName VARCHAR(20),
  streetName VARCHAR(20),      --testing size
  city VARCHAR (10),           --testing size
  state VARCHAR(2),            --two for just the two letter abbreviation
  zip VARCHAR(5)
  areaCode VARCHAR(3),         --telephone section
  phoneNumber BIGINT,          --telephone section
  sex CHAR(1),                 -- abbreviation for m or f
  title VARCHAR(15),            --testing size
  salary DECIMAL(10,2), --10 for the number of digits, 2 for the number of decimals
  degrees VARCHAR(255), --testing huge size in case of mult. degree
);
--2)Departments
CREATE TABLE Department(
  deptID INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  telephone BIGINT,
  officeLocation VARCHAR(255),
  chairpersonSSN VARCHAR(10),
  FOREIGN KEY (chairpersonSSN) REFERENCES Professor(SSN)
);
--3a)Courses
CREATE TABLE Courses(
  courseID VARCHAR(10) PRIMARY KEY,
  title VARCHAR(20),
  textbook VARCHAR(20),
  units INT,
  deptID INT,
  FOREIGN KEY (deptID) REFERENCES Department(deptID)
);
--3b)Prerequisites
CREATE TABLE Prerequisites(
  courseID VARCHAR(10),
  prereqID VARCHAR(10),
  PRIMARY KEY (courseID, prereqID)
  FOREIGN KEY (courseID) REFERENCES Courses(courseID),
  FOREIGN KEY (prereqID) REFERENCES Courses(courseID)
);
--4)Sections
CREATE TABLE Sections(
  courseID VARCHAR(10),
  secID INT,
  classroom VARCHAR(20),
  seats INT,
  meetingDays VARCHAR(20),
  startTime TIME,
  endTime TIME,
  professorSSN VARCHAR(11),
  PRIMARY KEY (courseID, secID),
  FOREIGN KEY (courseID) REFERENCES Courses(courseID)
  FOREIGN KEY (professorSSN) REFERENCES Professor(SSN)
);
--5a)Students(major)
CREATE TABLE Student(
  cwID VARCHAR(9) PRIMARY KEY,
  firstName VARCHAR(20),
  lastName VARCHAR(20),
  streetName VARCHAR(20),
  city VARCHAR (10),           --testing size
  state VARCHAR(2),            --two for the abbreviation
  zip VARCHAR(5)
  areaCode VARCHAR(3),         --telephone section
  phoneNumber BIGINT,          --telephone section
  majordeptID INT,
  FOREIGN KEY (majordeptID) REFERENCES Department(deptID)
);
--5b)Student(minor)
CREATE TABLE sMinor(
  cwID VARCHAR(9),
  minordeptID INT,
  PRIMARY KEY (cwID, minordeptID),
  FOREIGN KEY (cwID) REFERENCES Student(cwID),
  FOREIGN KEY (minordeptID) REFERENCES Department(deptID)
);
--6)Enrollments
CREATE TABLE Enrollments(
  cwID VARCHAR(9),
  courseID VARCHAR(10),
  secID INT,
  grade VARCHAR(2),
  PRIMARY KEY (cwID, courseID, secID),
  FOREIGN KEY (cwID) REFERENCES Student(cwID),
  FOREIGN KEY (courseID, secID) REFERENCES Sections(courseID, secID)
);
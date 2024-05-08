-- This is used to create the tablenames and the columns in the database
CREATE TABLE Professor(
  SSN VARCHAR(9) PRIMARY KEY,
  Name VARCHAR(20),            --testing size
  StreetName VARCHAR(20),      --testing size
  City VARCHAR (10),           --testing size
  State VARCHAR(2),            --two for just the two letter abbreviation
  Zip VARCHAR(5)
  AreaCode VARCHAR(3),         --telephone section
  PhoneNumber BIGINT,          --telephone section
  Sex CHAR(1),                 -- abbreviation for m or f
  Tite VARCHAR(15),            --testing size
  Salary DECIMAL(10,2), 
  Degrees VARCHAR(255), --testing huge size in case of mult. degree
);
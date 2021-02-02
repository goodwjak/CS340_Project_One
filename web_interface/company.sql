-- Company Database for project
create table Department (
  Dname varchar(20) not null,
  Dnum int(2) not null check (Dnum > 0 and Dnum < 41),  
  MgrSsn char(9) not null,    
  primary key (Dnum), 
  unique (Dname)
)ENGINE = INNODB;

create table Employee (
  FirstName varchar(15) not null,
  LastName varchar(15) not null,
  Ssn char(9) not null,  
  BirthDate date not null,
  Address varchar(30) not null,
  Salary decimal(10,2) not null,
  SuperSsn char(9),
  Dnum int(2) not null,
  constraint Fullname UNIQUE(FirstName, LastName),  
  primary key (Ssn), 
  foreign key (Dnum) references Department(Dnum)
)ENGINE = INNODB;

create table Project (
  Pname varchar(20) not null,
  Pnum int(4) not null,  
  Plocation varchar(20) not null,
  Dnum int(2) not null, 
  primary key (Pnum), 
  unique (Pname), 
  foreign key (Dnum) references Department(Dnum)
)ENGINE = INNODB; 

create table WorksON (
  Essn char(9) not null,  
  Pnum int(2) not null, 
  Hours decimal(3,1),
  Projects decimal(4) not null,  
  primary key (Essn, Pnum), 
  foreign key (Essn) references Employee(Ssn),
  foreign key (Pnum) references Project(Pnum)
)ENGINE = INNODB;

create table Pay(
  Essn char(9) not null,
  Dependents int(2) not null,
  Basepay decimal(10,2),
  ProjectPay decimal(10,2),
  foreign key (Essn) references Employee(Ssn)
)ENGINE = INNODB; 
-- add address incase we want to check the dependents
-- being claimed by more once by the same family
-- dFullname may solve this already
create table Dependent (
  Essn char(9) not null,  
  FirstName varchar(15) not null,
  LastName varchar(15) not null,
  BirthDate date not null,
  Address varchar(30) not null,
  constraint DFullname UNIQUE(FirstName, LastName),
  primary key (Essn, FirstName, LastName),
  foreign key (Essn) references Employee(Ssn)
)ENGINE = INNODB; 

-- added Dlocation incase we want to stop the projects being
-- too far apart to be asigned to a person
create table DeptLOCATIONS (
  Dnum int(2) not null,
  Dlocation varchar(15) not null,
  primary key (Dnum, Dlocation), 
  foreign key (Dnum) references Department(Dnum)
)ENGINE = INNODB;



-- name,num,manager
insert into Department values 
 ('BioEngineering',1,111111111),
 ('Robotics',2,222222222),
 ('ChemEngineering',3,333333333),
 ('Human Resources',4,444444444),
 ('Physics',5,555555555),
 ('Geology',6,666666666),
 ('ElecEngineering',7,777777777),
 ('Administration',8,987654321),
 ('Headquarters',9,123456789);



 -- FirstName,LastName,Ssn,BirthDate,Address,Salary,SuperSsn,Dnum,
-- we  init the tables
insert into Employee values 
-- The Department Heads- They report to Admin
 ('Jack','Low',111111111,'1989-07-09','420 Record Way, Portland OR',75000,987654321,1),
 ('Ann','Red',222222222,'1978-09-11','89 This Street, Salem OR',75000,987654321,2),
 ('Alex','Gaya',333333333,'1990-11-18','455 Castle BLVD., Corvallis OR',75000,987654321,3),
 ('Charles','Neugen',444444444,'1989-10-23','178 Home Place, Eugene OR',75000,987654321,4),
 ('Joy','Howl',555555555,'1976-02-11','765 Around BLVD, Bend OR',75000,987654321,5),
 ('Bill','Crew',666666666,'1987-08-21','899 Younder Way, Newport OR',75000,987654321,6),
 ('Jill','Jackson',777777777,'1998-06-30','342 Goose St., Albany OR',75000,987654321,7),
 ('Zaya','Meta',987654321,'1998-06-30','980 UpHigh Road, Mt. Hood OR',75000,987654321,8),
 -- Top BOSS
 ('Jesse','Jesse',123456789,'1999-10-18','908 Water Ave., SeaSide OR',75000,987654321,9),
 -- Regular Employees
  ('Jane','Hill',123123123,'1978-04-30','888 Road Rd., Portland OR',60000,111111111,1),
  ('Bob','Apples',321321321,'1908-01-01',' 444 Street St., Salem OR',60000,222222222,2),
  ('Jackie','Wong',321123321,'1970-01-01','555 Parkway Prkwy., Corvallis OR',60000,333333333,3),
  ('Harold','Joules',234234234,'2000-01-90','888 House Rd., Eugene OR',60000,444444444,4),
  ('Sawn','Tells',345345345,'2003-04-19',' 999 Long St., Bend OR',60000,555555555,5),
  ('Nick','Knack',456456456,'2001-12-31',' 103 Lane Ln., Newport OR',60000,666666666,6),
  ('Patty','Wack',567567567,'2000-19-22','344 Left Rd., Albany OR',60000,777777777,7),
  ('Eric','Cire',678678678,'1999-11-30',' 455 Right Rd., Portland OR',60000,111111111,1);


-- projectName, Pnum, Location, Department
insert into Project values 
 ('RoboticSnake',1,'Portland',1),
 ('RoboticArm',2,'Salem',2),
 ('ChemicalCentrafuge',3,'Corvallis',3),
 ('EmployeeDiversity',4,'Eugene',4),
 ('Roover',5,'Bend',5),
 ('SamplingAutomation',6,'Bend',5),
 ('Lazer',7,'Corvallis', 3);



-- Essn,Pnum,Hours, Projects,
-- add more than one project to a person via webinterface
insert into WorksOn values 
 (123123123,1,32.5),
 (321321321,2,7.5),
 (321123321,3,40.0),
 (234234234,4,20.0),
 (345345345,5,20.0),
 (456456456,6,10.0),
 (567567567,7,10.0),
 (123123123,2,8.0),
 (678678678,1,10.0);




-- Essn, FirstName, LastName, BirthDate, Address
insert into Dependent values 
 (123123123,'Apple','Tree','2010-04-05','Child'),
 (123123123,'Tom','Space', '2013-11-15','Child'),
 (321321321,'Ben','Gown','1990-11-23','Spouse'),
 (234234234,'Mike','Jackson','1978-08-18','Spouse'),
 (345345345,'Michael','Fox','2004-06-05','Child'),
 (456456456,'Alice','Wonderland','2018-11-21','Child'),
 (567567567,'Elizabeth','Beth','2000-03-06','Spouse');
-- Dep, LocationName
insert into DeptLOCATIONS values
 (1,'Portland'),
 (2,'Salem'),
 (3,'Corvallis'),
 (4,'Eugene'),
 (5,'Bend'),
 (6,'Newport'),
 (7,'Albany'),
 (8,'Mt.Hood'),
 (9,'SeaSide');

alter table Department 
 add constraint depemp foreign key (MgrSsn) references Employee(Ssn);

alter table Employee   
 add constraint empemp foreign key (SuperSsn) references Employee(Ssn);
	
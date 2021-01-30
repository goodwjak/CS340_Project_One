-- Company Database for project
create table DEPARTMENT (
  Dname varchar(20) not null,
  Dnum int(2) not null check (Dnum > 0 and Dnum < 41),  
  MgrSsn char(9) not null,    
  primary key (Dnum), 
  unique (Dname)
)ENGINE = INNODB;

create table EMPLOYEE (
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
  foreign key (Dnum) references DEPARTMENT(Dnum)
)ENGINE = INNODB;

create table PROJECT (
  Pname varchar(20) not null,
  Pnum int(4) not null,  
  Plocation varchar(20) not null,
  Dnum int(2) not null, 
  primary key (Pnum), 
  unique (Pname), 
  foreign key (Dnum) references DEPARTMENT(Dnum)
)ENGINE = INNODB; 

create table WorksON (
  Essn char(9) not null,  
  Pnum int(2) not null, 
  Hours decimal(3,1),
  Projects decimal(4) not null,  
  primary key (Essn, Pnum), 
  foreign key (Essn) references EMPLOYEE(Ssn),
  foreign key (Pnum) references PROJECT(Pnum),
)ENGINE = INNODB;

create table Pay(
  Essn char(9) not null,
  Dependents int(2) not null,
  Basepay decimal(10,2),
  ProjectPay decimal(10,2)
  foreign key (Essn) references EMPLOYEE(Ssn)
)ENGINE = INNODB; 
--add address incase we want to check the dependents
-- being claimed by more once by the same family
--dFullname may solve this already
create table DEPENDENT (
  Essn char(9) not null,  
  DependentName varchar(15) not null,
  BirthDate date not null,
  Address varchar(30) not null,
  constraint DFullname UNIQUE(FirstName, LastName)
  primary key (Essn, DependentName),
  foreign key (Essn) references EMPLOYEE(Ssn)
)ENGINE = INNODB; 

--added Dlocation incase we want to stop the projects being
--too far apart to be asigned to a person
create table DeptLOCATIONS (
  Dnum int(2) not null,
  Dlocation varchar(15) not null,
  primary key (Dnum, Dlocation), 
  foreign key (Dnum) references DEPARTMENT(Dnum)
)ENGINE = INNODB;



--filling the tables brah

-- we need nine entries for now
insert into DEPARTMENT values 
 ('Research',5,333445555,'1988-05-22'),
 ('Administration',4,987654321,'1995-01-01'),
 ('Headquarters',1,888665555,'1981-06-19');

--we i init the tables
insert into EMPLOYEE values 
 ('John','Smith',123456789,'1965-01-09','731 Fondren, Houston TX',70000,333445555,5),
 ('Franklin','Wong',333445555,'1965-12-08','638 Voss, Houston TX',70000,888665555,5),
 ('Alicia','Zelaya',999887777,'1968-01-19','3321 Castle, Spring TX',70000,987654321,4),
 ('Jennifer','Wallace',987654321,'1941-06-20','291 Berry, Bellaire TX',70000,888665555,4),
 ('Ramesh','Narayan',666884444,'1962-09-15','975 Fire Oak, Humble TX',70000,333445555,5),
 ('Joyce','English',453453453,'1972-07-31','5631 Rice, Houston TX',70000,333445555,5),
 ('Ahmad','Jabbar',987987987,'1969-03-29','980 Dallas, Houston TX',70000,987654321,4),
 ('James','Borg',888665555,'1937-11-10','450 Stone, Houston TX',70000,null,1);
--projectName, Pnum, Location, Department
insert into PROJECT values 
 ('RoboticSnake',1,'Portland',1),
 ('RoboticArm',2,'Salem',2),
 ('ChemicalCentrafuge',3,'Corvallis',3),
 ('EmployeeDiversity',4,'Eugene',4),
 ('Roover',5,'Bend',5),
 ('SamplingAutomation',6,'Bend',5),
 ('Lazer',7,'Corvallis', 3);
--add more than one project to a person
insert into WorksOn values 
 (123456789,1,32.5),
 (123456789,2,7.5),
 (666884444,3,40.0),
 (453453453,1,20.0),
 (453453453,2,20.0),
 (333445555,2,10.0),
 (333445555,3,10.0),
 (333445555,5,10.0),
 (333445555,6,10.0),
 (999887777,7,30.0),
 (999887777,3,10.0),
 (987987987,4,35.0),
 (987987987,3,5.0),
 (987654321,1,20.0),
 (987654321,2,15.0),
 (888665555,2,null);

insert into DEPENDENT values 
 (333445555,'Alice','1986-04-04','Child'),
 (333445555,'Theodore','1983-10-25','Child'),
 (333445555,'Joy','1958-05-03','Spouse'),
 (987654321,'Abner','1942-02-28','Spouse'),
 (123456789,'Michael','1988-01-04','Child'),
 (123456789,'Alice','1988-12-30','Child'),
 (123456789,'Elizabeth','1967-05-05','Spouse');

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

alter table DEPARTMENT 
 add constraint depemp foreign key (MgrSsn) references EMPLOYEE(Ssn);

alter table EMPLOYEE   
 add constraint empemp foreign key (SuperSsn) references EMPLOYEE(Ssn);
	
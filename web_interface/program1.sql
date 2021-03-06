create table DeptSTATS(
Dnum int(2) not null,
EmpCount int(11) not null,
AvgSalary decimal(10,2) not null,
FOREIGN KEY (Dnum) REFERENCES Department(Dnum))
ENGINE = INNODB;

UPDATE DeptSTATS
SET Dnum = (SELECT DISTINCT (Dnum)
                FROM Department);
SET EmpCount = (SELECT COUNT(Ssn)
                 FROM Employee
                  Group BY Dnum);
SET AvgSalary = (SELECT SUM(Salary)
                  FROM Employee 
                  GROUP BY Dnum);


DELIMITER $$
CREATE FUNCTION 'InitDeptStats' ()
BEGIN 
UPDATE DeptSTATS
SET Dnum = (SELECT DISTINCT (Dnum)
                FROM Department);
SET EmpCount = (SELECT COUNT(Ssn)
                 FROM Employee
                  Group BY Dnum);
SET AvgSalary = (SELECT SUM(Salary)
                  FROM Employee 
                  GROUP BY Dnum);
END $$



delimiter $$
CREATE TRIGGER 'DELETEDeptStats'
AFTER DELETE ON Employee
FOR EACH ROW
BEGIN 
UPDATE DeptSTATS
SET Dnum = (SELECT DISTINCT (Dnum)
                FROM Department);
SET EmpCount = (SELECT COUNT(Ssn)
                 FROM Employee
                 GROUP BY Dnum);
SET AvgSalary = (SELECT SUM(Salary)
                  FROM Employee 
                  GROUP BY Dnum);
END;
$$

delimiter $$
CREATE TRIGGER 'INSERTDeptStats'
AFTER INSERT ON Employee
FOR EACH ROW
BEGIN 
UPDATE DeptSTATS
SET Dnum = (SELECT DISTINCT (Dnum)
                FROM Department);
SET EmpCount = (SELECT COUNT(Ssn)
                 FROM Employee
                 GROUP BY Dnum);
SET AvgSalary = (SELECT SUM(Salary)
                  FROM Employee 
                  GROUP BY Dnum);
END; 
$$



delimiter $$
CREATE TRIGGER 'UPDATEDeptStats'
AFTER UPDATE ON Employee
FOR EACH ROW
BEGIN
UPDATE DeptSTATS
SET Dnum = (SELECT DISTINCT (Dnum)
                FROM Department);
SET EmpCount = (SELECT COUNT(Ssn)
                 FROM Employee
                 GROUP BY Dnum);
--going to use this for the base pay
SET AvgSalary = (SELECT SUM(Salary)
                  FROM Employee 
                  GROUP BY Dnum);
END;
$$

--suppose we do an hourly wage(*basepay), right now the is no overtime
--hints the 40 hours
delimiter $$ 
CREATE TRIGGER 'MaxTotalHours'
BEFORE INSERT ON WorkOn
FOR EACH ROW
BEGIN

if(NEW.Hours>40) then
set NEW.Hours :=40;
end if;
END;
$$

delimiter $$
CREATE

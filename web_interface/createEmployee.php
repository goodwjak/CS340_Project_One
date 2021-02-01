<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$Ssn = $LastName = $FirstName = $Salery = $BirthDate = $Address = $Dnum = $SuperSsn = "";
//Defining the errors too
$SsnErr = $LastNameErr = $FirstNameErr = $AddressErr = $BirthDateErr $SalaryErr = $DnumErr = "" ;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate First name
    $FirstName = trim($_POST["FirstName"]);
    if(empty($FirstName)){
        $FirstNameErr = "Please enter a First name.";
    } elseif(!filter_var($FirstName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $FirstNameErr = "Please enter a valid First name.";
    } 
    // Validate Last name
    $LastName = trim($_POST["LastName"]);
    if(empty($LastName)){
        $LastNameErr = "Please enter a LastName.";
    } elseif(!filter_var($LastName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $LastNameErr = "Please enter a valid Last name.";
    } 
 
    // Validate SSN
    $Ssn = trim($_POST["Ssn"]);
    if(empty($Ssn)){
        $SsnErr = "Please enter SSN.";     
    } elseif(!ctype_digit($Ssn)){
        $SsnErr = "Please enter a positive integer value of Social Security Number.";
    } 
    //This is a place holder
    //We will probably treat this as giving the raise. 
    // Validate Salary
    $Salary = trim($_POST["Salary"]);
    if(empty($Salary)){
        $SalaryErr = "Please enter Salary. This is a placeholder function. We may make this where the employer can give a raise to the every employees base pay.";     
    }
	// Validate Address
    $Address = trim($_POST["Address"]);
    if(empty($Address)){
        $AddressErr = "Please enter Address.";     
    }
	// Validate Birthdate
    $BirthDate = trim($_POST["BirthDate"]);
    if(empty($BirthDate)){
        $BirthDate_err = "Please enter birthdate.";     
    }	

	// Validate Department
    $Dnum = trim($_POST["Dnum"]);
    if(empty($Dnum)){
        $DnumErr = "Please enter a department number.";     		
	}
    // Check input errors before inserting in database
    if(empty($SsnErr) && empty($LastNameErr) && empty($SalaryErr) 
				&& empty($DnumErr)&& empty($AddressErr){
        // Prepare an insert statement
        $sql = "INSERT INTO EMPLOYEE (Ssn, FirstName, LastName, Address, Salary, BirthDate, Dnum) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssdssi", $param_Ssn, $param_FirstName, $param_LastName, 
				$param_Address, $param_Salary, $param_BirthDate, $param_Dnum);
            
            // Set parameters
			$param_Ssn = $Ssn;
            $param_LastName = $LastName;
			$param_FirstName = $FirstName;
			$param_Address = $Address;
			$param_BirthDate = $BirthDate;
            $param_Salary = $Salary;
            $param_Dnum = $Dnum;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
				    header("location: index.php");
					exit();
            } else{
                echo "<center><h4>Error while creating new employee</h4></center>";
				$SsnErr = "You entered someone else's Ssn!";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please enter the form add an Employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($SsnErr)) ? 'has-error' : ''; ?>">
                            <label>SSN</label>
                            <input type="text" name="Ssn" class="form-control" value="<?php echo $Ssn; ?>">
                            <span class="help-block"><?php echo $SsnErr;?></span>
                        </div>
                 
						<div class="form-group <?php echo (!empty($FirstNameErr)) ? 'has-error' : ''; ?>">
                            <label>First Name</label>
                            <input type="text" name="FirstName" class="form-control" value="<?php echo $FirstName; ?>">
                            <span class="help-block"><?php echo $FirstNameErr;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($LastNameErr)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>
                            <input type="text" name="LastName" class="form-control" value="<?php echo $LastName; ?>">
                            <span class="help-block"><?php echo $LastNameErr;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($AddressErr)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <input type="text" name="Address" class="form-control" value="<?php echo $Address; ?>">
                            <span class="help-block"><?php echo $AddressErr;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($SalaryErr)) ? 'has-error' : ''; ?>">
                            <label>Salary</label>
                            <input type="text" name="Salary" class="form-control" value="<?php echo $Salary; ?>">
                            <span class="help-block"><?php echo $SalaryErr;?></span>
                        </div>
						                  
						<div class="form-group <?php echo (!empty($BirthdateErr)) ? 'has-error' : ''; ?>">
                            <label>BirthDate</label>
                            <input type="date" name="BirthDate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            <span class="help-block"><?php echo $BirthDateErr;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($DnumErr)) ? 'has-error' : ''; ?>">
                            <label>Dnum</label>
                            <input type="number" min ="1" max ="20" name="Dnum" class="form-control" value="<?php echo $Dnum; ?>">
                            <span class="help-block"><?php echo $DnumErr;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
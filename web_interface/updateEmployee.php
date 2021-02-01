<?php
	session_start();	
// Include config file
	require_once "config.php";
 
// Define variables and initialize with empty values
// Note: You can not update SSN 
$LastName = $FirstName = $Salary = $BirthDate = $Address  = $Dnum = $SuperSsn = "";
$LastNameErr = $FirstNameErr = $AddressErr  = $SalaryErr = $DnumErr = "" ;
// Form default values

if(isset($_GET["Ssn"]) && !empty(trim($_GET["Ssn"]))){
	$_SESSION["Ssn"] = $_GET["Ssn"];

    // Prepare a select statement
    $sql1 = "SELECT * FROM EMPLOYEE WHERE Ssn = ?";
  
    if($stmt1 = mysqli_prepare($link, $sql1)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt1, "s", $param_Ssn);      
        // Set parameters
       $param_Ssn = trim($_GET["Ssn"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt1)){
            $result1 = mysqli_stmt_get_result($stmt1);
			if(mysqli_num_rows($result1) > 0){

				$row = mysqli_fetch_array($result1);

				$LastName = $row['LastName'];
				$FirstName = $row['FirstName'];
				$Salery = $row['Salary'];
				$BirthDate = $row['BirthDate'];
				$Address = $row['Address'];
				$Dnum = $row['Dnum'];
				$SuperSsn = $row['SuperSsn'];
			}
		}
	}
}

 
// Post information about the employee when the form is submitted
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // the id is hidden and can not be changed
    $Ssn = $_SESSION["Ssn"];
    // Validate form data this is similar to the create Employee file
    // Validate name
    $FirstName = trim($_POST["FirstName"]);

    if(empty($FirstName)){
        $FirstNameErr = "Please enter a first name.";
    } elseif(!filter_var($FirstName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $FirstNameErr = "Please enter a valid first name.";
    } 
    $LastName = trim($_POST["LastName"]);
    if(empty($LastName)){
        $LastNameErr = "Please enter a last name.";
    } elseif(!filter_var($LastName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $LastNameErr = "Please enter a valid last name.";
    }  
    // Validate Address
    $Address = trim($_POST["Address"]);
    if(empty($Address)){
        $AddressErr = "Please enter Address.";     
    }
	
	// Validate Salary
    $Salary = trim($_POST["Salary"]);
    if(empty($Salary)){
        $SalaryErr = "Please enter salary.";    	
	}
	
	// Validate Department Number
    $Dnum = trim($_POST["Dnum"]);
    if(empty($Dnum)){
        $DnumErr = "Please enter department number.";    	
	}

    // Check input errors before inserting into database
    if(empty($FirstNameErr) && empty($LastNameErr) && empty($AddressErr) && empty($SalaryErr) && empty($DnumErr)){
        // Prepare an update statement
        $sql = "UPDATE EMPLOYEE SET FirstName=?, LastName=?, Address=?, Salary = ?, Dnum = ? WHERE Ssn=?";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssdis", $param_FirstName, $param_LastName,$param_Address, $param_Salary,$param_Dnum, $param_Ssn);
            
            // Set parameters
            $param_FirstName = $FirstName;
			$param_LastName = $LastName;            
			$param_Address = $Address;
            $param_Salary = $Salary;
            $param_Dnum = $Dnum;
            $param_Ssn = $Ssn;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "<center><h2>Error when updating</center></h2>";
            }
        }        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else {

    // Check existence of sID parameter before processing further
	// Form default values

	if(isset($_GET["Ssn"]) && !empty(trim($_GET["Ssn"]))){
		$_SESSION["Ssn"] = $_GET["Ssn"];

		// Prepare a select statement
		$sql1 = "SELECT * FROM EMPLOYEE WHERE Ssn = ?";
  
		if($stmt1 = mysqli_prepare($link, $sql1)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt1, "s", $param_Ssn);      
			// Set parameters
		$param_Ssn = trim($_GET["Ssn"]);

			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt1)){
				$result1 = mysqli_stmt_get_result($stmt1);
				if(mysqli_num_rows($result1) == 1){

					$row = mysqli_fetch_array($result1);

					$LastName = $row['LastName'];
					$FirstName = $row['FirstName'];
					$Salary = $row['Salary'];
					$BirthDate = $row['BirthDate'];
					$Address = $row['Address'];
					$Dnum = $row['Dnum'];
					$SuperSsn = $row['SuperSsn'];
				} else{
					// URL doesn't contain valid id. Redirect to error page
					header("location: error.php");
					exit();
				}
                
			} else{
				echo "Error in SSN while updating";
			}
		
		}
			// Close statement
			mysqli_stmt_close($stmt);
        
			// Close connection
			mysqli_close($link);
	}  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
	}	
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Database</title>
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
                        <h3>Update Record for Employee with SSN =  <?php echo $_GET["Ssn"]; ?> </H3>
                    </div>
                    <p>Please edit the input values and submit to update.
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
						<div class="form-group <?php echo (!empty($DnumErr)) ? 'has-error' : ''; ?>">
                            <label>Department Number</label>
                            <input type="number" min="1" max="20" name="Dnum" class="form-control" value="<?php echo $Dnum; ?>">
                            <span class="help-block"><?php echo $DnumErr;?></span>
                        </div>						
                        <input type="hidden" name="Ssn" value="<?php echo $Ssn; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
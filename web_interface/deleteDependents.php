<?php
	session_start();

	if(isset($_GET["Essn"]) && !empty(trim($_GET["Essn"]))){
		$_SESSION["Essn"] = $_GET["Essn"];
	}

	if(isset($_GET["FirstName"]) && !empty(trim($_GET["FirstName"]))){
		$_SESSION["FirstName"] = $_GET["FirstName"];
	}
	if(isset($_GET["LastName"]) && !empty(trim($_GET["LastName"]))){
		$_SESSION["LastName"] = $_GET["LastName"];
	}

    require_once "config.php";
	// Delete an Dependents record after confirmation
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_SESSION["Essn"]) && !empty($_SESSION["Essn"])){ 
			$Ssn = $_SESSION['Essn'];
			// Prepare a delete statement
			//we need to watch out for deleting all dependents
			//for an Essn
			$sql = "DELETE FROM Dependent WHERE Essn = ? AND FirstName = ? AND LastName = ?";
   
			if($stmt = mysqli_prepare($link, $sql)){
			// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_Essn, $param_FirstName, $param_LastName);
 
				// Set parameters
				$param_Essn = $Essn;
				$param_LastName = $LastName;
       
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Records deleted successfully. Redirect to landing page
					header("location: index.php");
					exit();
				} else{
					echo "Error deleting the Dependent";
				}
			}
		}
		// Close statement
		mysqli_stmt_close($stmt);
    
		// Close connection
		mysqli_close($link);
	} else{
		// Check existence of id parameter
		if(empty(trim($_GET["Essn"]))){
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
    <title>View Dependents Records</title>
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
                        <h1>Delete Dependent Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="Ssn" value="<?php echo ($_SESSION["Ssn"]); ?>"/>
                            <p>Are you sure you want to delete the Dependent for Employee Ssn:<?php echo ($_SESSION["Ssn"]); ?>?</p><br>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
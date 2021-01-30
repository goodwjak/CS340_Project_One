<?php
	session_start();
	ob_start();
	$Ssn = $_SESSION["Ssn"];
	// Include config file
	require_once "config.php";
?>


<?php 
	// Define variables and initialize with empty values
	$Pnum = "";
	$PnumErr = $SsnErr = $HoursErr = "" ;
 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		// Validate Project number
		$Pnum = trim($_POST["Pnum"]);
		if(empty($Pnum)){
			$PnumErr = "Please select a project.";
		} 
    
		// Validate Hours
		$Hours = trim($_POST["Hours"]);
		if(empty($Hours)){
			$HoursErr = "Please enter hours (1-40)";     
		}
	
		// Validate the SSN
		if(empty($Ssn)){
			$SsnErr = "No SSN.";     
		}


    // Check input errors before inserting in database
		if(empty($SsnErr) && empty($HoursErr) && empty($PnumErr) ){
        // Prepare an insert statement
			$sql = "INSERT INTO WorksOn (Essn, Pnum, Hours) VALUES (?, ?, ?)";


        	if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, 'sii', $param_Ssn, $param_Pnum, $param_Hours);
            
				// Set parameters
				$param_Ssn = $Ssn;
				$param_Pnum = $Pnum;
				$param_Hours = $Hours;
        
            // Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
               // Records created successfully. Redirect to landing page
				//    header("location: index.php");
				//	exit();
				} else{
					// Error
					
					$SQL_err = mysqli_error($link);
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
    <title>Employee DataBase</title>
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
                        <h3>Add a Project for Employee with SSN = 
							<?php echo $Ssn;?>			
						</h3>
                    </div>
				
<?php
	echo $SQL_err;		
	$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysqli_error());
	}
	$sql = "SELECT Pnum, Pname FROM PROJECT";
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$num_row = mysqli_num_rows($result);	
?>	

	<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
		<div class="form-group <?php echo (!empty($Ssn_err)) ? 'has-error' : ''; ?>">
            <label>Project number and name</label>
			<select name="Pnum" class="form-control">
			<?php

				for($i=0; $i<$num_row; $i++) {
					$Pnums=mysqli_fetch_row($result);
					echo "<option value='$Pnos[0]' >".$Pnums[0]."  ".$Pnums[1]."</option>";
				}
			?>
			</select>	
            <span class="help-block"><?php echo $PnumErr;?></span>
		</div>
		<div class="form-group <?php echo (!empty($HoursErr)) ? 'has-error' : ''; ?>">
			<label>Hours </label>
			<input type="number" name="Hours" class="form-control" min="1" max="80" value="">
			<span class="help-block"><?php echo $HoursErr;?></span>
		</div>
		<div>
			<input type="submit" class="btn btn-success pull-left" value="Add Project">	
			&nbsp;
			<a href="viewProjects.php" class="btn btn-primary">List Projects</a>

		</div>
	</form>
<?php		
	mysqli_free_result($result);
	mysqli_close($conn);
?>
</body>

</html>

	

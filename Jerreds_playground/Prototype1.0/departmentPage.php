
<?php
	session_start();
	//$currentpage="View Employees"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee DataBase</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
	<style type="text/css">
        .wrapper{
            width: 70%;
            margin:0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
<!--
    <script type="text/javascript">
        $(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip();});
		 $('.selectpicker').selectpicker();
    </script>
-->
</head>
<body>
    <?php
        // Include config file
        //Make sure to keep this file secert
        require_once "config.php";
//		include "header.php";
	?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Employee Details</h2>
                        <a href="createEmployee.php" class="btn btn-success pull-right">Add New Employee</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    //$sql = "SELECT Ssn,FirstName,LastName, Street, State, Salary, Birthday, 'Insert your function' as Level, SuperSsn, Dnum FROM EMPLOYEE";
                    $sql = "SELECT Ssn, FirstName, LastName, Street, State, Birthday, Salary FROM EMPLOYEE;";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th width=8%>Ssn</th>";
                                        echo "<th width=10%>First Name</th>";
                                        echo "<th width=10%>Last Name</th>";
                                        echo "<th width=10%>Street </th>";
                                        echo "<th width=10%>State </th>";
										echo "<th width=10%>Birthday </th>";
										echo "<th width = 5%>Salary</th>";
                                        echo "<th width=10%>Action</th>";
                                    echo "</tr>";
                                    
                                    //loop through all rows.
                                    while($row = mysqli_fetch_row($result))
                                    {
                                    echo "<tr>";
                                        echo "<td>" . $row[0] . "</td>";
                                        echo "<td>" . $row[1] . "</td>";
                                        echo "<td>" . $row[2] . "</td>";
                                        echo "<td>" . $row[3] . "</td>";
                                        echo "<td>" . $row[4] . "</td>";
                                        echo "<td>" . $row[5] . "</td>";
                                        echo "<td>" . $row[6] . "</td>";
                                        echo "<td> </td>"; 
                                        
                                    echo "</tr>";
                                    
                                    }
                                    
                                echo "</thead>";
                                echo "<tbody>";
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. <br>" . mysqli_error($link);
                    }
					echo "<br> <h2> Department Stats </h2> <br>";
					
                    // Select Department Stats
					/*
                    $sql2 = "SELECT * FROM DeptSTATS";
                    if($result2 = mysqli_query($link, $sql2)){
                        if(mysqli_num_rows($result2) > 0){
                            echo "<div class='col-md-4'>";
							echo "<table width=30% class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th width=20%>Dnum</th>";
                                        echo "<th width = 20%>Number of Employees</th>";
                                        echo "<th width = 40%>Average Salary Basepay</th>";
	
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result2)){
                                    echo "<tr>";
                                        echo "<td>" . $row['Dnum'] . "</td>";
                                        echo "<td>" . $row['EmpCount'] . "</td>";
                                        //Going to be used for basepay
                                        echo "<td>" . $row['AvgSalary'] . "</td>";
               
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result2);
                        } else{
                            echo "<p class='lead'><em>No records were found for Dept Stats.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql2. <br>" . mysqli_error($link);
                    }
					*/
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>

</body>
</html>

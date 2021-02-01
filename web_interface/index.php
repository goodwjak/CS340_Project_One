
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
    
<link rel="stylesheet" href="index.css">
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


<?php 
/*

*/
function createEmployee() {
  echo "Hello world!";
}


function deleteEmployee() {
  echo "Hello world!";
}


function updateEmployee() {
  echo "Hello world!";
}


?>


	
<div class='navMenu' id='navMenuId'>
<a href='index.php' class='main_links'>Employees</a>
<a href='departments.php' class='main_links'>Departments</a>
<a href='projects.php' class='main_links'>Projects</a>
<a href='pay.php' class='main_links'>Pay</a>
<a class='icon' href='javascript:void(0)' onclick='openMenu()'>&#9776</a>
</div>
	
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Employee Details</h2>
                        <!--
                        <a href="createEmployee.php" class="btn btn-success pull-right">Add New Employee</a>
                        -->
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Select Department Stats
                    
                    $sql = "SELECT * FROM DeptSTATS";
                    if($result2 = mysqli_query($link, $sql)){
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
                    
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>

</body>
</html>
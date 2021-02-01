
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

                    //$sql = "SELECT Ssn,FirstName,LastName, Street, State, Salary, Birthday, 'Insert your function' as Level, SuperSsn, Dnum FROM EMPLOYEE";
                    $sql = "SELECT Ssn, FirstName, LastName, Street, State, Birthday, Salary FROM Employee;";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table id='Employees' class='table table-bordered table-striped'>";
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
                                    
                                    //Form section to toss data into creating a new record.
                                    echo "<tr>";
                                    echo '<form action="welcome.php" method="post">';
                                        echo "<td> <input type='text' Ssn=ssn > </input> </td>";
                                        echo "<td> <input type='text' firstName=firstName  </input> </td>";
                                        echo "<td> <input type='text' lastName=lastName  </input> </td>";
                                        echo "<td> <input type='text' Street=Street  </input> </td>";
                                        echo "<td> <input type='text' State=State  </input> </td>";
                                        echo "<td> <input type='text' Birthday=Birthday  </input> </td>";
                                        echo "<td> <input type='text' Salary=Salary  </input> </td>";
                                        echo '<td> <a href="createEmployee.php" class="btn btn-success pull-right">Add</a> </td>';
                                    echo '</form>';
                                    echo "</tr>";
                                    //loop through all rows.
                                    while($row = mysqli_fetch_row($result))
                                    {
                                    echo '<tr> <form action="updateEmployee.php" method="post">';
                                        echo "<td> <input type='text' value=" . $row[0] . "></input></td>";
                                        echo "<td> <input type='text' value=" . $row[1] . "></input> </td>";
                                        echo "<td> <input type='text' value=" . $row[2] . "></input> </td>";
                                        echo "<td> <input type='text' value=" . $row[3] . "></input> </td>";
                                        echo "<td> <input type='text' value=" . $row[4] . "></input> </td>";
                                        echo "<td> <input type='text' value=" . $row[5] . "></input> </td>";
                                        echo "<td> <input type='text' value=" . $row[6] . "></input> </td>";
                                        echo '<td>
                                        <a href="createEmployee.php" class="btn btn-success pull-right">DELETE</a>
                                        <a href="createEmployee.php" class="btn btn-success pull-right">UPDATE</a> 
                                        </td>'; 
                                    echo "</tr> </form>";
                                    
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
                    mysqli_close($link);
                    ?>
                </div>

</body>
</html>

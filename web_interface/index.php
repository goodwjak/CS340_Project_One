
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

</head>
<body>

<?php 
// Include config file
//Make sure to keep this file secert
require_once "config.php";
include 'updateEmployee.php';
include 'deleteEmployee.php';
include 'createEmployee.php';
?>

<div class='navMenu' id='navMenuId'>
<a href='index.php' class='main_links'>Employees</a>
<a href='departmentPage.php' class='main_links'>Departments</a>
<a href='projectPage.php' class='main_links'>Projects</a>
<a href='payPage.php' class='main_links'>Pay</a>
<a class='icon' href='javascript:void(0)' onclick='openMenu()'>&#9776</a>
</div>

<div class="page-header clearfix">
    <h2 class="pull-left">Employees</h2>
</div>

<div class="TableDiv">
<?php
    // Include config file
    require_once "config.php";

    $sql = "SELECT Ssn, FirstName, LastName, Street, State, ZipCode, Birthday, Salary FROM EMPLOYEE;";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
        echo "<table id='Employees' class='page_table table table-bordered table-striped'>";
            echo "<thead>";
            echo "<tr>";
                echo "<th width=8%>Ssn</th>";
                echo "<th width=10%>First Name</th>";
                echo "<th width=10%>Last Name</th>";
                echo "<th width=10%>Street </th>";
                echo "<th width=10%>State </th>";
                echo "<th width=5%>ZipCode</th>";
                echo "<th width=5%>Birthday </th>";
                echo "<th width=5%>Salary</th>";
                echo "<th width=10%>Action</th>";
            echo "</tr>";
                                    
        //Form section to toss data into creating a new record.
             echo "<tr>";
                echo '<form method="POST" action="createEmployee.php">';
                echo "<td> <input type='text' name=ssn > </input> </td>";
                echo "<td> <input type='text' name=FirstName  </input> </td>";
                echo "<td> <input type='text' name=LastName  </input> </td>";
                echo "<td> <input type='text' name=Street  </input> </td>";
                echo "<td> <input type='text' name=State  </input> </td>";
                echo "<td> <input type='text' name=ZipCode </input> </td>";
                echo "<td> <input type='text' name=Birthday  </input> </td>";
                echo "<td> <input type='text' name=Salary  </input> </td>";
                echo '<td> <input class="btn btn-success pull-right" type="submit"> </td>';
            echo '</form>';
            echo "</tr>";
            //loop through all rows.
            while($row = mysqli_fetch_row($result))
            {
            //The ID is set from the primary key of the employee which happens to be the Ssn
            echo '<tr> <form id=' . $row[0] . 'action="updateEmployee.php" method="post">';
                echo "<td> <input type='text' value=" . $row[0] . "></input></td>";
                echo "<td> <input type='text' value=" . $row[1] . "></input> </td>";
                echo "<td> <input type='text' value=" . $row[2] . "></input> </td>";
                echo "<td> <input type='text' value=" . $row[3] . "></input> </td>";
                echo "<td> <input type='text' value=" . $row[4] . "></input> </td>";
                echo "<td> <input type='text' value=" . $row[5] . "></input> </td>";
                echo "<td> <input type='text' value=" . $row[6] . "></input> </td>";
                echo "<td> <input type='text' value=" . $row[7] . "></input> </td>";
                echo '<td>
                <a href="createEmployee.php" class="btn btn-success pull-right">DELETE</a>
                <a href="updateEmployee.php" class="btn btn-success pull-right">UPDATE</a> 
                </td>'; 
            echo "</tr> </form>";
            }
            echo "</thead>";                           
            echo "</table>";
            //Free result set
            mysqli_free_result($result);
            }
            else{
            echo "<p class='lead'><em>No records were found.</em></p>";
            }
            }
            else{
            echo "ERROR: Could not able to execute $sql. <br>" . mysqli_error($link);
            }
            mysqli_close($link);
            ?>

</body>
</html>

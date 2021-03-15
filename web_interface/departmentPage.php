
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
?>

<div class='navMenu' id='navMenuId'>
<a href='index.php' class='main_links'>Employees</a>
<a href='departmentPage.php' class='main_links'>Departments</a>
<a href='projectPage.php' class='main_links'>Projects</a>
<a href='payPage.php' class='main_links'>Pay</a>
<a class='icon' href='javascript:void(0)' onclick='openMenu()'>&#9776</a>
</div>

<div class="page-header clearfix">
    <h2 class="pull-left">Departments</h2>
</div>

<div class="TableDiv">
<?php
    // Include config file
    require_once "config.php";

$sql = "SELECT Dnum, Dname, MgrSsn FROM Department";
if($result2 = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result2) > 0){

    //print table
    echo "<table id='Department' class='page_table table table-bordered table-striped'>";
    echo "<thead>";
    
        echo "<tr>";
        echo "<th width=20%>Dnum</th>";
        echo "<th width = 20%>Dname</th>";
        echo "<th width = 40%>MgrSsn</th>";
        echo "</tr>";

    //echo "</thead>";
    //loop through to populate table

        while($row = mysqli_fetch_array($result2)){
        echo "<tr>";
        echo "<td>" . $row[0] ." </td>";
        echo "<td>" . $row[1] ." </td>";
        echo "<td>" . $row[2] ." </td>";
        echo "</tr>";
    }
    echo "</thead>";
    echo "</table></div>";
    }
        //echo "<p class='lead'><em>No records were found.</em></p>";
    }
    else{
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
    
?>

</body>
</html>


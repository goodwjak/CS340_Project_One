
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
    <h2 class="pull-left">Projects</h2>
</div>

<div class="TableDiv">
<?php
    // Include config file
    require_once "config.php";

    $sql = "SELECT Pnum, Plocation, Pname FROM Project;";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
        echo "<table id='Employees' class='page_table table table-bordered table-striped'>";
            echo "<thead>";
            echo "<tr>";
                echo "<th width=20%>Pnum</th>";
                echo "<th width=20%>Plocation</th>";
                echo "<th width=20%>Pname</th>";
                echo "<th width=20%>Action</th>";
            echo "</tr>";
                                    
        //Form section to toss data into creating a new record.
             echo "<tr>";
                echo '<form method="POST" action="project_funcs.php">';
                echo "<td> <input type='text' name=Pnum > </input> </td>";
                echo "<td> <input type='text' name=Plocation  </input> </td>";
                echo "<td> <input type='text' name=Pname  </input> </td>";
                echo '<td> <input class="btn btn-success pull-right" type="submit" name="action" value="ADD"> </td>';
            echo '</form>';
            echo "</tr>";
            //loop through all rows.
            while($row = mysqli_fetch_row($result))
            {
            //The ID is set from the primary key of the employee which happens to be the Ssn
            echo '<tr> <form action="project_funcs.php" method="post">';
                echo "<td> <input type='text' name='Pnum' value='" . $row[0] . "'></input></td>";
                echo "<td> <input type='text' name='Plocation' value='" . $row[1] . "'></input> </td>";
                echo "<td> <input type='text' name='Pname' value='" . $row[2] . "'></input> </td>";
                echo '<td>';
                    echo ' <input class="btn btn-success pull-right" type="submit" name="action" value="DELETE">';
                    echo ' <input class="btn btn-success pull-right" type="submit" name="action" value="UPDATE">';
                echo '</td>';
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

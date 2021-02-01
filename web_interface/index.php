
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
    
    
<style>
#Employees {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  box-shadow: 5px 5px 10px;
  width: 100%;
}

#Employees td, #Employees th {
  border: 1px solid #ddd;
  padding: 8px;
}

#Employees tr:nth-child(even){background-color: #f2f2f2;}

#Employees tr:hover {background-color: #ddd;}

#Employees th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #2196f3;
  color: white;
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
                        <!--
                        <a href="createEmployee.php" class="btn btn-success pull-right">Add New Employee</a>
                        -->
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    //$sql = "SELECT Ssn,FirstName,LastName, Street, State, Salary, Birthday, 'Insert your function' as Level, SuperSsn, Dnum FROM EMPLOYEE";
                    $sql = "SELECT Ssn, FirstName, LastName, Street, State, Birthday, Salary FROM EMPLOYEE;";
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
                                        echo "<td> <input type='text' Ssn=ssn </td>";
                                        echo "<td> <input type='text' firstName=firstName </td>";
                                        echo "<td> <input type='text' lastName=lastName </td>";
                                        echo "<td> <input type='text' Street=Street </td>";
                                        echo "<td> <input type='text' State=State </td>";
                                        echo "<td> <input type='text' Birthday=Birthday </td>";
                                        echo "<td> <input type='text' Salary=Salary </td>";
                                        echo '<td> <input type="submit" value="Create"></td>';
                                    echo '</form>';
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
                    mysqli_close($link);
                    ?>
                </div>

</body>
</html>

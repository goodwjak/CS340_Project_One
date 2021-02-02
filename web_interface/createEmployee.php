

 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper
        {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h1>Employee record added:<br></h1>

<?php
require_once "config.php";
//show that it's working.

echo "<p> PHP GENTERATED </p>";
//Validate the data for the entered data.

//keep track if everything is valid or not.
$valid_data = true;

echo "<p>FirstName: " . strlen($_POST["FirstName"]) <= 50 . "</p>";

//check the first name var.
// if the string is not less than or equal to 50 and the name isn't greater than zero.
if( (NOT (strlen($_POST["FirstName"]) <= 50)) OR ( strlen($_POST["FirstName"]) > 0))
{
//it's no longer valid.
    $valid_data = false;
    echo "<p> FIRSTNAME NOT VALID! <br> </p>";
}

//check the first name var.
// if the string is not less than or equal to 50 and the name isn't greater than zero.
if( (NOT (strlen($_POST["LastName"]) <= 50)) OR ( strlen($_POST["LastName"]) > 0))
{
//it's no longer valid.
    $valid_data = false;
    echo "<p> LASTNAME NOT VALID! <br> </p>";
}

echo "<p>LastName: " . $_POST["LastName"] . "</p>";

//construct query from the input data.


//submit the query and add employee to the DB

?>
    
</body>
</html>
 
 <?php
 






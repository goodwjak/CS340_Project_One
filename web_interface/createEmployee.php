<?php 
include_once 'config.php';

echo "<p>Adding EMPLOYEE</p>";
echo "<script>console.log('Adding EMPLOYEE');</script>";

//echo "<script>console.log('" . $_POST['Ssn'] . "');</script>";

if(isset($_POST['Ssn']))
{    
     $Ssn = $_POST['Ssn'];
     $FirstName = $_POST['FirstName'];
     $LastName = $_POST['LastName'];
     $Street = $_POST['Street'];
     $State = $_POST['State'];
     $ZipCode = $_POST['ZipCode'];
     $Birthday = $_POST['Birthday'];
     $Salary = $_POST['Salary'];
     
     $sql = "INSERT INTO EMPLOYEE (Ssn, FirstName, LastName, Street, State, ZipCode, Birthday, Salary) 
     VALUES ('$Ssn', '$FirstName', '$LastName', '$Street', '$State', '$ZipCode', '$Birthday', '$Salary')";
     
     //$sql = "INSERT INTO EMPLOYEE (name,email,mobile) VALUES ('$name','$email','$mobile')";
     if (mysqli_query($link, $sql)) {
        echo "<script>console.log('Sucess adding employee.');</script>";
     } else {
        //echo "<p>Error: " . $sql . ":-" . mysqli_error($conn) . "</p>";
        echo "<script>console.log('Error: " . $sql . ":-" . mysqli_error($link) . ");</script>";
     }
     //mysqli_close($conn);
}

echo "<script>console.log('Script Done');</script>";
header('Location: index.php');
?>

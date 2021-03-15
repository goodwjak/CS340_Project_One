<?php 
include_once 'config.php';
if(isset($_POST['submit']))
{    
     $name = $_POST['name'];
     $email = $_POST['email'];
     $mobile = $_POST['mobile'];
     $sql = "INSERT INTO users (name,email,mobile)
     VALUES ('$name','$email','$mobile')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>


<?php 
//No need to linlucde anything as it's a file already included on the  page.

/*
Input: Need to use ssn to use as the primary key.
Output: updates the EMPLOYEE values then ...
Description: grabs the data from the form then puts into query.
*/
/*
function updateEmployee()
{
    
    $pick_emp = 'select * from EMPLOYEE where Ssn is  ' + Ssn;
    $mysql_employee = ($link, $pick_emp);
    //check to make sure none of the fields are empty.
    $ssn = 
    
    //check to make sure the data types are correct.
    
    //run sql on the database.
    
}
*/
?>
 

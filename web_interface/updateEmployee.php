<?php 
/*
Input: POST Data for update or deletion.
Output: webpage
Description: Handles makeing changes to enployees in the database 
FileName: updateEmployee.php
*/

include_once 'config.php';

echo "<p>Modifing the employee</p>";
echo "<script>console.log('Adding EMPLOYEE');</script>";

//echo "<script>console.log('" . $_POST['Ssn'] . "');</script>";

//check to see if we are updating or deleteing a employee.
if($_POST['action'] == "DELETE"){
    //call the delete function
} else if($_POST['action'] == "UPDATE"){
    //call the update function
}


/*
Input: Post data.
Output: data to the console and query to the database.
Description: Deletes a employee from the database.
*/
function delete_employee() {
    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Ssn'])) {
        //get the key value.
        $Ssn = $_POST['Ssn'];
    
        //construct the sql.
        $sql = 'DELETE FROM EMPLOYEE WHERE Ssn is ' . $Ssn . ';';
        
        //send the sql.
        if (mysqli_query($link, $sql)) {
            //Tell the user that it war good.
            echo "<script>console.log('Sucess adding employee.');</script>";
        } 
        else {
            //Tell the user there war a error.
            echo "<script>console.log('Error: " . $sql . ":-" . mysqli_error($link) . ");</script>";
            
            //snap back
        }
    
    } 
    //otherwise we can just log the error to clonsole and alert the user.
    else {
        //give error
        
        //snap back
    
    }
}



/*
Input: Post data.
Output: data to the console and query to the database.
Description: Updates the values of an employee in the database
*/
function update_employee() {
    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Ssn'])) {
        //get the key value.
        $Ssn = $_POST['Ssn'];
    
        //construct the sql.
        $sql = 'DELETE FROM EMPLOYEE WHERE Ssn is ' . $Ssn . ';';
        
        //send the sql.
        if (mysqli_query($link, $sql)) {
            //Tell the user that it war good.
            echo "<script>console.log('Sucess adding employee.');</script>";
        } 
        else {
            //Tell the user there war a error.
            echo "<script>console.log('Error: " . $sql . ":-" . mysqli_error($link) . ");</script>";
            
            //snap back
        }
    
    } 
    //otherwise we can just log the error to clonsole and alert the user.
    else {
        //give error
        
        //snap back
    
    }
}


//check to make sure the post data isn't empty.
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

//here I need to have it send the client back to the previous page and load it.
echo "<script>console.log('Script Done');</script>";
header('Location: index.php');
?>

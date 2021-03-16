<?php 
/*
Input: POST Data for update or deletion.
Output: webpage
Description: Handles makeing changes to enployees in the database 
FileName: updateEmployee.php
*/
session_start();
//require_once 'config.php';
include("config.php");

//include something for the user to look at.
include("loading_animation.html");

//echo "<p>Modifing the employee</p>";
echo "<script>console.log('Updating employee');</script>";

//echo "<script>console.log('" . $_POST['Ssn'] . "');</script>";

//Make sure we have access to the database
//echo "<script>console.log('" . $link . "');</script>";

if($link == false){
    echo "<script>console.log('ERROR: NO LINK TO DATABASE!');</script>";
}


//check to see if we are updating or deleteing a employee.
if($_POST['action'] == "DELETE"){
    //call the delete function
    delete_employee($link);
}
else if($_POST['action'] == "UPDATE"){
    //call the update function
    update_employee($link);
}
else if($_POST['action'] == "ADD"){
    //call the add function
    add_employee($link);
}

//here I need to have it send the client back to the previous page and load it.
echo "<script>console.log('Script Done');</script>";

//pause for a couple seconds.
sleep(5);

//goback to the main page

/*
#######################################
FUNCTIONS
#######################################
*/


/*
Input: Post data.
Output: data to the console and query to the database.
Description: Deletes a employee from the database.
*/
function delete_employee($link) {
    //log to console the function.
    echo "<script>console.log('calling: delete_employee()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Ssn']) and strlen($_POST['Ssn']) >= 8) {
        //get the key value.
        $Ssn = $_POST['Ssn'];
    
        //construct the sql.
        $sql = 'DELETE FROM EMPLOYEE WHERE Ssn is ' . $Ssn . ';';
        
        //send the sql.
        if (mysqli_query($link, $sql)) {
            //Tell the user that it war good.
            echo "<script>console.log('Sucess sending data.');</script>";
        } 
        else {
            //Tell the user there war a error.
            echo "<script>console.log('Error: " . $sql . ":-" . mysqli_error($link) . ");</script>";
            
            //snap back
            echo '<script>alert("ERROR: Had trouble with the database!");</script>';
        }
    
    } 
    //otherwise we can just log the error to clonsole and alert the user.
    else {
        //give error
        echo '<script>alert("ERROR: Missing Data!");</script>';
        //snap back
    
    }
}



/*
Input: Post data.
Output: data to the console and query to the database.
Description: Updates the values of an employee in the database
*/
function update_employee($link) {
    //log to console the function.
    echo "<script>console.log('calling: update_employee()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Ssn']) and strlen($_POST['Ssn']) >= 8) {
        //get all the data for the employee into vars.
        $Ssn = $_POST['Ssn'];
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $Street = $_POST['Street'];
        $State = $_POST['State'];
        $ZipCode = $_POST['ZipCode'];
        $Birthday = $_POST['Birthday'];
        $Salary = $_POST['Salary'];
    
        //construct the sql.
        $sql = 'UPDATE EMPLOYEE
        SET Ssn = "' . $Ssn . '",
        FirstName = "' . $FirstName . '",
        LastName = "' . $LastName . '",
        Street = "' . $Street . '",
        State = "' . $State . '", 
        ZipCode = "' . $ZipCode . '",
        Birthday = "' . $Birthday . '",
        Salary = "' . $Salary . '"
        WHERE Ssn = ' . $Ssn . ';';
        
        //send the sql.
        if (mysqli_query($link, $sql)) {
            //Tell the user that it war good.
            echo "<script>console.log('Sucess sending data');</script>";
        } 
        else {
            //Tell the user there war a error.
            echo "<script>console.log('Error: " . $sql . ":-" . mysqli_error($link) . ");</script>";
            
            //snap back
            echo '<script>alert("ERROR: Had trouble with the database!");</script>';
        }
    
    } 
    //otherwise we can just log the error to clonsole and alert the user.
    else {
        //give error
        echo '<script>alert("ERROR: Missing Data!");</script>';
        //snap back
    
    }
}

/*
Input: Post data.
Output: data to the console and query to the database.
Description: Adds a new employee to thes database.
*/
function add_employee($link) {
    //log to console the function.
    echo "<script>console.log('calling: add_employee()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Ssn']) and strlen($_POST['Ssn']) >= 8) {
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
     
        
        //send the sql.
        if (mysqli_query($link, $sql)) {
            //Tell the user that it war good.
            echo "<script>console.log('Sucess sending data');</script>";
        } 
        else {
            //Tell the user there war a error.
            echo "<script>console.log('Error: " . $sql . ":-" . mysqli_error($link) . ");</script>";
            
            //snap back
            echo '<script>alert("ERROR: Had trouble with the database!");</script>';
        }
    
    } 
    //otherwise we can just log the error to clonsole and alert the user.
    else {
        //give error
        echo '<script>alert("ERROR: Missing Data!");</script>';
        //snap back
    
    }
}


?>

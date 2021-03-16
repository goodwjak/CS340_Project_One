<?php 
/*
Input: POST Data for update or deletion.
Output: webpage
Description: Handles makeing changes to department in the database 
FileName: updateEmployee.php
*/


session_start();
//require_once 'config.php';
include("config.php");

//include something for the user to look at.
include("loading_animation.html");


//double check that we have access to the database.
if($link == false){
    echo "<script>console.log('ERROR: NO LINK TO DATABASE!');</script>";
}


//check to see if we are updating or deleteing a employee.
if($_POST['action'] == "DELETE"){
    //call the delete function
    delete_department($link);
}
else if($_POST['action'] == "UPDATE"){
    //call the update function
    update_department($link);
}
else if($_POST['action'] == "ADD"){
    //call the add function
    add_department($link);
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
Description: Deletes a department from the database.
*/
function delete_department($link){
    //log to console the function.
    echo "<script>console.log('calling: delete_department()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Dnum']) and strlen($_POST['Dnum']) >= 1) {
        //get the key value.
        $Dnum = $_POST['Dnum'];
    
        //construct the sql.
        $sql = 'DELETE FROM Department WHERE Dnum is ' . $Dnum . ';';
        
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
Description: adds a department from the database.
*/
function add_department($link){
    //log to console the function.
    echo "<script>console.log('calling: add_department()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Dnum']) and strlen($_POST['Dnum']) >= 1) {
        //get the key value.
        $Dnum = $_POST['Dnum'];
        $Dname = $_POST['Dname'];
        $Dname = $_POST['MgrSsn'];
    
        //construct the sql.
        $sql = 'INSERT INTO Department 
        (Dnum, Dname, MgrSsn) VALUES (' . $Dnum . ', ' . $Dname . ', ' . $MgrSsn . ');';
        
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
Description: updates a department from the database.
*/
function update_department($link){
    //log to console the function.
    echo "<script>console.log('calling: update_department()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Dnum']) and strlen($_POST['Dnum']) >= 1) {
        //get the key value.
        $Dnum = $_POST['Dnum'];
        $Dname = $_POST['Dname'];
        $MgrSsn = $_POST['MgrSsn'];
    
        //construct the sql.
        $sql = 'UPDATE Department SET 
        Dnum = ' . $Dnum . ',
        Dname = ' . $Dname . ',
        MgrSsn = ' . $MgrSsn . '
        WHERE Dnum is ' . $Dnum . ';';
        
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











?>

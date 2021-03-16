<?php 
/*
Input: POST Data for update or deletion.
Output: webpage
Description: Handles makeing changes to Pay in the database 
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
    delete_Pay($link);
}
else if($_POST['action'] == "UPDATE"){
    //call the update function
    update_Pay($link);
}
else if($_POST['action'] == "ADD"){
    //call the add function
    add_Pay($link);
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
Description: Deletes a Pay from the database.
*/
function delete_Pay($link) {
    //log to console the function.
    echo "<script>console.log('calling: delete_Pay()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Essn']) and strlen($_POST['Essn']) >= 1) {
        //get the key value.
        $Essn = $_POST['Essn'];
    
        //construct the sql.
        $sql = 'DELETE FROM Pay WHERE Essn = ' . $Essn . ';';
        
        //send the sql.
        if (mysqli_query($link, $sql)) {
            //Tell the user that it war good.
            echo "<script>console.log('Sucess sending data.');</script>";
        } 
        else {
            //Tell the user there war a error.
            echo "<script>console.log('Error: " . mysqli_error($link) . "');</script>";
            
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
Description: adds a Pay from the database.
*/
function add_Pay($link){
    //log to console the function.
    echo "<script>console.log('calling: add_Pay()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Essn']) and strlen($_POST['Essn']) >= 1) {
        //get the key value.
        $Essn = $_POST['Essn'];
        $Dependents = $_POST['Dependents'];
        $BasePay = $_POST['BasePay'];
        $ProjectPay = $_POST['ProjectPay'];
    
        //construct the sql.
        $sql = "INSERT INTO Pay (Essn, Dependents, BasePay, ProjectPay) VALUES ('$Essn ', '$Dependents', '$BasePay', '$ProjectPay')";
        
        //send the sql.
        if (mysqli_query($link, $sql)) {
            //Tell the user that it war good.
            echo "<script>console.log('Sucess sending data.');</script>";
        } 
        else {
            //Tell the user there war a error.
            echo mysqli_error($link);
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
Description: updates a Pay from the database.
*/
function update_Pay($link){
    //log to console the function.
    echo "<script>console.log('calling: update_Pay()');</script>";

    //first make sure the data isn't empty and that we have the key.
    if(isset($_POST['Essn']) and strlen($_POST['Essn']) >= 1) {
        //get the key value.
        $Essn = $_POST['Essn'];
        $Dependents = $_POST['Dependents'];
        $BasePay = $_POST['BasePay'];
        $ProjectPay = $_POST['ProjectPay'];
    
        //construct the sql.
        $sql = "UPDATE Pay SET 
        Essn = ' . $Essn . ',
        Dependents = ' . $Dependents . ',
        BasePay = ' . $BasePay . ',
        ProjectPay = ' . $ProjectPay . '
        WHERE Essn is ' . $Essn . '";
        
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

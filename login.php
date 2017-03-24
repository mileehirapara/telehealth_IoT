<?php
/** 
 * PHP version 5
 * 
 * @catagory    Doctor Login 
 * @package     IoT GateWay
 * @author      
 * @version     Release: 1.0
 * @since       March 23, 2017
 * @link        
 * @license
 * @copyright
 *
 * It requires connection to server at prior,
 * Then it REQUEST for number of data (2), verifies if data is empty or not
 * if empty then @show incomplete data message
 * else select raw from table based on entered data using connection string
 * @table doctor_reg
 * 
 * This script made for testing only
 *
 */

require "conn.php"; // File having connection to server-databse 

//================================================================
// CHECK IF ANY OF THE DATA FIELD IS LEFT EMPTY
//================================================================

//----------------------------------------------------------------
// isset(@var) Returns True if Varible Has Value
// $_REQUEST[FiledName] To Collect Data From Submitted Form 
//----------------------------------------------------------------

if(isset($_REQUEST['aadhar_id'])&&isset($_REQUEST['password'])) {

//--------------------------------------------------
// Assign All The Data Into Different Varibales 
//--------------------------------------------------
	
	$aadhar_id=$_REQUEST['aadhar_id'];

//--------------------------------------------------
// md5 function to encrypt password 
// md5(PASSWORD) will return 32 bit hash value
//--------------------------------------------------

	$password=md5($_REQUEST['password']);

//====================================================
// USING CONNECTION STRING SELECT QUERY GETS EXECUTED
// WILL RETURN SET OF VALUES BASED ON GIVEN INPUT
//====================================================

	$result=mysqli_query($con,"select * from doctor_reg where aadhar_id='$aadhar_id' and password='$password'");

//====================================================
// CHECKING IF MORE THAN ONE RAW IS RETURNED IN RESULT
//====================================================

	if(mysqli_num_rows($result)>0){
		echo "Login Successful";  // When data entered are already in databse
		}		
	else {
		echo "ERROR: Login Unsuccessful! \n\t TRY AGAIN";  // When select qurey returns null value
	}	
}
else {
	echo "ERROR: Incomplete Data";    // When Data Sent To perform login opertaion is not proper
}
	
mysqli_close($con);

?>

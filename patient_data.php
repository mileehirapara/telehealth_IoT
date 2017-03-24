<?php
/** 
 * PHP version 5
 * 
 * @catagory    Patient Sensor Data Store
 * @package     IoT GateWay
 * @author      
 * @version     Release: 1.0
 * @since       March 23, 2017
 * @link        
 * @license
 * @copyright
 *
 * It requires connection to server at prior,
 * Then it REQUEST for number of data (9), verifies if data is empty or not
 * if empty then @show incomplete data message
 * else insert all that data into databse using connection string
 * into @table patient_data
 * 
 */

require "conn.php";  // File having connection to server-databse 

//================================================================
// CHECK IF ANY OF THE DATA FIELD IS LEFT EMPTY
//================================================================

//----------------------------------------------------------------
// isset(@var) Returns True if Varible Has Value
// $_REQUEST[FiledName] To Collect Data From Submitted Form 
//----------------------------------------------------------------

if(isset($_REQUEST['aadhar_id'])&&
   isset($_REQUEST['email_id'])&&
   isset($_REQUEST['temp'])&&
   isset($_REQUEST['pulse'])&&
   isset($_REQUEST['blood_oxy'])&&
   isset($_REQUEST['ecg'])&&
   isset($_REQUEST['blood_pressure'])&&
   isset($_REQUEST['symptoms'])&&
   isset($_REQUEST['doctor']))	{

//--------------------------------------------------
// Assign All The Data Into Different Varibales 
//--------------------------------------------------
	
	$aadhar_id=$_REQUEST['aadhar_id'];
	$email_id=$_REQUEST['email_id'];
	$temp=$_REQUEST['temp'];
	$pulse=$_REQUEST['pulse'];
	$blood_oxy=$_REQUEST['blood_oxy'];
	$ecg=$_REQUEST['ecg'];
	$blood_pressure=$_REQUEST['blood_pressure'];
	$symptoms=$_REQUEST['symptoms'];
	$doctor=$_REQUEST['doctor'];

//---------------------------------------------------
// Using Connection String Execute Insert Query
//---------------------------------------------------

	if(mysqli_query($con,"INSERT INTO `patient_data`(`aadhar_id`, `email_id`, `temp`, `pulse`, `blood_oxy`, `ecg`, `blood_pressure`, `symptoms`, `doctor`) VALUES ('$aadhar_id','$email_id','$temp','$pulse','$blood_oxy','$ecg','$blood_pressure','$symptoms','$doctor')")) {
		echo "1"; // When Query Is Successfully Executed
	}
	else {
		echo "0"; // When Insertion Operation cann't be performed
	}	
}
else {
	 echo "ERROR: Incomplete Data";    // When Data Sent To perform Insert opertaion is not proper
}

mysqli_close($con); // Close Connection After Execution Of Query

?>

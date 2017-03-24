<?php
/** 
 * PHP version 5
 * 
 * @catagory    Patient History 
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
 * into @table patient_history .
 * It stores the sensor data that have crossed the threshold value.
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

if(isset($_REQUEST['p_aadhar_id'])&&
   isset($_REQUEST['d_aadhar_id'])&& 
   isset($_REQUEST['temp'])&&
   isset($_REQUEST['pulse'])&&
   isset($_REQUEST['blood_oxy'])&&
   isset($_REQUEST['ecg'])&&
   isset($_REQUEST['blood_pressure'])&&
   isset($_REQUEST['symptoms'])&&
   isset($_REQUEST['prescription'])) {

//--------------------------------------------------
// Assign All The Data Into Different Varibales 
//--------------------------------------------------

	$p_aadhar_id=$_REQUEST['p_aadhar_id'];
	$d_aadhar_id=$_REQUEST['d_aadhar_id'];
	$temp=$_REQUEST['temp'];
	$pulse=$_REQUEST['pulse'];
	$blood_oxy=$_REQUEST['blood_oxy'];
	$ecg=$_REQUEST['ecg'];
	$blood_pressure=$_REQUEST['blood_pressure'];
	$symptoms=$_REQUEST['symptoms'];
	$prescription=$_REQUEST['prescription'];

//---------------------------------------------------
// Using Connection String Execute Insert Query
//---------------------------------------------------

	if(mysqli_query($con,"INSERT INTO `patient_history`(`p_aadhar_id`, `temp`, `pulse`, `blood_oxy`, `ecg`, `blood_pressure`, `symptoms`, `prescription`, `d_aadhar_id`) VALUES ('$p_aadhar_id','$temp','$pulse','$blood_oxy','$ecg','$blood_pressure','$symptoms','$prescription','$d_aadhar_id')")) {
		echo "1";  // When Query Is Successfully Executed
	  }
	else {
		echo "0";  // When Insertion Operation cann't be performed
	}	
}
else {
	echo "ERROR: Incomplete Data";    // When Data Sent To perform Insert opertaion is not proper
}

mysqli_close($con);  // Close Connection After Execution Of Query

?>

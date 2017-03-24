<?php
/** 
 * PHP version 5
 * 
 * @catagory    Doctor's STATUS Update
 * @package     IoT GateWay
 * @author      
 * @version     Release: 1.0
 * @since       March 23, 2017
 * @link        
 * @license
 * @copyright
 *
 * Update availability status of doctor into Database
 * So that sending patatient's data will be easy
 * STATUS 0 : OFFLINE
 * STATUS 1 : ONLINE
 * @show Error when invalid value of status is given
 */

require "conn.php"; // File having connection to server-databse 

//================================================================
// CHECK IF ANY OF THE DATA FIELD IS LEFT EMPTY
//================================================================

//----------------------------------------------------------------
// isset(@var) Returns True if Varible Has Value
// $_REQUEST[FiledName] To Collect Data From Submitted Form 
//----------------------------------------------------------------

if(isset($_REQUEST['aadhar_id']) && isset($_REQUEST['status'])) {	

//--------------------------------------------------
// Assign All The Data Into Different Varibales 
//--------------------------------------------------

	$aadhar_id=$_REQUEST['aadhar_id'];
	$status=$_REQUEST['status'];

	if($status==1||$status==0) {  // Status can either be one of '0' or '1'

//---------------------------------------------------
// Using Connection String Execute Update Query
//---------------------------------------------------

		if(mysqli_query($con,"update doctor_reg SET status='$status' where aadhar_id LIKE '$aadhar_id'")) {

// show appropriate message as par status value 
			if ( $status == 1)
				echo " ONLINE ";   
			else
				echo " OFFLINE ";
		}
		else{
			echo "ERROR: Status updation FAIL!! TRY AFTER SOME TIME ". mysqli_error($con); // When Updation Operation cann't be performed
		}
	}
	else {
		echo "ERROR: Invalid STATUS value should be  ONLINE:1   OFFLINE:0 ";
	}
}
else {
	echo "ERROR: Incomplete Data";    // When Data Sent To perform Insert opertaion is not proper
}
	
mysqli_close($con); // Close Connection After Execution Of Query

?>
